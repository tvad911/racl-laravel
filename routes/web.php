<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();

Route::get('/home', 'HomeController@index');
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::post('user/updatemulti', ['as' => 'user.updatemulti', 'uses' => 'Backend\UsersController@postUpdateMulti']);
    Route::get('user/export/{type}', ['as' => 'user.export', 'uses' => 'Backend\UsersController@export'])->where('type', '[A-Za-z]+');
    Route::get('user/permission/{id}', ['as' => 'user.permission', 'uses' => 'Backend\UsersController@permission'])->where('id', '[0-9]+');
    Route::put('user/updatepermission/{id}', ['as' => 'user.updatePermission', 'uses' => 'Backend\UsersController@updatePermission'])->where('id', '[0-9]+');
    Route::resource('user','Backend\UsersController');
    Route::post('permission/updatemulti', ['as' => 'permission.updatemulti', 'uses' => 'Backend\PermissionsController@postUpdateMulti']);
    Route::get('permission/export/{type}', ['as' => 'permission.export', 'uses' => 'Backend\PermissionsController@export'])->where('type', '[A-Za-z]+');
    Route::resource('permission','Backend\PermissionsController');
    Route::post('role/updatemulti', ['as' => 'role.updatemulti', 'uses' => 'Backend\RolesController@postUpdateMulti']);
    Route::get('role/export/{type}', ['as' => 'role.export', 'uses' => 'Backend\RolesController@export'])->where('type', '[A-Za-z]+');
    Route::get('role/test', ['as' => 'group.test', 'uses' => 'Backend\RolesController@test']);
    Route::resource('role','Backend\RolesController');
    Route::post('group/updatemulti', ['as' => 'group.updatemulti', 'uses' => 'Backend\GroupsController@postUpdateMulti']);
    Route::get('group/export/{type}', ['as' => 'group.export', 'uses' => 'Backend\GroupsController@export'])->where('type', '[A-Za-z]+');
    Route::resource('group','Backend\GroupsController');
});