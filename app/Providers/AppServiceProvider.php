<?php

namespace App\Providers;

use App\Enums\Roles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole(Roles::SUPERADMIN) ? true : null;
        });

        view()->composer('*', function ($view) {
            $view->with('all_roles', Role::all());
        });
    }
}
