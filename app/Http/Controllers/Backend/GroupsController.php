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
                        $this->permission->skipCriteria();
                        $permission = $this->permission->findWhere(['area' => $permission_arr[0], 'permission' => $permission_arr[1]])->first();
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

        $permissions = $this->permission->all();
        $edit_permissions = $item->getPermissions;

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $item,
            ]);
        }

        return view('backends.groups.show', compact('item', 'roles', 'edit_roles', 'permissions', 'edit_permissions'));
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
        $this->role->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $roles = $this->role->all();
        $edit_roles = $item->getRoles()->get();

        $permissions = $this->permission->all();
        $edit_permissions = $item->getPermissions;

        return view('backends.groups.edit', compact('item', 'roles', 'edit_roles', 'permissions', 'edit_permissions'));
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
        \DB::beginTransaction();
        try {

            $this->validator->with($request->only('name'))->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $group = $this->repository->update($request->only('name'), $id);

            /**
             * Check role exist
             * If role is exist then do the job inside, if not then return with message
             */
            if($group)
            {
                /**
                 * [$edit_roles_temp description]
                 * Danh sách role của group
                 * @var [type]
                 */
                $edit_roles_temp = $group->getRoles()->get();

                /**
                 * [$all_roles_temp description]
                 * Tất cả các role được chỉnh sửa trong quản trị
                 * @var [type]
                 */
                $new_roles_temp = $request->role;
                /**
                 * [$all_roles_temp description]
                 * Tất cả các role hiện tại đang có.
                 * @var [type]
                 */

                foreach ($edit_roles_temp as $edit_role) {
                    if(!in_array($edit_role->id, $new_roles_temp))
                    {
                        \Acl::revokeGroupRole($edit_role, $group);
                    }
                }

                foreach($new_roles_temp as $new_role)
                {
                    if(!$edit_roles_temp->where('id', $new_role)->first())
                    {
                        $this->role->skipCriteria();
                        $role = $this->role->findWhere(['id' => $new_role])->first();
                        \Acl::grantGroupRole($role, $group);
                    }
                }
                /**
                 * Get array of permission of role
                 * @var [type]
                 */
                $new_permissions_temp = \Backend::getPermissionValue($request->permission);
                $edit_permissions_temp = \Backend::getPermissionValueFromArray($group->getPermissions());
                $all_permissions_temp = \Backend::getPermissionValueFromCollection($this->permission->all());

                $new_permissions = \Backend::getNewPermission($new_permissions_temp, $edit_permissions_temp, $all_permissions_temp);
                $edit_permissions = \Backend::getEditPermission($new_permissions_temp, $edit_permissions_temp, $all_permissions_temp);

                /*
                 * $new_permission là tiến hành thêm mới permission vào group.
                 * $edit_permission là tiến hành xóa permission hay cập nhật actions cho group là rỗng.
                 * $edit_permissions_temp là tiến hành cập nhật lại actions cho các group này.
                 */

                if($edit_permissions)
                {
                    foreach($edit_permissions as $value)
                    {
                        $permission_arr = explode('.', $value['permission']);
                        $this->permission->skipCriteria();
                        $permission = $this->permission->findWhere(['area' => $permission_arr[0], 'permission' => $permission_arr[1]])->first();
                        if($permission)
                        {
                            \Acl::grantGroupPermission($permission, $group, array(), true);
                        }
                    }
                }

                if($new_permissions_temp)
                {
                    foreach($new_permissions_temp as $value)
                    {
                        $permission_arr = explode('.', $value['permission']);
                        $this->permission->skipCriteria();
                        $permission = $this->permission->findWhere(['area' => $permission_arr[0], 'permission' => $permission_arr[1]])->first();
                        if($permission)
                        {
                            if(isset($value['action']) && $value['action'] != null)
                                \Acl::grantGroupPermission($permission, $group, explode('.', $value['action']), true);
                            else
                                \Acl::grantGroupPermission($permission, $group, array(), true);
                        }
                    }
                }

                \Flash::success(trans('messages.update_success', ['name' => trans('backend.group')]));
            }
            else
            {
                \Flash::warning(trans('messages.update_warning', ['name' => trans('backend.group')]));

                return redirect()->back()->with('message', $response['message']);
            }

            $response = [
                'message' => 'Role Update.',
                'data'    => $group->toArray(),
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

            \Flash::error(trans('messages.update_error', ['name' => trans('backend.group')]));

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
        \DB::beginTransaction();
        try {
            $this->repository->skipCriteria();
            $group = $this->repository->find($id);

            $roles = $group->getRoles()->get();
            foreach ($roles as $role) {
                \Acl::revokeGroupRole($role, $group);
            }

            $permissions = $group->getPermissions()->get();
            foreach ($permissions as $permission) {
                \Acl::revokeGroupPermission($permission, $group);
            }

            $deleted = $this->repository->delete($id);
            if (request()->wantsJson()) {

                return response()->json([
                    'message' => 'Role deleted.',
                    'deleted' => $deleted,
                ]);
            }

            if($deleted)
                \Flash::success(trans('messages.destroy_success', ['name' => trans('backend.group')]));
            else
                \Flash::warning(trans('messages.destroy_warning', ['name' => trans('backend.group')]));

            \DB::commit();
            return redirect()->route('admin.group.index');
        } catch (ValidatorException $e) {
            \DB::rollBack();
            \Flash::warning(trans('messages.destroy_error', ['name' => trans('backend.group')]));

            return redirect()->route('admin.group.index');
        }
    }
}