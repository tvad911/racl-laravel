<?php

namespace Anhduong\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Menu extends Model implements Transformable
{
    use Notifiable;
    use SoftDeletes;
    use TransformableTrait;

	/**
     * Application namespace
     *
     * @var string
     */
    protected $namespace = "Anhduong\Menu";

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'menus';

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
        'title', 'slug', 'status',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * @return mixed
     */
    public function menuNode()
    {
        return $this->hasMany('Anhduong\Menu\Models\MenuNode', 'menu_id');
    }
}