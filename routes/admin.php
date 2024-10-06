<?php

use App\Http\Controllers\Backend\Account\AdminController;
use App\Http\Controllers\Backend\Account\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;

Route::middleware(['auth', 'role:1,2'])->group(function () {
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
        });

        // Category Management
        Route::prefix('category')->group(function () {
            Route::get('index', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('create', [CategoryController::class, 'create'])->name('admin.category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('admin.category.store');
            Route::get('{id}/edit', [CategoryController::class, 'edit'])->where('id', '[0-9]+')->name('admin.category.edit');
            Route::post('{id}/update', [CategoryController::class, 'update'])->where('id', '[0-9]+')->name('admin.category.update');
            Route::delete('{id}/destroy', [CategoryController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.category.destroy');
        });
    });
});
