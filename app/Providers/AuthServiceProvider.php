<?php

namespace App\Providers;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
      
        $this->registerPolicies();

        Gate::after(function(User $user){
            if($user->hasRole("superadmin")){
                return true;
            }
                return false;
        });

        Gate::define("admin", function(User $user){
            return $user->roleId ==1;
        });

        Gate::define("car", function(User $user){
            return $user->roleId == 3;
        });

        Gate::define("commune", function(User $user){
            return $user->roleId ==2;
        });
 
     
    }
}
