<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        Gate::define('modules', function ($user, $permisionName) {
            // dd($account->role);
            if ($user->status !== 'normal')
                return false;
            $role = $user->roles;
            $permission = $role->permissions;
            if ($permission->contains('name', $permisionName)) {
                return true;
            }
            return false;
        });
    }
}
