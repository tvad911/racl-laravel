<?php

namespace App\Models\Acl;

use Illuminate\Database\Eloquent\Model;
use Signes\Acl\PermissionInterface;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Permission
 *
 * @package Signes\Acl\Model
 */
class Permission extends Model implements PermissionInterface, Transformable
{

    use TransformableTrait;


    /**
     * Application namespace
     *
     * @var string
     */
    protected $namespace = "App";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'acl_permissions';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Mass fillable columns
     *
     * @var array
     */
    protected $fillable = array('area', 'permission', 'actions', 'description');
}