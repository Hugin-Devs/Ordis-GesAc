<?php

namespace App\Providers;

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
        // Definir Gates dinámicos basados en permisos
        try {
            \App\Models\Permission::all()->each(function ($permission) {
                \Illuminate\Support\Facades\Gate::define($permission->slug, function ($user) use ($permission) {
                    return $user->roles()->whereHas('permissions', function ($query) use ($permission) {
                        $query->where('slug', $permission->slug);
                    })->exists();
                });
            });
        } catch (\Exception $e) {
            // Silently fail if tables don't exist yet
        }
    }
}
