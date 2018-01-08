<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

        Gate::define('edit-user', function($user, $resource){

            return $resource == $user->id;
        });

        Gate::define('update-user', function($user, $resource){
            return $resource == $user->id;
        });

        Gate::define('owner', function($user, $resource){
            return $resource == $user->id;
        });

        Gate::define('admin', function($user){
            return $user->hasRole('admin');
        });

        Gate::define('owner-or-admin', function($user, $resource){
            return $resource == $user->id OR $user->hasRole('admin');
        });
    }
}
