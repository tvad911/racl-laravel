<?php
namespace Anhduong\Menu\Repositories\Criterias\Menu;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class StatusDraft implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('status','=', 0 );
        return $model;
    }
}