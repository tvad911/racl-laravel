<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
	Route::post('menu/updatemulti', ['as' => 'menu.updatemulti', 'uses' => 'Backend\MenusController@postUpdateMulti']);
    Route::resource('menu','Backend\MenusController');
});