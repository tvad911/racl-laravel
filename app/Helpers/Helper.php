<?php
if (!function_exists('custom_paging')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array  $array
     * @return array
     */
    function custom_paging($items, $sort_by, $sort_order, $items_per_page)
    {
        return with(new \App\Libraries\Helper\CustomPaginationLinks($items->appends(['sort_by' => $sort_by, 'sort_order'=> $sort_order, 'items_per_page' => $items_per_page])))->render();
    }
}

if (!function_exists('items_on_total')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array  $array
     * @return array
     */
    function items_on_total($items)
	{
		return with(new \App\Libraries\Helper\CustomPaginationLinks($items))->itemNumber();
	}
}
if (!function_exists('show_status')) {
    /**
     * Assign high numeric IDs to a config item to force appending.
     *
     * @param  array  $array
     * @return array
     */
    function show_status($status)
    {
        $type = '';
        if($status == 0)
        {
            $type = 'danger';
        }
        else
        {
            $type = 'success';
        }
        return sprintf('<span class="label label-%s">%s</span>', $type, ($status == 0) ? 'Unactive' : 'Active');
    }
}