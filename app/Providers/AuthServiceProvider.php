<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('quarx', function ($user) {
            return $user->roles->first()->name === 'admin';
        });

        \Gate::define('admin', function ($user) {
            return $user->roles->first()->name === 'admin';
        });

        \Gate::define('permission', function ($user, $permission) {
            return strpos($user->roles->first()->permissions, $permission) > -1;
        });
    }
}
