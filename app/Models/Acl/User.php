<?php
namespace App\Models\Acl;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Notifications\Notifiable;
use Signes\Acl\UserInterface as SignesAclUserInterface;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @package    App\Models
 */
class User extends Authenticatable implements SignesAclUserInterface, Transformable
{
    use Notifiable;
    use SoftDeletes;
    use TransformableTrait;
    use HasApiTokens;


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
    protected $table = 'acl_users';

    /**
     * [$dates description]
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login', 'username', 'name', 'email', 'password', 'group_id', 'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['remember_token'];

    /**
     * User personal permissions
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getPermissions()
    {
        return $this->belongsToMany(
            "{$this->namespace}\\Models\\Acl\\Permission",
            'acl_user_permissions',
            'user_id',
            'permission_id'
        )->withPivot('actions')->withTimestamps();
    }

    /**
     * Get user roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function getRoles()
    {
        return $this->belongsToMany(
            "{$this->namespace}\\Models\\Acl\\Role",
            'acl_user_roles',
            'user_id',
            'role_id'
        )->withTimestamps();
    }

    /**
     * Get user group
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function getGroup()
    {
        return $this->hasOne("{$this->namespace}\\Models\\Acl\\Group", 'id', 'group_id');
    }
}