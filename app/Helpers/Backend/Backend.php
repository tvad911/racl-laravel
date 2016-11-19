<?php
namespace App\Helpers\Backend;

class Backend
{
	/**
	 * [breadscrumb description]
	 * @param  [type] $name   [description]
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	function breadscrumb($name, $option)
	{
		$html =
			'<ol class="breadcrumb">
	            <li><a href="#"><i class="fa fa-dashboard"></i>'. trans($name) .'</a></li>
	            <li class="active">'. trans($option) .'</li>
	        </ol>';
		return $html;
	}
	/**
	 * [columns_sort description]
	 * @param  [type] $name     [description]
	 * @param  [type] $column   [description]
	 * @param  [type] $sortedBy [description]
	 * @param  [type] $options  [description]
	 * @return [type]           [description]
	 */
	function columns_sort($name, $column, $sortedBy, $options)
	{
        if ($options['orderBy'] != $column)
            $type = '';
        else
            $type = '-'. strtolower($options['sortedBy']);
        if((isset($options['searchFields']) && $options['searchFields'] != null) && (isset($options['search']) && $options['search'] != null))
        {
        	return sprintf('<th>
		    					%s
						    	<a href="?searchFields=%s&search=%s&status=%s&orderBy=%s&sortedBy=%s&items_per_page=%s&in_trash=%s"><i class="fa fa-sort%s"></i></a>
							</th>', $name, $options['searchFields'], $options['search'], $options['status'], $column, $sortedBy, $options['items_per_page'], $options['in_trash'], $type);
        }
        else
        	return sprintf('<th>
		    					%s
						    	<a href="?status=%s&orderBy=%s&sortedBy=%s&items_per_page=%s&in_trash=%s"><i class="fa fa-sort%s"></i></a>
							</th>', $name, $options['status'], $column, $sortedBy, $options['items_per_page'], $options['in_trash'], $type);

	}
	/**
	 * Show sort url in permission page or page doen't has in_trash or status
	 * @param  [type] $name     [description]
	 * @param  [type] $column   [description]
	 * @param  [type] $sortedBy [description]
	 * @param  [type] $options  [description]
	 * @return [type]           [description]
	 */
	function columns_sortDiff($name, $column, $sortedBy, $options)
	{
        if ($options['orderBy'] != $column)
            $type = '';
        else
            $type = '-'. strtolower($options['sortedBy']);
        if((isset($options['searchFields']) && $options['searchFields'] != null) && (isset($options['search']) && $options['search'] != null))
        {
        	return sprintf('<th>
		    					%s
						    	<a href="?searchFields=%s&search=%s&orderBy=%s&sortedBy=%s&items_per_page=%s&in_trash=%s"><i class="fa fa-sort%s"></i></a>
							</th>', $name, $options['searchFields'], $options['search'], $column, $sortedBy, $options['items_per_page'], $options['in_trash'], $type);
        }
        else
        	return sprintf('<th>
		    					%s
						    	<a href="?orderBy=%s&sortedBy=%s&items_per_page=%s&in_trash=%s"><i class="fa fa-sort%s"></i></a>
							</th>', $name, $column, $sortedBy, $options['items_per_page'], $options['in_trash'], $type);

	}
	/**
	 * Columns in none sort
	 * @param  [type] $name   [description]
	 * @param  [type] $column [description]
	 * @return [type]         [description]
	 */
	function columns_none_sort($name, $column, $sortedBy, $options)
	{
        return sprintf('<th>%s</th>', $name);

	}
	/**
	 * [items_on_total description]
	 * @param  [type] $items [description]
	 * @return [type]        [description]
	 */
	function items_on_total($items)
	{
		return with(new \App\Helpers\Paging\CustomPaginationLinks($items))->itemNumber();
	}

	function items_on_totals($paginator, $text = 'Items %s to %s of %s total')
	{
		if($paginator->total() == 0)
        {
            if($paginator->currentPage() !=1)
            {
                $from = 0;
            }else{
                $from = 0;
            }
            $to = $paginator->currentPage() * $paginator->perPage();
            if($to > $paginator->total())
            {
                $to = $paginator->total();
            }
            $total = $paginator->total();
            return sprintf($text,$from,$to,$total);
        }
        else
        {
            if($paginator->currentPage() !=1)
            {
                $from = ($paginator->currentPage() - 1) * $paginator->perPage() + 1;
            }else{
                $from = 1;
            }
            $to = $paginator->currentPage() * $paginator->perPage();
            if($to > $paginator->total())
            {
                $to = $paginator->total();
            }
            $total = $paginator->total();
            return sprintf($text,$from,$to,$total);
        }
	}
	/**
	 * [paging description]
	 * @param  [type] $items [description]
	 * @return [type]        [description]
	 */
	function paging($items, $options)
	{
		if((isset($options['searchFields']) && $options['searchFields'] != null) && (isset($options['search']) && $options['search'] != null))
		{
			return with(new \App\Helpers\Paging\CustomPaginationLinks($items->appends(['searchFields' => $options['searchFields'], 'search' => $options['search'], 'status' => $options['status'], 'orderBy' => $options['orderBy'],'sortedBy'=> $options['sortedBy'], 'items_per_page' => $options['items_per_page'], 'in_trash' => $options['in_trash']])))->render();
		}
		else
		{
			return with(new \App\Helpers\Paging\CustomPaginationLinks($items->appends(['status' => $options['status'], 'orderBy' => $options['orderBy'],'sortedBy'=> $options['sortedBy'], 'items_per_page' => $options['items_per_page'], 'in_trash' => $options['in_trash']])))->render();
		}
	}

	/**
	 * Show paging url in permission page or page doen't has in_trash or status
	 * @return [type] [description]
	 */
	function pagingNone($items, $options)
	{
		return with(new \App\Helpers\Paging\CustomPaginationLinks($items->appends(['orderBy'=> $options['orderBy'],'sortedBy'=> $options['sortedBy'], 'items_per_page'=> $options['items_per_page']])))->render();
	}
	/**
	 * [show_error description]
	 * @param  [type] $errors [description]
	 * @return [type]         [description]
	 */
	function show_error($errors)
	{
		$html = '';
		if(count($errors) > 0)
		{
			$html .=
			'<div class="alert alert-danger">
				<strong>'. trans('messages.whoops') .'</strong>'. trans('messages.message_error') .'
				<br><br>
				<ul>';
				  	foreach($errors->all() as $error)
				  	{
				  		$html .= '<li>'. $error .'</li>';
				  	}
			$html .=
				'</ul>
			</div>';
		}
		return $html;
	}
	/**
	 * [count_backend description]
	 * @param  [type] $params [description]
	 * @return [type]         [description]
	 */
	function count_backend($params)
	{
		$all = '<a href="?status=all">All ('. $params['all'] .')</a> |';
		$publish = '<a href="?status=publish">Publish ('. $params['publish'] .')</a> |';
		$draft = '<a href="?status=draft">Draft ('. $params['draft'] .')</a> |';
		$delete = '<a href="?in_trash=yes">Trash ('. $params['delete'] .')</a>';
		return sprintf('<label for="">%s %s %s %s</label>', $all, $publish, $draft, $delete);
	}
	/**
	 * [count_items_backend description]
	 * @param  [type] $params  [description]
	 * @param  [type] $options [description]
	 * @return [type]          [description]
	 */
	function count_items_backend($params, $options)
	{
		if((isset($options['searchFields']) && $options['searchFields'] != null) && (isset($options['search']) && $options['search'] != null))
		{
			$all = sprintf('<a href="?searchFields=%s&search=%s&status=all&items_per_page=%s">All ( %s )</a> |', $options['searchFields'], $options['search'], $options['items_per_page'], $params['all']);
			$publish = sprintf('<a href="?searchFields=%s&search=%s&status=publish&items_per_page=%s">Publish ( %s )</a> |', $options['searchFields'], $options['search'], $options['items_per_page'], $params['publish']);
			$draft = sprintf('<a href="?searchFields=%s&search=%s&status=draft&items_per_page=%s">Draft ( %s )</a> |', $options['searchFields'], $options['search'], $options['items_per_page'], $params['draft']);
			$delete = sprintf('<a href="?searchFields=%s&search=%s&in_trash=yes&items_per_page=%s">Trash ( %s )</a>', $options['searchFields'], $options['search'], $options['items_per_page'], $params['delete']);
		}
		else
		{
			$all = sprintf('<a href="?status=all&items_per_page=%s">All ( %s )</a> |', $options['items_per_page'], $params['all']);
			$publish = sprintf('<a href="?status=publish&items_per_page=%s">Publish ( %s )</a> |', $options['items_per_page'], $params['publish']);
			$draft = sprintf('<a href="?status=draft&items_per_page=%s">Draft ( %s )</a> |', $options['items_per_page'], $params['draft']);
			$delete = sprintf('<a href="?in_trash=yes&items_per_page=%s">Trash ( %s )</a>', $options['items_per_page'], $params['delete']);
		}
		return sprintf('<label for="">%s %s %s %s</label>', $all, $publish, $draft, $delete);
	}
	/**
	 * [getIndexParams description]
	 * @return [type] [description]
	 */
	function getIndexParams()
	{
		$param = array(
				'searchFields'   => (\Request::get('searchFields') == null) ? null : \Request::get('searchFields') ,
				'search'         => (\Request::get('search') == null) ? null : \Request::get('search') ,
				'status'         => (\Request::get('status') == null) ? 'all' : \Request::get('status') ,
				'in_trash'       => (\Request::get('in_trash') == null) ? 'no' : \Request::get('in_trash') ,
				'orderBy'        => (\Request::get('orderBy') == null) ? 'id' : \Request::get('orderBy') ,
				'sortedBy'       => (\Request::get('sortedBy') == null) ? 'desc' : \Request::get('sortedBy') ,
				'items_per_page' => (\Request::get('items_per_page') == null) ? config('global.items_per_page') : \Request::get('items_per_page')
				);
	    return $param;
	}

	/**
	 * [actionIndex description]
	 * @param  [type] $status [description]
	 * @return [type]         [description]
	 */
	function actionIndex($options)
	{
		if(isset($options['in_trash']) && $options['in_trash'] == 'yes')
			return \Form::select('doAction', array('restore' => 'Restore', 'delete' => 'Force Delete'), 'active',array('class' => 'form-control input-sm'));
		else
			return \Form::select('doAction', array('publish' => 'Publish', 'draft' => 'Draft', 'trash' => 'Trash'), 'active',array('class' => 'form-control input-sm'));

	}

	/**
	 * Action for index in permission page or something page doen't has status or trash
	 * @param  [type] $option [description]
	 * @return [type]         [description]
	 */
	function actionIndexNone($option)
	{
		return \Form::select('doAction', array('delete' => 'Delete'), 'active',array('class' => 'form-control input-sm'));
	}
	/**
	 * [showButton description]
	 * @param  [type] $options [description]
	 * @param  [type] $url     [description]
	 * @param  [type] $id      [description]
	 * @return [type]          [description]
	 */
	function showButton($options, $url, $id)
	{
		if($options['in_trash'] != 'yes')
	        return sprintf('
	        	<a href="%s" class="btn btn-default"><span class="fa fa-edit"></span> Edit</a>
		        <button class="btn btn-default confirm-delete" type="button" data-id="%s">
		            <span class="fa fa-trash"></span>
		            Delete
		        </button>', $url, $id);
	    else
	    	return null;

	}
	/**
	 * [showLink description]
	 * @param  [type] $options [description]
	 * @param  [type] $url     [description]
	 * @param  [type] $value   [description]
	 * @return [type]          [description]
	 */
	function showLink($options, $url, $value)
	{
		if($options['in_trash'] != 'yes')
			return sprintf('<a href="%s">%s</a>', $url, $value);
		else
			return $value;
	}
	/**
	 * [show_status description]
	 * @param  [type] $status [description]
	 * @return [type]         [description]
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
    /**
     * [getActionsAttribute description]
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    function getActionsAttribute($value)
    {
    	$actions = unserialize($value);
        $actions = implode('.', $actions);

        return $actions;
    }

	/**
	 * [getActionsAttributeCheckbox description]
	 * @param  [type] $permission [description]
	 * @return [type]             [description]
	 */
    function getActionsAttributeCheckbox($permission)
    {
    	$actions = unserialize($permission->actions);
        $string = '';

        foreach ($actions as $action) {

        	$string .= sprintf('
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="permission[]" value="%s|%s"> %s
                        </label>
                    </div>', $permission->area . '.' . $permission->permission, $action, $action);
        }

        return $string;
    }

    /**
     * Get value from permission array and work with array and return a new array has group value
     * @param  [array] $permissions
     * @return [array] new array
     */
    function getPermissionValue($permissions)
    {
    	$temp = array();
        foreach ($permissions as $permission)
        {
            $var = explode('|', $permission);
            $tmp['permission'] = $var[0];
            $tmp['action'] = $var[1];
            array_push($temp, $tmp);
        }

        $collection = collect($temp);
        $grouped = $collection->groupBy('permission');
        $arr = $grouped->toArray();

        $newtemp = array();

        $t = 0;
        foreach ($arr as $key => $value) {
            $newtemp[$t]['permission'] = $key;
            $newtemp[$t]['action'] = '';
            foreach ($value as $key1 => $value2) {
                $newtemp[$t]['action'] .= $value2['action'];
                if(end($value) != $value2)
                {
                    $newtemp[$t]['action'] .= '.';
                }
            }
            $t++;
        }

        return $newtemp;
    }
    /**
     * Show list actions and check action was chosed
     * @param  [type] $name   [description]
     * @param  [type] $value  [description]
     * @param  [type] $value1 [description]
     * @return [type]         [description]
     */
    function getActionsAttributeCheckboxShow($permission, $edit_permissions)
    {
    	$actions = unserialize($permission->actions);
    	$string = '';

    	/**
    	 * Nếu trường hợp id của permission hiện tại không nằm trong edit permission
    	 * thì tiến hành lấy
    	 * nếu không thì tiến hành lấy action như của phương thức create
    	 */
    	if($edit_permission = $edit_permissions->where('id', $permission->id)->first())
    	{
    		/**
    		 * Lấy ra list actions của permission trùng với id trong edit_permission
    		 * @var [type]
    		 */
    		$actions1 = unserialize($edit_permission->pivot->actions);

    		foreach ($actions as $action) {
	    		$string .= sprintf('
	                    <div class="checkbox icheck">
	                        <label>
	                            <input type="checkbox" name="permission[]" value="%s|%s" %s disabled="disabled"> %s
	                        </label>
	                    </div>', $permission->area . '.' . $permission->permission, $action, in_array($action, $actions1) ? 'checked="checked"' : '' ,$action);
	        }
    	}
    	else
    	{
    		foreach ($actions as $action) {
	    		$string .= sprintf('
	                    <div class="checkbox icheck">
	                        <label>
	                            <input type="checkbox" name="permission[]" value="%s|%s" disabled="disabled"> %s
	                        </label>
	                    </div>', $permission->area . '.' . $permission->permission, $action, $action);
	    	}
    	}

        return $string;
    }
    /**
     * [getActionsAttributeCheckboxEdit description]
     * @param  [type] $permission       [description]
     * @param  [type] $edit_permissions [description]
     * @return [type]                   [description]
     */
    function getActionsAttributeCheckboxEdit($permission, $edit_permissions)
    {
    	$actions = unserialize($permission->actions);

    	$string = '';

    	/**
    	 * Nếu trường hợp id của permission hiện tại không nằm trong edit permission
    	 * thì tiến hành lấy
    	 * nếu không thì tiến hành lấy action như của phương thức create
    	 */
    	if($edit_permission = $edit_permissions->where('id', $permission->id)->first())
    	{
    		/**
    		 * Lấy ra list actions của permission trùng với id trong edit_permission
    		 * @var [type]
    		 */
    		$actions1 = unserialize($edit_permission->pivot->actions);

    		foreach ($actions as $action) {
	    		$string .= sprintf('
	                    <div class="checkbox icheck">
	                        <label>
	                            <input type="checkbox" name="permission[]" value="%s|%s" %s> %s
	                        </label>
	                    </div>', $permission->area . '.' . $permission->permission, $action, in_array($action, $actions1) ? 'checked="checked"' : '' ,$action);
	        }
    	}
    	else
    	{
    		foreach ($actions as $action) {
	    		$string .= sprintf('
	                    <div class="checkbox icheck">
	                        <label>
	                            <input type="checkbox" name="permission[]" value="%s|%s"> %s
	                        </label>
	                    </div>', $permission->area . '.' . $permission->permission, $action, $action);
	    	}
    	}

        return $string;
    }

    /**
     * [getPermissionValueFromDB description]
     * @param  [type] $permissions [description]
     * @return [type]              [description]
     */
    public function getPermissionValueFromArray($permissions)
    {
    	$arr_permission = array();
    	foreach ($permissions->get() as $permission) {
    		$permission_arr['permission'] = $permission->area . '.' . $permission->permission;
    		$permission_arr['actions'] = implode('.', unserialize($permission->pivot->actions));

    		array_push($arr_permission, $permission_arr);
    	}

    	return $arr_permission;
    }

    /**
     * [getPermissionValueFromCollection description]
     * @param  [type] $permissions [description]
     * @return [type]              [description]
     */
    public function getPermissionValueFromCollection($permissions)
    {
    	$arr_permission = array();
    	foreach ($permissions as $permission) {
    		$permission_arr['permission'] = $permission->area . '.' . $permission->permission;
    		$permission_arr['actions'] = implode('.', unserialize($permission->actions));

    		array_push($arr_permission, $permission_arr);
    	}

    	return $arr_permission;
    }

    /**
     * [getNewPermission description]
     * @param  [type] $new_permissions [description]
     * @param  [type] $edit_permission [description]
     * @param  [type] $all_permission  [description]
     * @return [type]                  [description]
     */
    public function getNewPermission($new_permissions, $edit_permissions, $all_permissions)
    {
    	foreach ($edit_permissions as $key => $value) {
    		$permission = $value['permission'];
    		foreach ($new_permissions as $key_new => $value_new) {
    			if($permission == $value_new['permission'])
    			{
    				unset($new_permissions[$key_new]);
    			}
    		}
    	}

    	return $new_permissions;
    }

    /**
     * [getEditPermission description]
     * @param  [type] $new_permissions  [description]
     * @param  [type] $edit_permissions [description]
     * @param  [type] $all_permissions  [description]
     * @return [type]                   [description]
     */
    public function getEditPermission($new_permissions, $edit_permissions, $all_permissions)
    {
    	foreach($new_permissions as $key => $value)
    	{
    		$permission = $value['permission'];
    		foreach ($edit_permissions as $key_edit => $value_edit) {
    			if($permission == $value_edit['permission'])
    			{
    				unset($edit_permissions[$key_edit]);
    			}
    		}
    	}

    	return $edit_permissions;
    }
}