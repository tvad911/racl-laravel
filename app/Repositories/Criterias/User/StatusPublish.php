<?php
namespace App\Repositories\Criterias\User;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class StatusPublish implements CriteriaInterface {

    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model->where('status','=', 1 );
        return $model;
    }
}