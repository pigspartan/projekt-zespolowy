<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::if('role', function ($role){
            return Auth::check() && Auth::user()->hasRole($role);
        });
        Paginator::defaultView('vendor.pagination.tailwind'); // Customize view here
        Paginator::defaultSimpleView('vendor.pagination.simple-tailwind'); // Customize simple pagination view
    }
}
