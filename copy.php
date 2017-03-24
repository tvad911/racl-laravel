<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Baum\Node;
class User extends Node implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;
    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

     /**
     * [$primaryKey description]
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = ['name', 'email', 'password', 'status'];
    protected $fillable = ['username', 'email', 'password',
                                'fullname', 'birthday', 'place_of_birth', 'address_1', 'address_2', 'gender',
                                'social_id', 'date_of_issue', 'place_of_issue', 'name_of_bank',
                                'bank_code', 'place_of_bank', 'parent_id', 'group_id', 'type', 'status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    protected $softDeletes = true;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Set new value for attribute
     * @param [string] $value [bcrypt]
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * [setParentIdAttribute description]
     * @param [type] $value [description]
     */
    public function setParentIdAttribute($value){
        $this->attributes['parent_id'] = $value == "null" ? null : $value;
    }

    /**
    * [$parentColumn description]
    * @var string
    */
    protected $parentColumn = 'parent_id';

    /**
    * [$leftColumn description]
    * @var string
    */
    protected $leftColumn = 'lft';

    /**
    * [$rightColumn description]
    * @var string
    */
    protected $rightColumn = 'rgt';

    /**
    * [$depthColumn description]
    * @var string
    */
    protected $depthColumn = 'depth';

    /**
    * [$guarded description]
    * @var array
    */
    protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

    /**
     * [categories description]
     * @return [type] [description]
     */
    public function categories()
    {
        return $this->hasMany('App\Models\Category', 'user_id');
    }

    /**
     * [news description]
     * @return [type] [description]
     */
    public function news()
    {
        return $this->hasMany('App\Models\News', 'user_id');
    }

    /**
     * [user description]
     * @return [type] [description]
     */
    public function group()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }
    /**
     * [salary description]
     * @return [type] [description]
     */
    public function salary()
    {
        return $this->hasMany('App\Models\Salary', 'created_by', 'id');
    }
}