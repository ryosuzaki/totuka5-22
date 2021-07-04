<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

use App\Models\Group\Group;
use App\Policies\GroupPolicy;

use App\Policies\GroupInfoBasesPolicy;
use App\Policies\GroupInfoPolicy;

use App\Policies\GroupRolePolicy;
use App\Policies\GroupRolesPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //'App\Model' => 'App\Policies\ModelPolicy',
        Group::class=>GroupPolicy::class,
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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('SuperAdmin') ? true : null;
        });

        //
        Gate::define('create-group-info-bases','App\Policies\GroupInfoBasesPolicy@create');
        Gate::define('update-group-info-bases','App\Policies\GroupInfoBasesPolicy@update');
        Gate::define('delete-group-info-bases','App\Policies\GroupInfoBasesPolicy@delete');
        //
        Gate::define('view-group-info','App\Policies\GroupInfoPolicy@view');
        Gate::define('update-group-info','App\Policies\GroupInfoPolicy@update');

        
        //
        Gate::define('viewAny-group-roles','App\Policies\GroupRolesPolicy@viewAny');
        Gate::define('create-group-roles','App\Policies\GroupRolesPolicy@create');
        Gate::define('delete-group-roles','App\Policies\GroupRolesPolicy@delete');
        
        //
        Gate::define('update-group-role','App\Policies\GroupRolePolicy@update');
        Gate::define('viewUsers-group-role','App\Policies\GroupRolePolicy@viewUsers');
        Gate::define('inviteUser-group-role','App\Policies\GroupRolePolicy@inviteUser');
        Gate::define('removeUser-group-role','App\Policies\GroupRolePolicy@removeUser');
    }
}
