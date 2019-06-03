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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false, 'reset' => false, 'verify' => false]);

Route::get('/', 'HomePageController@index');
Route::get('/catalog', 'HomePageController@indexCatalog');
Route::post('/catalog/book-booking/{id}', 'UserController@storeBookBooking');
Route::post('/catalog/book-booking/cancel/{id}', 'UserController@cancelBookBooking');
Route::get('api/catalog', 'HomePageController@apiCatalog');
Route::get('/history', 'UserController@indexHistory');
Route::get('api/history', 'UserController@apiHistory');
Route::get('/video', 'HomePageController@indexVideo');
Route::get('/api/video', 'HomePageController@apiVideo');

Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/add-book', 'AdminController@indexAddBook')->name('admin.dashboard-add-book');
    Route::post('/add-book', 'AdminController@storeAddBook');
    Route::patch('/add-book/{book}', 'AdminController@updateBook');
    Route::delete('/add-book/{book}', 'AdminController@destroyBook');
    Route::get('/borrow-book', 'AdminController@indexBorrowBook')->name('admin.dashboard-return-book');
    Route::post('/borrow-book/{id}', 'AdminController@storeBorrowBook');
    Route::get('/book-status', 'AdminController@indexBookStatus')->name('admin.dashboard-book-status');
    Route::post('/return-book/{id}', 'AdminController@storeReturnBook');
    Route::get('/video', 'AdminController@indexListVideo')->name('admin.dashboard-list-video');
    Route::post('/video', 'AdminController@storeVideo');
    Route::patch('/video/{video}', 'AdminController@updateVideo');
    Route::delete('/video/{video}', 'AdminController@destroyVideo');
    // Route::post('product', 'ProductController@store');
    // Route::patch('product/{id}', 'ProductController@update');
    // Route::delete('product/{id}', 'ProductController@destroy');
    // Route::get('verify', 'AdminController@indexVerify');
    // Route::post('verify/{book_id}', 'AdminController@storeVerify');

    Route::get('login', 'AdminLoginController@login')->name('admin.auth.login');
    Route::post('login', 'AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
    Route::post('logout', 'AdminLoginController@logout')->name('admin.auth.logout');
    //Route::get('change-language/{locale}','Admin\LanguageController@changeLang');
});
