<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Product\ProductCategoryController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::group(['as' => 'auth.', 'prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group(['as' => 'product.', 'prefix' => 'product', 'middleware' => ['auth:sanctum']], function () {
    Route::get('', [ProductController::class, 'list'])->name('list');
    Route::get('/{id}', [ProductController::class, 'detail'])->name('detail');
    Route::post('', [ProductController::class, 'create'])->name('create');
    Route::put('/{id}', [ProductController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductController::class, 'delete'])->name('delete');
});

Route::group(['as' => 'category.', 'prefix' => 'category', 'middleware' => ['auth:sanctum']], function () {
    Route::get('', [ProductCategoryController::class, 'list'])->name('list');
    Route::get('/{id}', [ProductCategoryController::class, 'detail'])->name('detail');
    Route::post('', [ProductCategoryController::class, 'create'])->name('create');
    Route::put('/{id}', [ProductCategoryController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProductCategoryController::class, 'delete'])->name('delete');
});

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:sanctum']], function () {
    Route::get('', [AdminController::class, 'list'])->name('list');
    Route::get('/{id}', [AdminController::class, 'detail'])->name('detail');
    Route::post('', [AdminController::class, 'create'])->name('create');
    Route::put('/{id}', [AdminController::class, 'update'])->name('update');
    Route::delete('/{id}', [AdminController::class, 'delete'])->name('delete');
});