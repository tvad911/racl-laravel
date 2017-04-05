<?php

namespace Anhduong\Menu\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Anhduong\Menu\Repositories\MenuRepository;
use Anhduong\Menu\Models\Menu;
use Anhduong\Menu\Validators\Backend\MenuValidator;

/**
 * Class MenuRepositoryEloquent
 * @package namespace App\Repositories;
 */
class MenuRepositoryEloquent extends BaseRepository implements MenuRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Menu::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MenuValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
    * [$fieldSearchable description]
    * @var [type]
    */
    protected $fieldSearchable = [
        'id',
        'title' => 'like',
        'slug' => 'like'
    ];

    /**
     * Return value of all count status
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    function itemsCount(array $params)
    {
        return  $param = array(
                    'all'     => $this->itemsCountAll($params),
                    'publish' => $this->itemsCountPublish($params),
                    'draft'   => $this->itemsCountDraft($params),
                    'delete'  => $this->itemsCountTrash($params)
                );
    }

    /**
     * Count all items from Repository
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    function itemsCountAll($params)
    {
        return $this->model->count();
    }

    /**
     * Count all items in Trash
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    function itemsCountTrash($params)
    {
        return $this->model->onlyTrashed()->count();
    }

    /**
     * Count all items with status is publish
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    function itemsCountPublish($params)
    {
        return $this->model->where('status', 1)->count();
    }

    /**
     * Count all items with status is draft
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    function itemsCountDraft($params)
    {
        return $this->model->where('status', 0)->count();
    }

    /**
     * Delete a entity in repository by id
     *
     * @param $id
     *
     * @return int
     */
    public function softDelete($id)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->find($id);
        $originalModel = clone $model;

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $deleted = $model->delete();

        event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }

    /**
     * Softdelete multi in repository in list
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function softDeletesMulti($params)
    {
        foreach ($params as $value) {
            $this->softDelete($value);
        }
    }
    /**
     * Find data by id
     *
     * @param       $id
     * @param array $columns
     *
     * @return mixed
     */
    function findWithTrashed($id, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();
        $model = $this->model->withTrashed()->findOrFail($id, $columns);
        $this->resetModel();

        return $this->parserResult($model);
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function destroy($id)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->findWithTrashed($id);
        $originalModel = clone $model;

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $deleted = $model->forceDelete();

        event(new RepositoryEntityDeleted($this, $originalModel));

        return $deleted;
    }

    /**
     * [destroy description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function destroyMulti($params)
    {
        foreach ($params as $value) {
            $this->destroy($value);
        }
    }

    /**
     * [restore description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function restore($id)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;
        $this->skipPresenter(true);

        $model = $this->findWithTrashed($id);
        $originalModel = clone $model;

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        $deleted = $model->restore();

        event(new RepositoryEntityUpdated($this, $originalModel));

        return $deleted;
    }

    /**
     * Restrore multi items from Repository
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function restoreMulti($params)
    {
        foreach ($params as $value) {
            $this->restore($value);
        }
    }

    /**
     * Update multi items on repository
     * @param  [type] $list_item [description]
     * @param  [type] $params    [description]
     * @return [type]            [description]
     */
    function updates($list_item, $params)
    {
        foreach ($list_item as $value) {
            $this->update($params, $value);
        }
    }

    /**
     * @param $slug
     * @param $active
     * @return mixed
     */
    public function findBySlug($slug, $active, $selects)
    {
        $this->applyCriteria();
        $this->applyScope();
        $menu = $this->model->withTrashed()->where('slug', $slug)->get();

        if ($active) {
            $menu = $menu->where('status', 1);
        }

        $this->resetModel();

        return $this->parserResult($menu->select($selects)->first());
    }

    /**
     * @param $id
     * @return arrayDelete a entity in repository by id.
     */
    public function delete($id)
    {
        try {
            $menu = $this->find($id);

            $menu->delete();

            $related = MenuNode::where('menu_id', '=', $id)->lists('id')->toArray();

            MenuNode::where('menu_id', '=', $id)->delete();

            MenuNode::whereIn('menu_id', $related)->delete();

        } catch (Exception $e) {
            return ['error' => true, 'message' => trans('menu.cannot_delete'), 'response_code' => 500];
        }

        return ['error' => false, 'message' => trans('menu.article_deleted'), 'response_code' => 200];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function createSlug($name)
    {
        $slug = Str::slug($name);
        $index = 1;
        $baseSlug = $slug;
        while ($this->model->where('slug', $slug)->count() > 0) {
            $slug = $baseSlug . '-' . $index++;
        }

        return $slug;
    }

    /**
     * @param $menu_content_id
     * @param $parent_id
     * @param null $selects
     * @return array|\Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getMenuNodes($menu_id, $parent_id, $selects = null)
    {
        return MenuNode::where(['menu_id' => $menu_id, 'parent_id' => $parent_id])
            ->select($selects)
            ->orderBy('sort_order', 'asc')->get();
    }
}