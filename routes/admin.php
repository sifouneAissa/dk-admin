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
        \Illuminate\Support\Facades\Route::get('/test',function (){
            return 'hello';
        })->name('test');

    });

    require __DIR__. '/admin-auth.php';
});
