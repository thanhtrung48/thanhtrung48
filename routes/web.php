<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\SiteController;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\frontend\LoginController;

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('login', [LoginController::class, 'index'])->name('login.home');

Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('brand', BrandController::class);
    //category
    Route::resource('category', CategoryController::class);
    Route::prefix('admin')->group(function () {
    Route::get('status/{category}',[CategoryController::class,'status'])->name('category.status');
    Route::get('delete/{category}',[CategoryController::class,'delete'])->name('category.delete');
    });
   

    Route::resource('product', ProductController::class);
});
