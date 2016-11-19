<?php

namespace App\Validators\Backend;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use App\Http\Requests\Request;

class PermissionValidator extends LaravelValidator
{
	protected $id;

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'area'        => 'required|min:3|max:25',
            'permission'  => 'required|min:3|max:25|unique_with:acl_permissions,area',
            'actions'      => 'required|min:3|max:2048',
            'description' => 'max:255',
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'area'        => 'required|min:3|max:25',
            'permission'  => 'required|min:3|max:25',
            'actions'      => 'required|min:3|max:2048',
            'description' => 'max:255',
        ],
	];

	protected $messages = [
	];
}
