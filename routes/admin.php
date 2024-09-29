<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\RoleController;
use Illuminate\Http\Request;

Route::middleware(['auth', 'role:sysadmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        // Dashboard
        Route::get('/index', function () {
            return view('backend.dashboard.index');
        })->name('admin.dashboard.index');


        // User Management
        // Route::prefix('user')->group(function () {
        //     Route::get('index',         [UserController::class, 'index'])->name('admin.user.index');
        //     Route::get('create',        [UserController::class, 'create'])->name('admin.user.create');
        //     Route::post('store',        [UserController::class, 'store'])->name('admin.user.store');
        //     Route::get('{id}/edit',     [UserController::class, 'edit'])->where('id', '[0-9]+')->name('admin.user.edit');
        //     Route::post('{id}/update',  [UserController::class, 'update'])->where('id', '[0-9]+')->name('admin.user.update');
        //     Route::delete('{id}/destroy', [UserController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.user.destroy');
        // });
    });
});

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('', function () {
        return view('backend.dashboard.index');
    })->name('admin.dashboard.index');

    // Button
    Route::get('button', function () {
        return view('backend.dashboard.button');
    })->name('admin.dashboard.button');

    // Role Management
    Route::prefix('role')->group(function () {
        Route::get('index',             [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('{id}/edit',         [RoleController::class, 'edit'])->where('id', '[0-9]+')->name('admin.role.edit');
        Route::put('{id}/update',       [RoleController::class, 'update'])->where('id', '[0-9]+')->name('admin.role.update');
        Route::delete('{id}/destroy',   [RoleController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.role.destroy');
    });
});
