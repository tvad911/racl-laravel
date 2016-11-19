<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Backend\PermissionCreateRequest;
use App\Http\Requests\Backend\PermissionUpdateRequest;
use App\Repositories\PermissionRepository;
use App\Validators\Backend\PermissionValidator;


class PermissionsController extends Controller
{

    /**
     * @var PermissionRepository
     */
    protected $repository;

    /**
     * @var PermissionValidator
     */
    protected $validator;

    public function __construct(PermissionRepository $repository, PermissionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
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
            })->paginate($options['items_per_page'], array('id', 'area', 'permission', 'actions', 'created_at', 'updated_at'));

        return view('backends.permissions.index', compact('items', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backends.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PermissionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            if($permission = \Acl::createPermission($request->area, $request->permission, explode('.', $request->actions), $request->description))
            {
                $response = [
                    'message' => 'Permission created.',
                    'data'    => $permission->toArray(),
                ];

                if ($request->wantsJson()) {

                    return response()->json($response);
                }

                \Flash::success(trans('messages.add_success', ['name' => trans('backend.permission')]));

                return redirect()->route('admin.permission.index');
            }
            else
            {
                \Flash::warning(trans('messages.add_warning', ['name' => trans('backend.permission')]));

                return redirect()->back()->with('message', $response['message']);
            }

        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            \Flash::error(trans('messages.add_error', ['name' => trans('backend.permission')]));

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

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $item,
            ]);
        }

        return view('backends.permissions.show', compact('item'));
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

        return view('backends.permissions.edit', compact('item'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PermissionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        try {
            $this->validator->with($request->only('area', 'permission', 'actions', 'description'))->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $input = $request->only('area', 'permission', 'description');
            $input['actions'] = serialize(explode('.', $request->actions));

            if($permission = $this->repository->update($input, $id))
            {
                \Flash::success(trans('messages.update_success', ['name' => trans('backend.permission')]));

                $response = [
                    'message' => 'Permission updated.',
                    'data'    => $permission->toArray(),
                ];

                if ($request->wantsJson()) {

                    return response()->json($response);
                }

                return redirect()->route('admin.permission.index');
            }
            else
            {
                \Flash::warning(trans('messages.update_warning', ['name' => trans('backend.permission')]));
                return redirect()->back()->with('message', $response['message']);
            }


        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }
            \Flash::error(trans('messages.update_error', ['name' => trans('backend.permission')]));

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
        if($deleted = $this->repository->delete($id))
            \Flash::success(trans('messages.destroy_success', ['name' => trans('backend.permission')]));
        else
            \Flash::warning(trans('messages.destroy_warning', ['name' => trans('backend.permission')]));

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Permission deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Permission deleted.');
    }

    /**
     * [updateMulti description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function postUpdateMulti(Request $request)
    {
        $list_item = $request->items;

        if(isset($request->doAction) && $list_item != null)
        {
            if($request->doAction == 'delete')
            {
                $this->repository->deleteMulti($list_item);
                \Flash::success(trans('messages.update_success', ['name' => trans('backend.permission')]));
            }
        }

        return redirect()->route('admin.permission.index');
    }
}