<?php

use App\Http\Controllers\Ajax\Backend\Role\CreateRoleAjax;
use App\Http\Controllers\Ajax\Backend\Role\GetRoleDataAjax;
use App\Http\Controllers\Ajax\Backend\Role\UpdateRoleAjax;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\LanguageController;
use App\Http\Controllers\Ajax\ThemeController;

// Set System Ajax
Route::post('/set-language',        [LanguageController::class, 'setLanguage']);
Route::post('/set-theme',           [ThemeController::class,    'setTheme'])->name('set.theme');

// Role Ajax
Route::prefix('admin')->group(function () {
    // Role Management
    Route::prefix('role')->group(function () {
        Route::post('store',            [CreateRoleAjax::class, 'store'])                               ->name('admin.role.store');
        // Route::delete('{id}/destroy',   [RoleController::class, 'destroy'])->where('id', '[0-9]+')->name('admin.role.destroy');
    });
});
