<?php
    /**
     * @param $slug
     * @param int $parent_id
     * @param string $view
     * @param bool $active
     * @param bool $theme
     * @param array $options
     * @return mixed|null|string
     */
    public function generateMenu($slug, $parent_id = 0, $view = 'menu::backends.menus.partials.menu', $active = false, $theme = false, $options = [])
    {
        $menu = $this->menuRepository->findBySlug($slug, $active, ['id', 'slug']);
        if (!$menu) {
            return null;
        }

        $menu_nodes = $this->menuRepository->getMenuNodes($menu->id, $parent_id, ['id', 'menu_id', 'parent_id', 'related_id', 'icon_font', 'css_class', 'url', 'title', 'type']);

        if ($theme) {
            $html = Theme::partial($view, compact('menu_nodes', 'menu', 'options'));
        } else {
            $html = view($view, compact('menu_nodes', 'menu', 'options'))->render();
        }

        return $html;
    }

    /**
     * @param $type
     * @param bool $parent_id
     * @param bool $status
     * @param string $view
     * @param bool $theme
     * @param array $options
     * @return mixed|null|string
     */
    public function generateSelect($type, $parent_id = false, $status = false, $view = 'menu::backends.menus.partials.select', $theme = false, $options = [])
    {
        if (empty($object)) {
            return null;
        }

        if ($theme) {
            return Theme::partial($view, compact('object', 'type', 'options'));
        } else {
            return view($view, compact('object', 'type', 'options'))->render();
        }
    }
    /**
     * @param $slug
     * @param $active
     */
    public function hasMenu($slug, $active)
    {
        $menu = $this->menuRepository->findBySlug($slug, $active);
        if (!$menu) {
            return false;
        }
        return true;
    }