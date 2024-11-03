<?php

use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\Promotion\AjaxPromotion;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request; // Import lớp Request
use App\Http\Controllers\Ajax\LanguageController;
use App\Http\Controllers\Ajax\BlogController;
use App\Http\Controllers\Ajax\ThemeController;
use App\Http\Controllers\Backend\Account\ProfileController;
use App\Http\Controllers\Ajax\TableController;

use App\Http\Controllers\Backend\Ajax\UpdateStatusBlog;
use App\Http\Controllers\Backend\Ajax\UpdateStatusAccount;
use App\Http\Controllers\Backend\Ajax\UpdateStatusReview;
use App\Http\Controllers\Backend\Ajax\UpdateStatusMenu;

use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\Category\Ajax\UpdateStatusCategory;
use App\Http\Controllers\Backend\RestaurantController;

// Set System Ajax
Route::post('admin/promotion/updateStatus', [AjaxPromotion::class, 'updateStatus'])->name('admin.promotion.updateStatus');
Route::get('admin/permission/ajaxGetPermission', [PermissionController::class, 'ajaxGetPermission'])->name('admin.permission.ajaxGetPermission');
Route::post('set-language', [LanguageController::class, 'setLanguage']);
Route::post('set-theme', [ThemeController::class, 'setTheme'])->name('set.theme');
Route::post('profile/update/image', [ProfileController::class, 'updateProfileImage'])->name('profile.update.image');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('admin/account/updateStatus', [UpdateStatusAccount::class, 'updateStatus'])->name('admin.account.updateStatus');
Route::post('blog/upload', [BlogController::class, 'uploadImage'])->name('blog.upload');
Route::post('admin/account/updateStatus', [UpdateStatusMenu::class, 'updateStatus'])->name('admin.menu.updateStatus');
Route::post('admin/blog/updateStatus', [UpdateStatusBlog::class, 'updateStatus'])->name('admin.blog.updateStatus');
Route::post('admin/review/updateStatus', [UpdateStatusReview::class, 'updateStatus'])->name('admin.review.updateStatus');
Route::post('admin/category/updateStatus', [UpdateStatusCategory::class, 'updateStatus'])->name('admin.category.updateStatus');
Route::post('blog/upload', [BlogController::class, 'uploadImage'])->name('blog.upload');

Route::get('table/updateStatus', [TableController::class, 'updateStatus']);

Route::get('/count-new-reviews-endpoint', [UpdateStatusReview::class, 'getNewReviewCount']);

Route::get('/messages/users', [ChatController::class, 'getUsersWithMessages']);
Route::post('/messages/send', [ChatController::class, 'sendMessage']);
Route::get('/messages/{userId}', [ChatController::class, 'getMessages']);

Route::get('/notifications/index', [NotificationController::class, 'index'])->name('notification.index');
Route::get('/notifications/search', [NotificationController::class, 'search'])->name('notification.search');
Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::get('/count-new-notifications-endpoint', [NotificationController::class, 'countUnreadNotifications']);

// Xóa ảnh tạm thời trong session
Route::post('/remove-temp-image', function (Request $request) {
    if ($request->remove_image) {
        // Xóa ảnh tạm thời trong session
        session()->forget('image_temp');
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
})->name('image.removeTemp');


Route::post('restaurant/update/image', [RestaurantController::class, 'updateRestaurantImage'])->name('restaurant.update.image');
Route::post('restaurant{id}/update', [RestaurantController::class, 'updateRestaurant'])->name('restaurant.update');


// Xóa ảnh tạm thời trong session
Route::post('/remove-temp-image', function (Request $request) {
    if ($request->remove_image) {
        // Xóa ảnh tạm thời trong session
        session()->forget('image_temp');
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false], 400);
})->name('image.removeTemp');
