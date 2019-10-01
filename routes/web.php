<?php
use App\Models\Admin\FindReservation;
use App\Models\Admin\Header;
use App\Models\Admin\Schedule;
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
    $contacts = FindReservation::select()->first();
    $contact = Header::select()->first();
    $schedules = Schedule::select()->first();
    return view('frontend.index')->with('contacts',$contacts)
                                    ->with('contact',$contact)
                                    ->with('schedules', $schedules);
});
Route::resource('contact', 'Frontend\ContactController');

Route::resource('gallery', 'Frontend\GalleryController');

Route::resource('menu', 'Frontend\MenuController');

Route::resource('homeFront', 'Frontend\FrontHomeController');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('role', 'Admin\RolesController');

    Route::resource('p_component', 'Admin\PermissionForsController');
    /**
     * Permissions Routes
     */
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

    /**
     * Order Routes
     */
    Route::get('/order/range', 'Admin\Order\DateRangeOrderController@orderRange')->name('order.range');
    Route::resource('category.product', 'Admin\Order\CategoryProductController', ['only' => 'index']);
    Route::resource('order', 'Admin\Order\OrderController');
    Route::get('employee/description/{id}', 'Admin\UsersController@description')->name('employee.description');

    Route::resource('employee', 'Admin\UsersController');

    Route::resource('category','Admin\CategoryController');
    
    Route::resource('product', 'Admin\ProductController');
    
    Route::resource('profileHeader', 'Admin\ProfileHeaderController');
    
    Route::resource('footerFind', 'Admin\FooterFindController');

    Route::resource('footerMedia', 'Admin\FooterMediaController');

    Route::resource('footerSchedule', 'Admin\FooterScheduleController');

    Route::get('message/trashed', 'Admin\MessageController@trashed')->name('message.trashed');

    Route::get('message/restore/{id}', 'Admin\MessageController@restoreTrashed')->name('message.restore');

    Route::get('message/kill/{id}', 'Admin\MessageController@killTrashed')->name('message.kill');

    Route::resource('message','Admin\MessageController');
});

    

    



