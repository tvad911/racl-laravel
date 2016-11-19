<?php
namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\Backend\UserCreateRequest;
use App\Http\Requests\Backend\UserUpdateRequest;
use App\Repositories\UserRepository;
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


    public function __construct(UserRepository $repository, UserValidator $validator)
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

        return view('backends.users.create');
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
        $input = $request->only('email', 'username', 'name', 'status');
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

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $item,
            ]);
        }

        return view('backends.users.show', compact('item'));
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

        return view('backends.users.edit', compact('item'));
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
        $input = $request->only('email', 'username','name', 'status');
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
            \Flash::success(trans('messages.delete_success', ['name' => trans('backend.user')]));
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
}