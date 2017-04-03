<?php

namespace Anhduong\Menu\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
            $this->repository->pushCriteria(app('Anhduong\Menu\Repositories\Criterias\Menu\InTrash'));
        }
        switch ($options['status']) {
            case 'publish':
                $this->repository->pushCriteria(app('Anhduong\Menu\Repositories\Criterias\Menu\StatusPublish'));
                break;

            case 'draft':
                $this->repository->pushCriteria(app('Anhduong\Menu\Repositories\Criterias\Menu\StatusDraft'));
                break;

            default:
                break;
        }
        $items = $this->repository->scopeQuery(function($query){
                return $query->orderBy('id','desc');
            })->paginate($options['items_per_page'], array('id', 'title', 'slug', 'status'));

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $items,
            ]);
        }

        return view('vendor.menu.backends.menus.index', compact('items','total','params', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendor.menu.backends.menus.create');
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
        $input = $request->only('title', 'slug', 'status');

        if($item = $this->repository->create($input))
        {
            \Flash::success(trans('messages.add_success', ['name' => trans('backend.user')]));
        }
        else
        {
            \Flash::warning(trans('messages.add_warning', ['name' => trans('backend.user')]));
        }

        $response = [
            'message' => 'Menu created.',
            'data'    => $item->toArray(),
        ];

        if ($request->wantsJson()) {

            return response()->json($response);
        }

        return redirect()->route('admin.menu.index');
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

        return view('vendor.menu.backends.menus.show', compact('item'));
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

        return view('vendor.menu.backends.menus.edit', compact('item'));
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
     * Get the map of resource methods to ability names.
     *
     * @return array
     */
    protected function resourceAbilityMap()
    {
        return [
            'index' => 'index',
            'create' => 'create',
            'store' => 'store',
            'show' => 'show',
            'edit' => 'edit',
            'update' => 'update',
            'destroy' => 'destroy',
            'delete' => 'delete'
        ];
    }
}