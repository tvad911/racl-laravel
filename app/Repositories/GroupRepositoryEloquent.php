<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\GroupRepository;
use App\Models\Acl\Group;
use App\Validators\Backend\GroupValidator;

/**
 * Class GroupRepositoryEloquent
 * @package namespace App\Repositories;
 */
class GroupRepositoryEloquent extends BaseRepository implements GroupRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Group::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return GroupValidator::class;
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
        'name' => 'like'
    ];
}
