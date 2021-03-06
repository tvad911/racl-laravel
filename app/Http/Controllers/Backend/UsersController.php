<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Backend\UserCreateRequest;
use App\Http\Requests\Backend\UserUpdateRequest;
use App\Http\Requests\Backend\UserUpdatePermisionRequest;
use App\Repositories\UserRepository;
use App\Repositories\GroupRepository;
use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use App\Validators\Backend\UserValidator;

class UsersController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;


    public function __construct(UserRepository $repository, UserValidator $validator, GroupRepository $group, PermissionRepository $permission, RoleRepository $role)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
        $this->permission = $permission;
        $this->role = $role;
        $this->group = $group;
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
        $params = $this->repository->itemsCount($this->para);
        $options = $this->para;

        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        if($options['in_trash'] == 'yes')
        {
            $this->repository->pushCriteria(app('App\Repositories\Criterias\User\InTrash'));
        }
        switch ($options['status']) {
            case 'publish':
                $this->repository->pushCriteria(app('App\Repositories\Criterias\User\StatusPublish'));
                break;

            case 'draft':
                $this->repository->pushCriteria(app('App\Repositories\Criterias\User\StatusDraft'));
                break;

            default:
                break;
        }
        $items = $this->repository->scopeQuery(function($query){
                return $query->orderBy('id','desc');
            })->paginate($options['items_per_page'], array('id', 'name', 'username', 'email', 'created_at', 'updated_at', 'status'));

        return view('backends.users.index', compact('items','total','params', 'options'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = $this->group->all();

        return view('backends.users.create', compact('groups'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $input = $request->only('email', 'username', 'name', 'group_id', 'status');
        $input['login'] = $request->email;
        $input['password'] = bcrypt($request->password);
        if($this->repository->create($input))
        {
            \Flash::success(trans('messages.add_success', ['name' => trans('backend.user')]));
        }
        else
        {
            \Flash::warning(trans('messages.add_warning', ['name' => trans('backend.user')]));
        }

        return redirect()->route('admin.user.index');
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
        $groups = $this->group->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $item,
            ]);
        }

        return view('backends.users.show', compact('item', 'groups'));
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
        $groups = $this->group->all();

        return view('backends.users.edit', compact('item', 'groups'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $input = $request->only('email', 'username','name', 'group_id', 'status');
        $password = $request->password;
        $passwordConfirmation = $request->password_confirmation;

        if (!empty($password)) {
            if ($password === $passwordConfirmation) {
                $input['password'] = bcrypt($password);
            }
        }

        if($item = $this->repository->update($input, $id))
        {
            \Flash::success(trans('messages.update_success', ['name' => trans('backend.user')]));
            $response = [
                'message' => 'User updated.',
                'data'    => $item->toArray(),
            ];

            if ($request->wantsJson()) {
                return response()->json($response);
            }
        }
        else
        {
            \Flash::warning(trans('messages.update_warning', ['name' => trans('backend.user')]));
            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
        }

        return redirect()->route('admin.user.index');
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
        if($deleted = $this->repository->delete($id))
            \Flash::success(trans('messages.destroy_success', ['name' => trans('backend.user')]));
        else
            \Flash::warning(trans('messages.destroy_warning', ['name' => trans('backend.user')]));

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'User deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'User deleted.');
    }

    /**
     * [postUpdateMulti description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUpdateMulti(Request $request)
    {
        $list_item = $request->items;
        if(isset($request->doAction))
        {
            if($request->doAction == 'publish')
            {
                $params = array('status' => 1);
                $this->repository->updates($list_item, $params);
            }
            elseif($request->doAction == 'draft')
            {
                $params = array('status' => 0);
                $this->repository->updates($list_item, $params);
            }
            elseif($request->doAction == 'trash')
            {
                $this->repository->softDeletesMulti($list_item);
            }
            elseif($request->doAction == 'restore')
            {
                $this->repository->restoreMulti($list_item);
            }
            elseif($request->doAction == 'delete')
            {
                $this->repository->destroyMulti($list_item);
            }
        }

        return redirect()->route('admin.user.index');
    }

    /**
     * Export data to csv type
     * @return [type] [description]
     */
    public function export($type)
    {
        $options = $this->para;
        $items = $this->repository->scopeQuery(function($query){
                return $query->orderBy('id','desc');
            })->all(array('id', 'username', 'email', 'name', 'created_at', 'updated_at', 'status'));

        \Excel::create('Filename', function($excel) use($items) {

            $excel->sheet('Sheetname', function($sheet) use($items) {

                // Set auto size for sheet
                $sheet->setAutoSize(true);

                $sheet->cells('A1:G1', function($cells) {
                    $cells->setBackground('#000000');
                    $cells->setFontWeight('bold');
                });
                $sheet->fromArray($items, null, 'A1', true);
            });

        })->export($type);
    }

    /**
     * [permission description]
     * @return [type] [description]
     */
    public function permission($id)
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

        return view('backends.users.permission', compact('item', 'roles', 'edit_roles', 'permissions', 'edit_permissions'));
    }

    /**
     * [updatePermission description]
     * @param  UserUpdatePermisionRequest $request [description]
     * @param  [type]                     $id      [description]
     * @return [type]                              [description]
     */
    public function updatePermission(UserUpdatePermisionRequest $request, $id)
    {
        \DB::beginTransaction();
        try {
            $user = $this->repository->find($id);
            if($user)
            {
                $edit_roles_temp = $user->getRoles()->get();
                $new_roles_temp = $request->role;

                foreach ($edit_roles_temp as $edit_role) {
                    if(!in_array($edit_role->id, $new_roles_temp))
                    {
                        \Acl::revokeUserRole($edit_role, $user);
                    }
                }

                foreach($new_roles_temp as $new_role)
                {
                    if(!$edit_roles_temp->where('id', $new_role)->first())
                    {
                        $this->role->skipCriteria();
                        $role = $this->role->findWhere(['id' => $new_role])->first();
                        \Acl::grantUserRole($role, $user);
                    }
                }

                $new_permissions_temp = \Backend::getPermissionValue($request->permission);
                $edit_permissions_temp = \Backend::getPermissionValueFromArray($user->getPermissions());
                $all_permissions_temp = \Backend::getPermissionValueFromCollection($this->permission->all());

                $new_permissions = \Backend::getNewPermission($new_permissions_temp, $edit_permissions_temp, $all_permissions_temp);
                $edit_permissions = \Backend::getEditPermission($new_permissions_temp, $edit_permissions_temp, $all_permissions_temp);

                if($edit_permissions)
                {
                    foreach($edit_permissions as $value)
                    {
                        $permission_arr = explode('.', $value['permission']);
                        $this->permission->skipCriteria();
                        $permission = $this->permission->findWhere(['area' => $permission_arr[0], 'permission' => $permission_arr[1]])->first();
                        if($permission)
                        {
                            \Acl::grantUserPermission($permission, $user, array(), true);
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
                                \Acl::grantUserPermission($permission, $user, explode('.', $value['action']), true);
                            else
                                \Acl::grantUserPermission($permission, $user, array(), true);
                        }
                    }
                }

                \Flash::success(trans('messages.update_success', ['name' => trans('backend.user')]));
            }
            else
            {
                \Flash::warning(trans('messages.update_warning', ['name' => trans('backend.user')]));

                return redirect()->back()->with('message', $response['message']);
            }

            $response = [
                'message' => 'Role Update.',
                'data'    => $user->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            \DB::commit();
            return redirect()->route('admin.user.index');
        } catch (ValidatorException $e) {
            \DB::rollBack();
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            \Flash::error(trans('messages.update_error', ['name' => trans('backend.user')]));

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }
}