<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register repositories.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            \App\Interfaces\Repositories\AccountRepositoryInterface::class => \App\Repositories\AccountRepositoryEloquent::class,
            \App\Interfaces\Repositories\RoleRepositoryInterface::class => \App\Repositories\RoleRepositoryEloquent::class,
            \App\Interfaces\Repositories\BlogRepositoryInterface::class => \App\Repositories\BlogRepositoryEloquent::class,
            \App\Interfaces\Repositories\CategoryRepositoryInterface::class => \App\Repositories\CategoryRepositoryEloquent::class,
            \App\Interfaces\Repositories\PermissionRepositoryInterface::class => \App\Repositories\PermissionRepositoryEloquent::class,
            \App\Interfaces\Repositories\NotificationRepositoryInterface::class => \App\Repositories\NotificationRepositoryEloquent::class,
            \App\Interfaces\Repositories\ReviewRepositoryInterface::class => \App\Repositories\ReviewRepositoryEloquent::class,
        ];

        foreach ($repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap repositories.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
