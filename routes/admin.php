<?php

use Inertia\Inertia;


\Illuminate\Support\Facades\Route::group(['prefix' => config('app.admin-prefix'), 'as' => 'admin.'], function () {

    \Illuminate\Support\Facades\Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {

        \Illuminate\Support\Facades\Route::get('/dashboard',[\App\Http\Controllers\Admin\DashboardController::class,'index'])->name('dashboard');
        \Illuminate\Support\Facades\Route::get('/category',[\App\Http\Controllers\CategoryController::class,'index'])->name('category');
      
        \Illuminate\Support\Facades\Route::prefix('product')->name('product.')->group(function (){
            \Illuminate\Support\Facades\Route::get('/list',[\App\Http\Controllers\ProductController::class,'lindex'])->name('lindex');
            \Illuminate\Support\Facades\Route::get('/',[\App\Http\Controllers\ProductController::class,'index'])->name('index');
            \Illuminate\Support\Facades\Route::get('/create',[\App\Http\Controllers\ProductController::class,'create'])->name('create');
            \Illuminate\Support\Facades\Route::post('/',[\App\Http\Controllers\ProductController::class,'store'])->name('store');
        });

    });

    require __DIR__. '/admin-auth.php';
});
