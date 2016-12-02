<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Backend\RoleCreateRequest;
use App\Http\Requests\Backend\RoleUpdateRequest;
use App\Repositories\RoleRepository;
use App\Repositories\PermissionRepository;
use App\Validators\Backend\RoleValidator;


class RolesController extends Controller
{

    /**
     * @var RoleRepository
     */
    protected $repository;

    /**
     * @var RoleValidator
     */
    protected $validator;

    /**
     * @var Permission
     */
    protected $permission;

    public function __construct(RoleRepository $repository, RoleValidator $validator, PermissionRepository $permission)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->permission = $permission;
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
            })->paginate($options['items_per_page'], array('id', 'name', 'filter', 'created_at', 'updated_at'));

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $items,
            ]);
        }

        return view('backends.roles.index', compact('items', 'options'));
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

        return view('backends.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        \DB::beginTransaction();
        try {

            $this->validator->with($request->only('name', 'filter'))->passesOrFail(ValidatorInterface::RULE_CREATE);

            $role = $this->repository->create($request->only('name', 'filter'));

            /**
             * Check role exist
             * If role is exist then do the job inside, if not then return with message
             */
            if($role)
            {
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
                            \Acl::grantRolePermission($permission, $role, explode('.', $value['action']));
                        }
                    }
                    \Flash::success(trans('messages.add_success', ['name' => trans('backend.role')]));
                }
            }
            else
            {
                \Flash::warning(trans('messages.add_warning', ['name' => trans('backend.role')]));

                return redirect()->back()->with('message', $response['message']);
            }

            $response = [
                'message' => 'Role created.',
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            \DB::commit();
            return redirect()->route('admin.role.index');
        } catch (ValidatorException $e) {
            \DB::rollBack();
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            \Flash::error(trans('messages.add_error', ['name' => trans('backend.role')]));

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

        $permissions = $this->permission->all();
        $edit_permissions = $item->getPermissions;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $item,
            ]);
        }

        return view('backends.roles.show', compact('item', 'permissions', 'edit_permissions'));
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
        $item = $this->repository->find($id);

        $permissions = $this->permission->all();
        $edit_permissions = $item->getPermissions;

        return view('backends.roles.edit', compact('item', 'permissions', 'edit_permissions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = \App\Models\Acl\Role::find($id);

        \DB::beginTransaction();
        try {

            $this->validator->with($request->only('name', 'filter'))->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $role = $this->repository->update($request->only('name', 'filter'), $id);


            /**
             * Check role exist
             * If role is exist then do the job inside, if not then return with message
             */
            if($role)
            {
                /**
                 * Get array of permission of role
                 * @var [type]
                 */
                $new_permissions_temp = \Backend::getPermissionValue($request->permission);
                $edit_permissions_temp = \Backend::getPermissionValueFromArray($role->getPermissions());
                $all_permissions_temp = \Backend::getPermissionValueFromCollection($this->permission->all());

                $new_permissions = \Backend::getNewPermission($new_permissions_temp, $edit_permissions_temp, $all_permissions_temp);
                $edit_permissions = \Backend::getEditPermission($new_permissions_temp, $edit_permissions_temp, $all_permissions_temp);

                /**
                 * $new_permission là tiến hành thêm mới permission vào role.
                 * $edit_permission là tiến hành xóa permission hay cập nhật actions cho role là rỗng.
                 * $edit_permissions_temp là tiến hành cập nhật lại actions cho các permission này.
                 */
                if($edit_permissions)
                {
                    foreach($edit_permissions as $value)
                    {
                        $permission_arr = explode('.', $value['permission']);
                        $permission = \App\Models\Acl\Permission::where(['area' => $permission_arr[0], 'permission' => $permission_arr[1]])->first();
                        if($permission)
                        {
                            \Acl::grantRolePermission($permission, $role, array(), true);
                        }
                    }
                }

                if($new_permissions_temp)
                {
                    foreach($new_permissions_temp as $value)
                    {
                        $permission_arr = explode('.', $value['permission']);
                        $permission = \App\Models\Acl\Permission::where(['area' => $permission_arr[0], 'permission' => $permission_arr[1]])->first();
                        if($permission)
                        {
                            if(isset($value['action']) && $value['action'] != null)
                                \Acl::grantRolePermission($permission, $role, explode('.', $value['action']), true);
                            else
                                \Acl::grantRolePermission($permission, $role, array(), true);
                        }
                    }
                }


                \Flash::success(trans('messages.update_success', ['name' => trans('backend.role')]));
            }
            else
            {
                \Flash::warning(trans('messages.update_warning', ['name' => trans('backend.role')]));

                return redirect()->back()->with('message', $response['message']);
            }

            $response = [
                'message' => 'Role Update.',
                'data'    => $role->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            \DB::commit();
            return redirect()->route('admin.role.index');
        } catch (ValidatorException $e) {
            \DB::rollBack();
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            \Flash::error(trans('messages.update_error', ['name' => trans('backend.role')]));

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
        $role = \App\Models\Acl\Role::find($id);

        $permissions = $role->getPermissions()->get();
        foreach ($permissions as $permission) {
            \Acl::revokeRolePermission($permission, $role);
        }

        $deleted = $this->repository->delete($id);

        if($deleted)
            \Flash::success(trans('messages.destroy_success', ['name' => trans('backend.role')]));
        else
            \Flash::warning(trans('messages.destroy_warning', ['name' => trans('backend.role')]));

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Role deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Role deleted.');
    }
}
