<?php

namespace App\Validators\Backend;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;
use App\Http\Requests\Request;

class PermissionValidator extends LaravelValidator
{
	protected $id;

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [],
        ValidatorInterface::RULE_UPDATE => [],
	];

	protected $messages = [
	];
}
