<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-users', function (Admin $admin) {
            return $admin->role === 'full_access' || $admin->role === 'limited_access';
        });

        Gate::define('create-users', function (Admin $admin) {
            return $admin->role === 'full_access';
        });

        Gate::define('update-users', function (Admin $admin) {
            return $admin->role === 'full_access';
        });

        Gate::define('delete-users', function (Admin $admin) {
            return $admin->role === 'full_access';
        });
    }
}
