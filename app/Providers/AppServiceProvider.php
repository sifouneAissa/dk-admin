<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Inertia::share('template' , function (){
            return adminRequest() ? 'app' : 'app-client';
        });


        Inertia::share('sidebar' , function (){
            return config('sidebar');
        });

        Inertia::share('permissions' , function (){
            return auth()->user()?->getAllPermissions()->pluck('name');
        });
    }
}
