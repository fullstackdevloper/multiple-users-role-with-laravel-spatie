<?php

namespace App\Providers;

use App\Enums\Roles;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::before(function ($user, $ability) {
            return $user->hasRole(Roles::SUPERADMIN) ? true : null;
        });

        view()->composer(['users.edit'], function ($view) {
            $view->with('all_roles', Role::all());
        });

        view()->composer(['roles.edit', 'roles.create'], function ($view) {
            $view->with('permissions', Permission::all());
        });

        view()->composer(['permissions.create'], function ($view) {
            $routes = collect(Route::getRoutes())->filter(function ($route) {
                return in_array('user_permissions', $route->middleware());
            })->map(function ($route) {
                return $route->getName();
            });
            $view->with('route_lists', $routes);
        });
    }
}
