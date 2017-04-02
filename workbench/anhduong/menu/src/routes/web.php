<?php
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

$adminRoute = config('webed.admin_route');
$moduleRoute = 'menus';
/**
 * Admin routes
 */
Route::group(['prefix' => $adminRoute . '/' . $moduleRoute], function (Router $router) use ($adminRoute, $moduleRoute) {
    /**
     * Put some route here
     */
    $router->get('', 'MenuController@getIndex')
        ->name('admin::menus.index.get')
        ->middleware('has-permission:view-menus');
    $router->post('', 'MenuController@postListing')
        ->name('admin::menus.index.post')
        ->middleware('has-permission:view-menus');
    $router->post('update-status/{id}/{status}', 'MenuController@postUpdateStatus')
        ->name('admin::menus.update-status.post')
        ->middleware('has-permission:edit-menus');
    $router->get('create', 'MenuController@getCreate')
        ->name('admin::menus.create.get')
        ->middleware('has-permission:create-menus');
    $router->post('create', 'MenuController@postCreate')
        ->name('admin::menus.create.post')
        ->middleware('has-permission:create-menus');
    $router->get('edit/{id}', 'MenuController@getEdit')
        ->name('admin::menus.edit.get')
        ->middleware('has-permission:view-menus');
    $router->post('edit/{id}', 'MenuController@postEdit')
        ->name('admin::menus.edit.post')
        ->middleware('has-permission:edit-menus');
    $router->delete('/{id}', 'MenuController@deleteDelete')
        ->name('admin::menus.delete.delete')
        ->middleware('has-permission:delete-menus');
});