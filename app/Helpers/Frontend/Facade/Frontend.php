<?php
namespace App\Helpers\Frontend\Facade;

use Illuminate\Support\Facades\Facade;

class Frontend extends Facade
{
	protected static function getFacadeAccessor() { return 'frontend'; }
}