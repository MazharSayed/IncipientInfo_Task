<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1\Admin'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');
});

Route::get('get/restuarant/{id}','Admin\RestaurantController@getRestuarant')->name('restuarant.get');
Route::post('add-restaurant', 'Admin\RestaurantController@store')->name('restaurant.add');
Route::patch('edit-restaurant/{id}', 'Admin\RestaurantController@update')->name('restaurant.update');

Route::delete('add-restaurant', 'Admin\RestaurantController@delete')->name('restaurant.delete');
