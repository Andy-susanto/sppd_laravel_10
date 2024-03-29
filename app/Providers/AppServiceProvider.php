<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
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
        Gate::define('isAdmin', function(User $user){
            return $user->level_admin->slug === 'admin';
        });
        Gate::define('isOperator', function(User $user){
            return $user->level_admin->slug === 'operator' || $user->level_admin->slug === 'admin';
        });
        Gate::define('isPegawai', function(User $user){
            return $user->level_admin->slug === 'pegawai' || $user->level_admin->slug === 'operator' || $user->level_admin->slug === 'admin';
        });
    }
}
