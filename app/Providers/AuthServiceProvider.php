<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
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
        Gate::define('system-only', function ($user) {
            return ($user->role==1);
        });
        //
        Gate::define('admin-user', function ($user) {
            return ($user->role<=5);
        });

        //
        Gate::define('support-staff', function ($user,$support_team_id) {
            return User::find($user->id)->staff_supports()->get()->contains('id',$support_team_id);
        });
        //
        Gate::define('support-user', function ($user,$support_team_id) {
            return User::find($user->id)->user_supports()->get()->contains('id',$support_team_id);
        });

        //
        Gate::define('shelter-staff', function ($user,$shelter_id) {
            return User::find($user->id)->staff_shelters()->get()->contains('id',$shelter_id);
        });
        //
        Gate::define('shelter-user', function ($user,$shelter_id) {
            return User::find($user->id)->user_shelters()->get()->contains('id',$shelter_id);
        });
    }
}
