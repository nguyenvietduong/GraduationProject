<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Ajax\LanguageController;
use App\Http\Controllers\Ajax\BlogController;
use App\Http\Controllers\Ajax\ThemeController;
use App\Http\Controllers\Backend\Account\Ajax\UpdateStatusAccount;
use App\Http\Controllers\Backend\Account\ProfileController;

// Set System Ajax
Route::post('set-language', [LanguageController::class, 'setLanguage']);
Route::post('set-theme', [ThemeController::class, 'setTheme'])->name('set.theme');
Route::post('profile/update/image', [ProfileController::class, 'updateProfileImage'])->name('profile.update.image');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('admin/account/updateStatus', [UpdateStatusAccount::class, 'updateStatus'])->name('admin.account.updateStatus');
Route::post('blog/upload', [BlogController::class, 'uploadImage'])->name('blog.upload');
