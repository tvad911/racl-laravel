<?php namespace Anhduong\Menu\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Menu facade.
 *
 * @package Anhduong\Menu\Facades
 * @author  <>
 */
class Menu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'menu';
    }
}
