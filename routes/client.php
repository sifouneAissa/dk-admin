<?php

\Illuminate\Support\Facades\Route::group(['prefix' => config('app.client-prefix'), 'as' => 'client.'], function () {


    \Illuminate\Support\Facades\Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        \Illuminate\Support\Facades\Route::get('/dashboard', function () {
            return \Inertia\Inertia::render('Dashboard');
        })->name('dashboard');


    });
});


require __DIR__ . './client-auth.php';
