<?php
namespace Anhduong\Menu\Repositories\Criterias\Menu;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class InTrash implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->onlyTrashed();
        return $model;
    }
}