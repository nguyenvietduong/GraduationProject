<?php

namespace App\Providers;

use App\Models\Role;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $services = [
            'App\Interfaces\Services\ImageServiceInterface' => 'App\Services\ImageService',
            'App\Interfaces\Services\TempImageServiceInterface' => 'App\Services\TempImageService',
            'App\Services\BaseService',
            'App\Interfaces\Services\AccountServiceInterface' => 'App\Services\AccountService',
            'App\Interfaces\Services\CategoryServiceInterface' => 'App\Services\CategoryService',
            'App\Interfaces\Services\TableServiceInterface' => 'App\Services\TableService',

            'App\Interfaces\Services\RoleServiceInterface' => 'App\Services\RoleService',
            'App\Interfaces\Services\BlogServiceInterface' => 'App\Services\BlogService',
            'App\Interfaces\Services\PermissionServiceInterface' => 'App\Services\PermissionService',
            'App\Interfaces\Services\NotificationServiceInterface' => 'App\Services\NotificationService',
            'App\Interfaces\Services\ReviewServiceInterface' => 'App\Services\ReviewService',
            'App\Interfaces\Services\MenuServiceInterface' => 'App\Services\MenuService',
        ];

        foreach ($services as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS only in non-local environments
        if (config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();
        Builder::useVite();
    }
}
