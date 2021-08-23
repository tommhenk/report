<?php

namespace App\Providers;

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



        Gate::define('ORDER_ADMIN', function($user){
            return $user->canDo('ORDER_ADMIN');
        });

        Gate::define('CLIENT_ADMIN', function($user){
            return $user->canDo('CLIENT_ADMIN');
        });
        Gate::define('EMPLOYEE_ADMIN', function($user){
            return $user->canDo('EMPLOYEE_ADMIN');
        });

        
        
    }
}
