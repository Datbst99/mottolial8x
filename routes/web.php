<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Admin\UserController;
use \App\Http\Controllers\Admin\CategoryController;
use \App\Http\Controllers\Admin\ProductController;
use \App\Http\Controllers\Admin\InvoiceController;
use \App\Http\Controllers\Admin\PromotionController;
use \App\Http\Controllers\HomeController;
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


Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/san-pham/{slug}', [HomeController::class, 'detail'])->name('detail');
Route::post('/order', [HomeController::class, 'order'])->name('order');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function (){

    Route::view('/dashboard', 'admin.index')->name('admin.dashboard');

    Route::group(['prefix' => 'user'], function (){
        Route::get('/', [UserController::class, 'index'])->name('admin.user');
        Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
        Route::match(['post', 'get'],'/{id}/update', [UserController::class, 'update'])->name('admin.user.update');
        Route::get('/form-update', [UserController::class, 'formUpdate']);
        Route::post('/delete', [UserController::class, 'delete'])->name('admin.user.delete');
    });

    Route::group(['prefix' => 'category'], function (){
        Route::get('/', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/delete', [CategoryController::class, 'delete'])->name('category.delete');

        Route::get('/form/update', [CategoryController::class, 'formUpdate']);
    });



    Route::group(['prefix' => 'product'], function (){
        Route::get('/', [ProductController::class, 'index'])->name('product.index');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/store', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::post('/{id}/update', [ProductController::class, 'update'])->name('product.update');

        Route::post('/delete', [ProductController::class, 'delete'])->name('product.delete');
        Route::post('/classify', [ProductController::class, 'classify']);
    });

    Route::group(['prefix' => 'invoice'], function (){
        Route::get('/', [InvoiceController::class, 'index'])->name('invoice.index');
        Route::get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
        Route::get('/{id}/detail', [InvoiceController::class, 'detail'])->name('invoice.detail');
        Route::post('/store', [InvoiceController::class, 'store'])->name('invoice.store');
        Route::post('/delete', [InvoiceController::class, 'delete'])->name('invoice.delete');
        Route::get('/{id}/change/{status}', [InvoiceController::class, 'change'])->name('invoice.change');

        Route::get('/user', [InvoiceController::class, 'user'])->name('invoice.user');
        Route::post('/product', [InvoiceController::class, 'product'])->name('invoice.product');
        Route::post('/list/product', [InvoiceController::class, 'listProduct'])->name('invoice.list.product');
        Route::post('/list/classify', [InvoiceController::class, 'listClassify'])->name('invoice.list.classify');
        Route::get('/search/user', [InvoiceController::class, 'searchUser']);
        Route::get('/search/product', [InvoiceController::class, 'searchProduct']);

    });

    Route::group(['prefix' => 'promotion'], function (){
        Route::get('/', [PromotionController::class, 'index'])->name('promotion.index');
        Route::post('/store', [PromotionController::class, 'store'])->name('promotion.store');
        Route::post('/{id}/update', [PromotionController::class, 'update'])->name('promotion.update');
        Route::post('/delete', [PromotionController::class, 'delete'])->name('promotion.delete');
        Route::get('/form/update', [PromotionController::class, 'formUpdate']);
    });
    Route::get('/order', [\App\Http\Controllers\Admin\OrderLandingController::class, 'index'])->name('admin.order');
});



//Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//    ->name('ckfinder_connector');
//
//Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//    ->name('ckfinder_browser');
