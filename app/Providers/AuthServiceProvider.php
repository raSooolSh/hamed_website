<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Premission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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

        Gate::before(function(User $user){
            if($user->type=='admin'){
                return true;
            }
        });
        
        if(Schema::hasTable('premissions')){
            foreach(Premission::all() as $premission){
                Gate::define($premission->name,function(User $user)use($premission){
                    return $user->hasPremission($premission);
                });
            }
        }
        
    }
}
