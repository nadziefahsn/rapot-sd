<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;


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
        Gate::define('admin', function ($user) {
        return $user->hasRole('admin');
    });

    
        Gate::define('guru', function ($user) {
        return $user->hasRole('guru');
    });

        Gate::define('gurut2q', function ($user) {
        return $user->hasRole('gurut2q');
    });
    }
}
