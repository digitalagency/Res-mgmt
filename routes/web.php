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
<<<<<<< HEAD
    /**
     * Permissions Routes
     */
=======

    //Permissions Routes
>>>>>>> logout
    Route::get('permission/trashed', 'Admin\PermissionsController@trashed')->name('permission.trashed');
    Route::get('permission/restore/{id}', 'Admin\PermissionsController@restoreTrashed')->name('permission.restore');
    Route::get('permission/kill/{id}', 'Admin\PermissionsController@killTrashed')->name('permission.kill');
    Route::resource('permission', 'Admin\PermissionsController');

    //Table Routes
    Route::resource('table', 'Admin\TablesController');

    Route::resource('employee', 'Admin\UsersController');

    /**
     * Category Routes
     */
    Route::get('/category-details/{slug}', 'Admin\CategoryController@single')->name('category.single');
    Route::resource('category','Admin\CategoryController', ['except' => 'show']);
    
    /**
     * Product Routes
     */
    Route::get('/updatestatus', 'Admin\ProductController@status');
    Route::post('/product/edit/{name}', 'Admin\ProductController@update')->name('product.u');
    Route::delete('/product-delete/{product}', 'Admin\ProductController@destroy')->name('product.delete');
    Route::get('/product-details/{product}', 'Admin\ProductController@single')->name('product.single');
    Route::put('p-metadata/edit/{id}','Admin\ProductController@editMetadata')->name('edit.metadata');
    Route::resource('product', 'Admin\ProductController', ['except' => 'show']);
    Route::delete('/image/delete/{id}', 'Admin\ImageController@destroy')->name('product.image.destroy');

    
});