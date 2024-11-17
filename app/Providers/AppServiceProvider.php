<?php

namespace App\Providers;

use App\Models\Restaurant;
use App\Services\NotificationService;
use App\Services\ReviewService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use App\Helpers\Helper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $services = [
            //BACKEND
            'App\Interfaces\Services\ImageServiceInterface' => 'App\Services\ImageService',
            'App\Interfaces\Services\TempImageServiceInterface' => 'App\Services\TempImageService',
            'App\Services\BaseService',
            'App\Interfaces\Services\AccountServiceInterface' => 'App\Services\AccountService',
            'App\Interfaces\Services\CategoryServiceInterface' => 'App\Services\CategoryService',
            'App\Interfaces\Services\TableServiceInterface' => 'App\Services\TableService',
            'App\Interfaces\Services\InvoiceServiceInterface' => 'App\Services\InvoiceService',
            'App\Interfaces\Services\RoleServiceInterface' => 'App\Services\RoleService',
            'App\Interfaces\Services\BlogServiceInterface' => 'App\Services\BlogService',
            'App\Interfaces\Services\PermissionServiceInterface' => 'App\Services\PermissionService',
            'App\Interfaces\Services\NotificationServiceInterface' => 'App\Services\NotificationService',
            'App\Interfaces\Services\ReviewServiceInterface' => 'App\Services\ReviewService',
            'App\Interfaces\Services\RestaurantServiceInterface' => 'App\Services\RestaurantService',
            'App\Interfaces\Services\MenuServiceInterface' => 'App\Services\MenuService',

            // FRONTEND
            'App\Interfaces\Services\ReservationServiceInterface' => 'App\Services\ReservationService',
            'App\Interfaces\Services\PromotionServiceInterface' => 'App\Services\PromotionService',
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

        View::composer('*', function ($view) {
            $reviewService = app(ReviewService::class);
            $newReviewCount = $reviewService->countNewReviews();

            $restaurantDatas = app(Restaurant::class);
            $restaurantDatas = $restaurantDatas->first();

            $description = json_decode($restaurantDatas->description, true);
            $priceData = json_decode($restaurantDatas->price, true); // Giả sử bạn có giá trong cơ sở dữ liệu cũng được lưu dưới dạng JSON
     
         
    
            $notificationService = app(NotificationService::class);
            $dataNotification = $notificationService->getAllNotifications();
            $unreadNotificationCount = $notificationService->countUnreadNotifications();
    
            $view->with('newReviewCount', $newReviewCount);
            $view->with('dataNotification', $dataNotification);
            $view->with('unreadNotificationCount', $unreadNotificationCount);
            $view->with('restaurantDatas', $restaurantDatas);
            $view->with('description', $description);
            $view->with('priceData', $priceData);
        });

        Paginator::useBootstrapFive();
        Builder::useVite();
    }
}
