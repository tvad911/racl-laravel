<?php
namespace App\Helpers\Backend\Facade;

use Illuminate\Support\Facades\Facade;

class Backend extends Facade {

	protected static function getFacadeAccessor() {
		return 'backend';
	}

}