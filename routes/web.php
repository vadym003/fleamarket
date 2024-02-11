<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('home');
});


Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::get('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/login', [App\Http\Controllers\Admin\AdminAuthController::class, 'postLogin'])->name('adminLoginPost');

    Route::group(['middleware' => 'adminauth'], function () {
        Route::get('/index', [App\Http\Controllers\Admin\AdminAuthController::class, 'adminDashboard'])->name('adminDashboard');
        Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('adminCategory');
        Route::post('/addcategory', [App\Http\Controllers\Admin\CategoryController::class, 'addCategory'])->name('adminCategory.add');
        Route::get('/tag', [App\Http\Controllers\Admin\TagController::class, 'index'])->name('adminTag');
        Route::post('/addtag', [App\Http\Controllers\Admin\TagController::class, 'addTag'])->name('adminTag.add');

    });

});
Route::group(['middleware' => ['auth']], function() {
        Route::get('/fleamarket',[App\Http\Controllers\Auth\User\FleamarketController::class, 'index'])->name('fleamarket');
        Route::get('/addfleamarketpage', [App\Http\Controllers\Auth\User\FleamarketController::class, 'addfleamarketpage'])->name('fleamarket.addpage');
        Route::post('/addfleamarket', [App\Http\Controllers\Auth\User\FleamarketController::class, 'addfleamarket'])->name('fleamarket.add');
        Route::get('/fleamarketdetail', [App\Http\Controllers\Auth\User\FleamarketController::class, 'fleamarketdetail'])->name('fleamarket.detail');
        Route::post('/updatefleamarket', [App\Http\Controllers\Auth\User\FleamarketController::class, 'updatefleamarket'])->name('fleamarket.update');
        Route::post('/deletefiles', [App\Http\Controllers\Auth\User\FleamarketController::class, 'deletefiles'])->name('fleamarket.delete');
        Route::post('/deleteproduct', [App\Http\Controllers\Auth\User\FleamarketController::class, 'deleteproduct'])->name('fleamarket.productdelete');
    
});






Route::get('/jobs', JobController::class .'@index')->name('jobs.index');

Route::get('/jobs/post', JobController::class .'@post')->name('jobs.post');

Route::post('/jobs', JobController::class .'@store')->name('jobs.store');

Route::get('/jobs/{job_id}/edit', JobController::class .'@edit')->name('jobs.edit');

Route::put('/jobs/{job_id}', JobController::class .'@update')->name('jobs.update');

Route::delete('/jobs/{job_id}', JobController::class .'@destroy')->name('jobs.destroy');