<?php

namespace App\Providers;
//use Laravel\Passport\Passport;
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

        Gate::define('IsAdmin', function($user){
            return $user->type === 'admin';
        });
        Gate::define('IsEmployer', function($user){
            return $user->type === 'employer';
        });
        Gate::define('IsUser', function($user){
            return $user->type === 'user';
        });

        Gate::define('IsEnterprise', function($user){
            return $user->type === 'enterprise';
        });

        Gate::define('IsAdminOrEmployer', function($user){
            if ($user->type === 'admin' || $user->type === 'employer'){
                return true;
            }
        });
        //Passport::routes();

        //
    }
}
