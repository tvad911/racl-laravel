<?php namespace Anhduong\Menu\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Anhduong\Menu\Facades\Menu;

/**
 * The DemoController facade.
 *
 * @package Anhduong\Menu\Http\Controllers
 * @author  <>
 */
class DemoController extends Controller {

	public function demo() {
		return Menu::welcome();
	}

}
