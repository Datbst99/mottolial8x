<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\ProductController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function (){

    Route::view('/dashboard', 'admin.index')->name('admin.dashboard');

    Route::group(['prefix' => 'user'], function (){
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
    });

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);

    Route::post('product/classify', [ProductController::class, 'classify']);
});


Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
    ->name('ckfinder_connector');

Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
    ->name('ckfinder_browser');
