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
            //BACKEND
            \App\Interfaces\Repositories\AccountRepositoryInterface::class => \App\Repositories\AccountRepositoryEloquent::class,
            \App\Interfaces\Repositories\RoleRepositoryInterface::class => \App\Repositories\RoleRepositoryEloquent::class,
            \App\Interfaces\Repositories\BlogRepositoryInterface::class => \App\Repositories\BlogRepositoryEloquent::class,
            \App\Interfaces\Repositories\BlogRepositoryInterface::class => \App\Repositories\BlogRepositoryEloquent::class,
            \App\Interfaces\Repositories\CategoryRepositoryInterface::class => \App\Repositories\CategoryRepositoryEloquent::class,
            \App\Interfaces\Repositories\TableRepositoryInterface::class => \App\Repositories\TableRepositoryEloquent::class,
            \App\Interfaces\Repositories\PermissionRepositoryInterface::class => \App\Repositories\PermissionRepositoryEloquent::class,
            \App\Interfaces\Repositories\NotificationRepositoryInterface::class => \App\Repositories\NotificationRepositoryEloquent::class,
            \App\Interfaces\Repositories\ReviewRepositoryInterface::class => \App\Repositories\ReviewRepositoryEloquent::class,
            \App\Interfaces\Repositories\RestaurantRepositoryInterface::class => \App\Repositories\RestaurantRepositoryEloquent::class,
            \App\Interfaces\Repositories\MenuRepositoryInterface::class => \App\Repositories\MenuRepositoryEloquent::class,
            \App\Interfaces\Repositories\InvoiceRepositoryInterface::class => \App\Repositories\InvoiceRepositoryEloquent::class,

            // FRONTEND
            \App\Interfaces\Repositories\ReservationRepositoryInterface::class => \App\Repositories\ReservationRepositoryEloquent::class,
            \App\Interfaces\Repositories\PromotionRepositoryInterface::class => \App\Repositories\PromotionRepositoryEloquent::class,
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
