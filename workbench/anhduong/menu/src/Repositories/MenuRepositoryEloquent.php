<?php

namespace Anhduong\Menu\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Anhduong\Menu\Repositories\MenuRepository;
use Anhduong\Menu\Models\Menu;
use Anhduong\Menu\Validators\MenuValidator;

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
}
