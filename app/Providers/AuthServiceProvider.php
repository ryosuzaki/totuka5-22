<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

use App\Models\Group\Group;
use App\Models\Group\GroupLocation;
use App\Policies\GroupPolicy;
use App\Policies\GroupLocationPolicy;

use App\Models\Info\Info;
use App\Policies\InfoPolicy;
use App\Models\Info\InfoBase;
use App\Policies\InfoBasePolicy;

use App\Models\Role;
use App\Policies\GroupRolePolicy;

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
        GroupLocation::class=>GroupLocationPolicy::class,
        Info::class=>InfoPolicy::class,
        InfoBase::class=>InfoBasePolicy::class,
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
    }
}
