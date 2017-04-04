<?php

namespace Anhduong\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class MenuNode extends Model implements Transformable
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
    protected $table = 'menu_nodes';

    /**
     * Primary key
     * @var string
     */
    protected $primaryKey = 'id';

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
         'menu_id', 'parent_id', 'related_id', 'type', 'url', 'title', 'icon_font', 'css_class', 'target', 'sort_order',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Timestamp
     * @var boolean
     */
    public $timestamps = true;

    /**
     * @return mixed
     */
    public function menu()
    {
        return $this->belongsTo('Anhduong\Menu\Models\Menu', 'menu_id');
    }

    /**
     * @return mixed
     */
    public function menuNode()
    {
        return $this->hasMany('Anhduong\Menu\Models\MenuNode', 'menu_id');
    }

    /**
     * @return mixed
     */
    public function parent()
    {
        return $this->belongsTo('Anhduong\Menu\Models\MenuNode', 'parent_id');
    }

    /**
     * @return mixed
     */
    public function child()
    {
        return $this->hasMany('Anhduong\Menu\Models\MenuNode', 'parent_id');
    }

    /**
     * @param $theme
     * @return mixed
     */
    public function getRelated($theme = false)
    {
        $item = new \stdClass;
        $item->name = null;
        $item->url = null;
        switch ($this->type) {
            default:
                $item->name = $this->title;
                $item->url = url($this->url);
                break;
        }
        return $item;
    }

    public function hasChild()
    {
        $menu = MenuNode::whereParentId($this->id)->select('id')->first();
        if ($menu) {
            return true;
        } else {
            return false;
        }
    }
}