<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('role', 'Admin\RolesController');

    Route::resource('p_component', 'Admin\PermissionForsController');

    //Permissions Routes
    Route::get('permission/trashed', 'Admin\PermissionsController@trashed')->name('permission.trashed');
    Route::get('permission/restore/{id}', 'Admin\PermissionsController@restoreTrashed')->name('permission.restore');
    Route::get('permission/kill/{id}', 'Admin\PermissionsController@killTrashed')->name('permission.kill');
    Route::resource('permission', 'Admin\PermissionsController');

    //Table Routes
    Route::resource('table', 'Admin\TablesController');


    Route::resource('employee', 'Admin\UsersController');
});