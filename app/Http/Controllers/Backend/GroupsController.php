<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Backend\GroupCreateRequest;
use App\Http\Requests\Backend\GroupUpdateRequest;
use App\Repositories\GroupRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Validators\Backend\GroupValidator;


class GroupsController extends Controller
{

    /**
     * @var GroupRepository
     */
    protected $repository;

    /**
     * @var GroupValidator
     */
    protected $validator;

    public function __construct(GroupRepository $repository, GroupValidator $validator, PermissionRepository $permission, RoleRepository $role)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->permission = $permission;
        $this->role = $role;
        $this->para = \Backend::getIndexParams();
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options = $this->para;
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $items = $this->repository->scopeQuery(function($query){
                return $query->orderBy('id','desc');
            })->paginate($options['items_per_page'], array('id', 'name', 'created_at', 'updated_at'));

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $items,
            ]);
        }

        return view('backends.groups.index', compact('items', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->permission->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $permissions =  $this->permission->all();
        $this->role->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $roles =  $this->role->all();

        return view('backends.groups.create', compact('permissions', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  GroupCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GroupCreateRequest $request)
    {
        \DB::beginTransaction();
        try {

            $this->validator->with($request->only('name'))->passesOrFail(ValidatorInterface::RULE_CREATE);

            $group = $this->repository->create($request->only('name'));

            /**
             * Check role exist
             * If role is exist then do the job inside, if not then return with message
             */
            if($group)
            {
                $roles_arr = $request->role;

                if($roles_arr)
                {
                    foreach ($roles_arr as $value) {
                        $role = \App\Models\Acl\Role::where('id', $value)->first();
                        if($role)
                        {
                            \Acl::grantGroupRole($role, $group);
                        }
                    }
                }
                /**
                 * Get array of permission of role
                 * @var [type]
                 */
                $permissions = \Backend::getPermissionValue($request->permission);
                if($permissions)
                {
                    foreach($permissions as $value)
                    {
                        $permission_arr = explode('.', $value['permission']);
                        $permission = \App\Models\Acl\Permission::where(['area' => $permission_arr[0], 'permission' => $permission_arr[1]])->first();
                        if($permission)
                        {
                            \Acl::grantGroupPermission($permission, $group, explode('.', $value['action']));
                        }
                    }
                    \Flash::success(trans('messages.add_success', ['name' => trans('backend.group')]));
                }
            }
            else
            {
                \Flash::warning(trans('messages.add_warning', ['name' => trans('backend.group')]));

                return redirect()->back()->with('message', $response['message']);
            }

            $response = [
                'message' => 'Group created.',
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            \DB::commit();
            return redirect()->route('admin.group.index');
        } catch (ValidatorException $e) {
            \DB::rollBack();
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            \Flash::error(trans('messages.add_error', ['name' => trans('backend.group')]));

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->repository->find($id);
        $this->role->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $roles = $this->role->all();
        $edit_roles = $item->getRoles()->get();
        dd($edit_roles);
        if (request()->wantsJson()) {

            return response()->json([
                'data' => $item,
            ]);
        }

        return view('backends.groups.show', compact('item', 'roles'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $group = $this->repository->find($id);

        return view('groups.edit', compact('group'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  GroupUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(GroupUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $group = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Group updated.',
                'data'    => $group->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Group deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Group deleted.');
    }
}