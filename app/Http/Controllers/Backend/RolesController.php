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
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Role deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Role deleted.');
    }

    function test()
    {
        // $group = new \App\Models\Acl\Group();
        // $group->name = 'MyGroup1';
        // $group->save();

        /**
         * Create and save example Roles
         */
        // $role1 = new \App\Models\Acl\Role();
        // $role1->name = 'My Role 1';
        // $role1->save();

        // $role2 = new \App\Models\Acl\Role();
        // $role2->name = 'My Role 2';
        // $role2->save();

        // $role3 = new \App\Models\Acl\Role();
        // $role3->name = 'My Role 3';
        // $role3->filter = 'R';
        // $role3->save();

        /**
         * Create and save example permissions
         */
        // $permission1 = \Acl::createPermission('zone1', 'access1', ['act1', 'act2', 'act3'], 'Zone 1');
        // $permission2 = \Acl::createPermission('zone2', 'access2', ['act1', 'act2', 'act3'], 'Zone 2');
        // $permission3 = \Acl::createPermission('zone3', 'access3', ['act1', 'act2', 'act3'], 'Zone 3');

        /**
         * When we have ready entity lets connect them
         */
        // $guestUser = \Auth::user();
        // $guestUser->group_id = $group->id;
        // $guestUser->save();


        // // Connect user with permissions
        // \Acl::grantUserPermission($permission1, $guestUser, ['act1']);
        // \Acl::grantUserPermission($permission2, $guestUser, ['act1', 'act2', 'act3']);

        // // Connect group with permissions
        // \Acl::grantGroupPermission($permission1, $group, ['act3']);

        // // Connect roles with permissions
        // \Acl::grantRolePermission($permission3, $role1, ['act1']);
        // \Acl::grantRolePermission($permission1, $role2, ['act2']);
        // \Acl::grantRolePermission($permission2, $role3, ['act2']);

        // // Connect user with roles
        // \Acl::grantUserRole($role2, $guestUser);
        // \Acl::grantUserRole($role3, $guestUser);

        // // Connect group with roles
        // \Acl::grantGroupRole($role1, $group);
        // \Acl::grantGroupRole($role2, $group);

        // dd($guestUser->getPermissions);

        // $group = $guestUser->getGroup;
        // dd($group->getPermissions);
        // $resource_A = "zone2.access2|act2";
        // dd(\Acl::isAllow($resource_A, $guestUser));
        // $role1 = \App\Models\Acl\Role::find(1);
        // $permission3 = \App\Models\Acl\Permission::find(3);

        // \Acl::grantRolePermission($permission3, $role1, ['act2']);
        // dd($role1);

    }
}
