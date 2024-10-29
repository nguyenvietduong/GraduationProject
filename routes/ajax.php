<?php

use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\Promotion\AjaxPromotion;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Import lớp Request
use App\Http\Controllers\Ajax\LanguageController;
use App\Http\Controllers\Ajax\BlogController;
use App\Http\Controllers\Ajax\ThemeController;
use App\Http\Controllers\Backend\Account\Ajax\UpdateStatusAccount;
use App\Http\Controllers\Backend\Account\ProfileController;

// Set System Ajax
Route::post('admin/promotion/updateStatus', [AjaxPromotion::class, 'updateStatus'])->name('admin.promotion.updateStatus');
Route::get('admin/permission/ajaxGetPermission', [PermissionController::class, 'ajaxGetPermission'])->name('admin.permission.ajaxGetPermission');
Route::post('set-language', [LanguageController::class, 'setLanguage']);
Route::post('set-theme', [ThemeController::class, 'setTheme'])->name('set.theme');
Route::post('profile/update/image', [ProfileController::class, 'updateProfileImage'])->name('profile.update.image');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('admin/account/updateStatus', [UpdateStatusAccount::class, 'updateStatus'])->name('admin.account.updateStatus');
Route::post('blog/upload', [BlogController::class, 'uploadImage'])->name('blog.upload');

// Xóa ảnh tạm thời trong session
Route::post('/remove-temp-image', function (Request $request) {
    if ($request->remove_image) {
        // Xóa ảnh tạm thời trong session
        session()->forget('image_temp');
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
})->name('image.removeTemp');
