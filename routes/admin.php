<?php

use Inertia\Inertia;


\Illuminate\Support\Facades\Route::group(['prefix' => config('app.admin-prefix'), 'as' => 'admin.'], function () {

    \Illuminate\Support\Facades\Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        \Illuminate\Support\Facades\Route::get('/dashboard', function () {
            return Inertia::render('Dashboard');
        })->name('dashboard');
    });

    require __DIR__. '/admin-auth.php';
});
