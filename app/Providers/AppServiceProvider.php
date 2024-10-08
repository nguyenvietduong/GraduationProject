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
            'App\Interfaces\Services\RoleServiceInterface' => 'App\Services\RoleService',
            'App\Interfaces\Services\PermissionServiceInterface' => 'App\Services\PermissionService',
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

        $idRoleAdmin = Role::where('id', 1)
            ->orWhere('id', 2)
            ->orWhere('name', 'admin')
            ->orWhere('name', 'Admin')
            ->orWhere('name', 'staff')
            ->orWhere('name', 'Staff')
            ->pluck('id')
            ->first(); // Lấy ID đầu tiên

        view()->share([
            'idRoleAdmin' => $idRoleAdmin,
        ]);
    }
}
