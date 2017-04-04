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

        return view('menu::backends.menus.index', compact('items','total','params', 'options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menu::backends.menus.create');
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

        return view('menu::backends.menus.show', compact('item'));
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

        return view('menu::backends.menus.edit', compact('item'));
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

    // /**
    //  * @param $id
    //  */
    // public function getEdit($id)
    // {

    //     $oldInputs = old();
    //     if ($oldInputs && $id == 0) {
    //         $oldObject = new \stdClass();
    //         foreach ($oldInputs as $key => $row) {
    //             $oldObject->$key = $row;
    //         }
    //         $menu = $oldObject;
    //     } else {
    //         $menu = $this->menuRepository->findById($id);
    //         if (!$menu) {
    //             $menu = $this->menuRepository->getModel();
    //         }
    //     }

    //     $categories = \Botble\Menu\Facades\Menu::generateSelect('category', 0, 1);
    //     $tags = \Botble\Menu\Facades\Menu::generateSelect('tag', 0, 1);
    //     $pages = \Botble\Menu\Facades\Menu::generateSelect('page', 0, 1);
    //     $nestables = \Botble\Menu\Facades\Menu::generateMenu($menu->slug, 0);

    //     return view('menu::edit', compact('menu', 'categories', 'tags', 'pages', 'nestables'));
    // }

    // /**
    //  * @param MenuRequest $request
    //  * @param Menu $object
    //  * @param MenuContent $objectContent
    //  * @param MenuNode $objectNode
    //  * @param $id
    //  */
    // public function postEdit(MenuRequest $request, Menu $object, MenuContent $objectContent, MenuNode $objectNode, $id)
    // {
    //     $menu = $object->findOrNew($id);

    //     $menu->name = $request->name;
    //     $menu->save();

    //     $menuContent = $objectContent->where(['menu_id' => $menu->id])->first();
    //     if (!$menuContent) {
    //         $menuContent = new MenuContent;
    //         $menuContent->menu_id = $menu->id;
    //         $menuContent->save();
    //     }

    //     $menuNodesJson = json_decode($request->get('menu_nodes', null));

    //     /*Deleted nodes*/
    //     $deletedNodes = explode(' ', ltrim($request->get('deleted_nodes', '')));
    //     $objectNode->whereIn('id', $deletedNodes)->delete();
    //     $this->_recursiveSaveMenu($menuNodesJson, $menuContent->id, 0);
    //     event(new AuditHandlerEvent('Menu', 'updated', $id));

    //     return redirect()->route('menus.edit', $id)->with('success_msg', trans('notices.update_success_message'));
    // }

    // /**
    //  * @param $id
    //  */
    // public function getDelete($id)
    // {
    //     $response = $this->menuRepository->delete($id);
    //     event(new AuditHandlerEvent('Menu', 'deleted', $id));

    //     return response()->json($response, $response['response_code']);
    // }

    // /**
    //  * @param Request $request
    //  */
    // public function postDeleteMany(Request $request)
    // {
    //     $ids = $request->input('ids');
    //     if (empty($ids)) {
    //         return response()->json(['error' => true, 'message' => trans('menu.notices.no_select')]);
    //     }

    //     foreach ($ids as $id) {
    //         $response = $this->menuRepository->delete($id);
    //         event(new AuditHandlerEvent('Menu', 'deleted', $id));
    //     }

    //     return response()->json($response, $response['response_code']);
    // }

    // /**
    //  * @param Request $request
    //  */
    // public function postChangeStatus(Request $request)
    // {
    //     $ids = $request->input('ids');
    //     if (empty($ids)) {
    //         return response()->json(['error' => true, 'message' => trans('menu.notices.no_select')]);
    //     }

    //     foreach ($ids as $id) {
    //         $menu = $this->menuRepository->findById($id);
    //         $menu->status = $request->input('status');
    //         $menu = $this->menuRepository->createOrUpdate($menu);
    //         event(new AuditHandlerEvent('Menu', 'updated', $id));
    //     }

    //     return response()->json(['error' => false, 'message' => trans('menu.notices.update_success_message')]);
    // }

    // /**
    //  * @param $json_item
    //  * @param $menu_content_id
    //  * @param $parent_id
    //  * @return mixed
    //  */
    // private function _saveMenuNode($json_item, $menu_content_id, $parent_id)
    // {
    //     if (isset($json_item->id)) {
    //         $item = MenuNode::find($json_item->id);
    //     }
    //     if (!$item) {
    //         $item = new MenuNode();
    //     }

    //     $item->title = (isset($json_item->title)) ? $json_item->title : '';
    //     $item->url = (isset($json_item->customurl)) ? $json_item->customurl : '';
    //     $item->css_class = (isset($json_item->class)) ? $json_item->class : '';
    //     $item->position = (isset($json_item->position)) ? $json_item->position : '';
    //     $item->icon_font = (isset($json_item->iconfont)) ? $json_item->iconfont : '';
    //     $item->type = (isset($json_item->type)) ? $json_item->type : '';
    //     $item->menu_content_id = $menu_content_id;
    //     $item->parent_id = $parent_id;

    //     switch ($json_item->type) {
    //         case 'custom-link':
    //             $item->related_id = 0;
    //             break;
    //         default:
    //             $item->related_id = (int) $json_item->relatedid;
    //             break;
    //     }

    //     $item->save();

    //     return $item->id;
    // }

    // /**
    //  * @param $json_arr
    //  * @param $menu_content_id
    //  * @param $parent_id
    //  */
    // private function _recursiveSaveMenu($json_arr, $menu_content_id, $parent_id)
    // {
    //     foreach ((array) $json_arr as $key => $row) {
    //         $parent = $this->_saveMenuNode($row, $menu_content_id, $parent_id);
    //         if ($parent != null) {
    //             if (!empty($row->children)) {
    //                 $this->_recursiveSaveMenu($row->children, $menu_content_id, $parent);
    //             }
    //         }
    //     }
    // }
}