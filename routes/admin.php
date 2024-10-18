<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\Account\AdminController;
use App\Http\Controllers\Backend\Account\StaffController;
use App\Http\Controllers\Backend\Account\UserController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\PermissionController;

Route::middleware(['auth', 'role:1, 2'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/index', function () {
            return view('backend.dashboard.index');
        })->name('admin.dashboard.index');

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

        Route::prefix('permission')->group(function () {
            Route::get('index', [PermissionController::class, 'index'])->name('admin.permission.index');
            Route::get('create', [PermissionController::class, 'create'])->name('admin.permission.create');
            Route::post('store', [PermissionController::class, 'store'])->name('admin.permission.store');
            Route::get('{permission}/edit', [PermissionController::class, 'edit'])->where('permission', '[0-9]+')->name('admin.permission.edit');
            Route::put('{permission}/update', [PermissionController::class, 'update'])->where('permission', '[0-9]+')->name('admin.permission.update');
            Route::delete('{permission}/destroy', [PermissionController::class, 'destroy'])->where('permission', '[0-9]+')->name('admin.permission.destroy');
        });

        Route::prefix('blog')->group(function () {
            Route::get('index', [BlogController::class, 'index'])->name('admin.blog.index');
            Route::get('create', [BlogController::class, 'create'])->name('admin.blog.create');
            Route::post('store', [BlogController::class, 'store'])->name('admin.blog.store');
            Route::get('{id}/edit', [BlogController::class, 'edit'])->where('id', '[0-9]+')->name('admin.blog.edit');
            Route::put('{id}/update', [BlogController::class, 'update'])->where('id', '[0-9]+')->name('admin.blog.update');
            Route::delete('{id}/destroy', [BlogController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.blog.destroy');
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
            Route::post('store', [MenuController::class, 'store'])->name('admin.menu.store')->middleware("currency");
            Route::get('{id}/edit', [MenuController::class, 'edit'])->where('id', '[0-9]+')->name('admin.menu.edit');
            Route::put('{id}/update', [MenuController::class, 'update'])->where('id', '[0-9]+')->name('admin.menu.update')->middleware("currency");;
            Route::delete('{id}/destroy', [MenuController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.menu.destroy');
        });

        Route::prefix('notification')->group(function () {
            Route::get('index', [NotificationController::class, 'index'])->name('admin.notification.index');
        });
    });
});
