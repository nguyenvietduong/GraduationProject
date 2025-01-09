<?php

use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\Backend\Promotion\PromotionController;
use App\Http\Controllers\Backend\TableController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Account\AdminController;
use App\Http\Controllers\Backend\Account\StaffController;
use App\Http\Controllers\Backend\Account\UserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DishController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ReservationController;
use App\Http\Controllers\Backend\RestaurantController;
use App\Http\Controllers\Backend\ReviewController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\SearchController;
use App\Http\Controllers\Backend\StatisticalController;

Route::middleware(['auth', 'role:1, 2, 3, 4'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/index', [DashboardController::class, "index"])->name('admin.dashboard.index');

        // User Management
        Route::prefix('user')->group(function () {
            Route::get('index', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('store', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('{id}/edit', [UserController::class, 'edit'])->where('id', '[0-9]+')->name('admin.user.edit');
            Route::put('{id}/update', [UserController::class, 'update'])->where('id', '[0-9]+')->name('admin.user.update');
            Route::delete('{id}/destroy', [UserController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.user.destroy');
        });

        Route::prefix('staff')->group(function () {
            Route::get('index', [StaffController::class, 'index'])->name('admin.staff.index');
            Route::get('create', [StaffController::class, 'create'])->name('admin.staff.create');
            Route::post('store', [StaffController::class, 'store'])->name('admin.staff.store');
            Route::get('{id}/edit', [StaffController::class, 'edit'])->where('id', '[0-9]+')->name('admin.staff.edit');
            Route::put('{id}/update', [StaffController::class, 'update'])->where('id', '[0-9]+')->name('admin.staff.update');
            Route::delete('{id}/destroy', [StaffController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.staff.destroy');
        });

        // Admin Management
        Route::prefix('admin')->group(function () {
            Route::get('index', [AdminController::class, 'index'])->name('admin.admin.index');
            Route::get('create', [AdminController::class, 'create'])->name('admin.admin.create');
            Route::post('store', [AdminController::class, 'store'])->name('admin.admin.store');
            Route::get('{id}/edit', [AdminController::class, 'edit'])->where('id', '[0-9]+')->name('admin.admin.edit');
            Route::put('{id}/update', [AdminController::class, 'update'])->where('id', '[0-9]+')->name('admin.admin.update');
            Route::delete('{id}/destroy', [AdminController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.admin.destroy');
        });

        // Profile Management
        Route::get('profile', function () {
            return view('backend.account.profile');
        })->name('admin.profile');

        // Role Management
        Route::prefix('role')->group(function () {
            Route::get('index', [RoleController::class, 'index'])->name('admin.role.index');
            Route::get('create', [RoleController::class, 'create'])->name('admin.role.create');
            Route::post('store', [RoleController::class, 'store'])->name('admin.role.store');
            Route::get('{id}/edit', [RoleController::class, 'edit'])->where('id', '[0-9]+')->name('admin.role.edit');
            Route::put('{id}/update', [RoleController::class, 'update'])->where('id', '[0-9]+')->name('admin.role.update');
            Route::delete('{id}/destroy', [RoleController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.role.destroy');
            Route::get('permission', [RoleController::class, 'permission'])->name('admin.role.permission');
            Route::post('updatePermission', [RoleController::class, 'updatePermission'])->name('admin.role.updatePermission');
        });

        // Permission Management
        Route::prefix('permission')->group(function () {
            Route::get('index', [PermissionController::class, 'index'])->name('admin.permission.index');
            Route::get('create', [PermissionController::class, 'create'])->name('admin.permission.create');
            Route::post('store', [PermissionController::class, 'store'])->name('admin.permission.store');
            Route::get('{permission}/edit', [PermissionController::class, 'edit'])->where('permission', '[0-9]+')->name('admin.permission.edit');
            Route::put('{permission}/update', [PermissionController::class, 'update'])->where('permission', '[0-9]+')->name('admin.permission.update');
            Route::delete('{permission}/destroy', [PermissionController::class, 'destroy'])->where('permission', '[0-9]+')->name('admin.permission.destroy');
        });

        Route::prefix('promotion')->group(function () {
            Route::get('index', [PromotionController::class, 'index'])->name('admin.promotion.index');
            Route::get('create', [PromotionController::class, 'create'])->name('admin.promotion.create');
            Route::post('store', [PromotionController::class, 'store'])->name('admin.promotion.store');
            Route::get('{promotion}/edit', [PromotionController::class, 'edit'])->where('promotion', '[0-9]+')->name('admin.promotion.edit');
            Route::put('{promotion}/update', [PromotionController::class, 'update'])->where('promotion', '[0-9]+')->name('admin.promotion.update');
            Route::delete('{promotion}/destroy', [PromotionController::class, 'destroy'])->where('promotion', '[0-9]+')->name('admin.promotion.destroy');
        });

        Route::prefix('blog')->group(function () {
            Route::get('index', [BlogController::class, 'index'])->name('admin.blog.index');
            Route::get('create', [BlogController::class, 'create'])->name('admin.blog.create');
            Route::post('store', [BlogController::class, 'store'])->name('admin.blog.store');
            Route::get('{id}/edit', [BlogController::class, 'edit'])->where('id', '[0-9]+')->name('admin.blog.edit');
            Route::put('{id}/update', [BlogController::class, 'update'])->where('id', '[0-9]+')->name('admin.blog.update');
            Route::delete('{id}/destroy', [BlogController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.blog.destroy');
        });

        Route::prefix('review')->group(function () {
            Route::get('index', [ReviewController::class, 'index'])->name('admin.review.index');
            Route::get('create', [ReviewController::class, 'create'])->name('admin.review.create');
            Route::post('store', [ReviewController::class, 'store'])->name('admin.review.store');
            Route::get('{id}/edit', [ReviewController::class, 'edit'])->where('id', '[0-9]+')->name('admin.review.edit');
            Route::put('{id}/update', [ReviewController::class, 'update'])->where('id', '[0-9]+')->name('admin.review.update');
            Route::delete('{id}/destroy', [ReviewController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.review.destroy');
        });

        // Category Management
        Route::prefix('category')->group(function () {
            Route::get('index', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('{id}/edit', [CategoryController::class, 'edit'])->where('id', '[0-9]+')->name('admin.category.edit');
            Route::put('{id}/update', [CategoryController::class, 'update'])->where('id', '[0-9]+')->name('admin.category.update');
            Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.category.destroy');
        });

        Route::prefix('menu')->group(function () {
            Route::get('index', [MenuController::class, 'index'])->name('admin.menu.index');
            Route::get('create', [MenuController::class, 'create'])->name('admin.menu.create');
            Route::post('store', [MenuController::class, 'store'])->name('admin.menu.store');
            Route::get('{id}/edit', [MenuController::class, 'edit'])->where('id', '[0-9]+')->name('admin.menu.edit');
            Route::put('{id}/update', [MenuController::class, 'update'])->where('id', '[0-9]+')->name('admin.menu.update');
            Route::delete('{id}/destroy', [MenuController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.menu.destroy');
        });

        Route::prefix('table')->group(function () {
            Route::get('index', [TableController::class, 'index'])->name('admin.table.index');
            Route::get('create', [TableController::class, 'create'])->name('admin.table.create');
            Route::post('store', [TableController::class, 'store'])->name('admin.table.store');
            Route::get('{id}/edit', [TableController::class, 'edit'])->where('id', '[0-9]+')->name('admin.table.edit');
            Route::put('{id}/update', [TableController::class, 'update'])->where('id', '[0-9]+')->name('admin.table.update');
            Route::delete('{id}/destroy', [TableController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.table.destroy');
            Route::get('position', [TableController::class, 'tablePosition'])->name('admin.table.position');
        });

        Route::prefix('reservation')->group(function () {
            Route::get('index', [ReservationController::class, 'index'])->name('admin.reservation.index');
            Route::get('create', [ReservationController::class, 'create'])->name('admin.reservation.create');
            Route::post('store', [ReservationController::class, 'store'])->name('admin.reservation.store');
            Route::get('{id}/detail', [ReservationController::class, 'detail'])->where('id', '[0-9]+')->name('admin.reservation.detail');
            Route::get('{id}/edit', [ReservationController::class, 'edit'])->where('id', '[0-9]+')->name('admin.reservation.edit');
            Route::put('{id}/update', [ReservationController::class, 'update'])->where('id', '[0-9]+')->name('admin.reservation.update');
            Route::delete('{id}/destroy', [ReservationController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.reservation.destroy');
        });
        Route::prefix('invoice')->group(function () {
            Route::get('index', [InvoiceController::class, 'index'])->name('admin.invoice.index');
            Route::get('{id}/detail', [InvoiceController::class, 'detail'])->where('id', '[0-9]+')->name('admin.invoice.detail');
            Route::post('store', [InvoiceController::class, 'store'])->name('admin.invoice.store');
            Route::post('exportPDF', [InvoiceController::class, 'exportAndSavePDF'])->name('admin.invoice.exportPDF');
        });

        Route::prefix('dish')->group(function () {
            Route::get('index', [DishController::class, 'index'])->name('admin.dish.index');
            Route::get('create', [DishController::class, 'create'])->name('admin.dish.create');
            Route::post('store', [DishController::class, 'store'])->name('admin.dish.store');
            Route::get('{id}/detail', [DishController::class, 'detail'])->where('id', '[0-9]+')->name('admin.dish.detail');
            Route::get('{id}/edit', [DishController::class, 'edit'])->where('id', '[0-9]+')->name('admin.dish.edit');
            Route::put('{id}/update', [DishController::class, 'update'])->where('id', '[0-9]+')->name('admin.dish.update');
            Route::delete('{id}/destroy', [DishController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.dish.destroy');
        });
        Route::prefix('chat')->group(function () {
            Route::get('index', [NotificationController::class, 'index'])->name('admin.chat.index');
        });

        Route::prefix('notification')->group(function () {
            Route::get('index', [NotificationController::class, 'index'])->name('admin.notification.index');
        });

        Route::prefix('restaurant')->group(function () {
            Route::get('index', [RestaurantController::class, 'index'])->name('admin.restaurants');
        });
        Route::prefix('invoice')->group(function () {
            Route::get('testPDF', [InvoiceController::class, 'generatePDF'])->name('admin.restaurant');
        });

        Route::prefix('statistical')->group(function () {
            Route::get('revenue', [StatisticalController::class, 'index'])->name('admin.statistical.index');
            Route::get('menu', [StatisticalController::class, 'menu'])->name('admin.statistical.menu');
            Route::get('client', [StatisticalController::class, 'client'])->name('admin.statistical.client');
            Route::get('reservations', [StatisticalController::class, 'reservation'])->name('admin.statistical.reservations');
            Route::get('revenue-statistics', [StatisticalController::class, 'getRevenueStatistics']);
            Route::get('top-clients', [StatisticalController::class, 'getCustomerStatistics']);
            Route::get('top-menus', [StatisticalController::class, 'getMenuItemsWithReservationCounts']);
            Route::get('top-tables', [StatisticalController::class, 'getTableReservationStats']);
        });
        Route::prefix('payment')->group(function () {
            Route::get('{id}', [PaymentController::class, 'show'])->name('admin.payment.index');
        });

        Route::get('search', [SearchController::class, 'search'])->name('search');
    });
});
