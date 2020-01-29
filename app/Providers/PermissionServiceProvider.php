<?php

namespace App\Providers;

use App\Permissions;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return bool
     */
    public function boot()
    {
        try {
            Permissions::get()->map(function ($permission) {
                Gate::define($permission->permission, function ($user) use ($permission) {
                    return $user->hasPermissionTo($permission);
                });
            });
        } catch (\Exception $e) {
            report($e);
            return false;
        }
        Blade::directive('role', function ($role) {
            return "if(auth()->check() && auth()->user()->hasRole({$role})) :";
        });

        Blade::directive('endrole', function ($role) {
            return "endif;";
        });
    }
}
