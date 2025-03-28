<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('create-user', function (User $user) {
            return $user->role_id == 1;
        });
        Gate::define('view-organizations', function (User $user) {
            return $user->role_id == 1;
        });
        Gate::define('create-organization', function (User $user) {
            return $user->role_id == 1;
        });
        Gate::define('change-payment-gateway', function (User $user) {
            return $user->role_id == 1;
        });
    }
}
