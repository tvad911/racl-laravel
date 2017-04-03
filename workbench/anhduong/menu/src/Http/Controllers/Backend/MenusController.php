<?php

namespace Anhduong\Menu\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Anhduong\Menu\Http\Requests\Backend\MenuCreateRequest;
use Anhduong\Menu\Http\Requests\Backend\MenuUpdateRequest;
use Anhduong\Menu\Repositories\MenuRepository;
use Anhduong\Menu\Validators\Backend\MenuValidator;


class MenusController extends Controller
{

    /**
     * @var MenuRepository
     */
    protected $repository;

    /**
     * @var MenuValidator
     */
    protected $validator;

    public function __construct(MenuRepository $repository, MenuValidator $validator)
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

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $menus,
            ]);
        }

        return view('backends.users.index', compact('items','total','params', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MenuCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MenuCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $menu = $this->repository->create($request->all());

            $response = [
                'message' => 'Menu created.',
                'data'    => $menu->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $menu = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $menu,
            ]);
        }

        return view('menus.show', compact('menu'));
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

        $menu = $this->repository->find($id);

        return view('menus.edit', compact('menu'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  MenuUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(MenuUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $menu = $this->repository->update($id, $request->all());

            $response = [
                'message' => 'Menu updated.',
                'data'    => $menu->toArray(),
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
                'message' => 'Menu deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Menu deleted.');
    }
}