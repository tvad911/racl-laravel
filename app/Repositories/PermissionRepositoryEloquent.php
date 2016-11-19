<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PermissionRepository;
use App\Models\Acl\Permission;
use App\Validators\Backend\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Backend;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PermissionValidator::class;
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
        'area' => 'like',
        'permission' => 'like',
        'actions' => 'like'
    ];

    /**
     * Normal delete when model don't has softdelete
     * @param  [type] $params [description]
     * @return [type]         [description]
     */
    function deleteMulti($params)
    {
        foreach ($params as $value) {
            $this->delete($value);
        }
    }
}
