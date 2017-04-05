<?php
namespace Anhduong\Menu;

use Anhduong\Menu\Repositories\MenuRepository;
/**
 * The Menu facade.
 *
 * @package Anhduong\Menu
 * @author  <>
 */
class Menu
{

	/**
     * @var mixed
     */
    protected $menuRepository;

    /**
     * @param MenuRepositoryEloquent $menu
     */
    public function __construct(MenuRepository $menu)
    {
        $this->menuRepository = $menu;
    }

    public function welcome() {
        return 'Welcome to Anhduong\Menu package';
    }
}
