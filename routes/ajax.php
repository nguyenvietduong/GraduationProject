<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\Promotion\AjaxPromotion;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Ajax\LanguageController;
use App\Http\Controllers\Ajax\BlogController;
use App\Http\Controllers\Ajax\ThemeController;
use App\Http\Controllers\Backend\Account\ProfileController;
use App\Http\Controllers\Ajax\TableController;

use App\Http\Controllers\Backend\Ajax\UpdateStatusBlog;
use App\Http\Controllers\Backend\Ajax\UpdateStatusAccount;
use App\Http\Controllers\Backend\Ajax\UpdateStatusReview;
use App\Http\Controllers\Backend\Ajax\UpdateStatusMenu;


use App\Http\Controllers\Backend\Ajax\UpdatePositionTable;
use App\Http\Controllers\Backend\Ajax\UpdateStatusCategory;
use App\Http\Controllers\Backend\Ajax\UpdateStatusReservation;
use App\Http\Controllers\Backend\ChatController;
use App\Http\Controllers\Backend\NotificationController;
use App\Http\Controllers\Backend\Promotion\PromotionController;
use App\Http\Controllers\Backend\ReservationController as BackendReservationController;

use App\Http\Controllers\Backend\RestaurantController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProfilesController;

// Set System Ajax
Route::post('admin/promotion/updateStatus', [AjaxPromotion::class, 'updateStatus'])->name('admin.promotion.updateStatus');
Route::get('admin/permission/ajaxGetPermission', [PermissionController::class, 'ajaxGetPermission'])->name('admin.permission.ajaxGetPermission');
Route::post('set-language', [LanguageController::class, 'setLanguage']);
Route::post('set-theme', [ThemeController::class, 'setTheme'])->name('set.theme');
Route::post('profile/update/image', [ProfileController::class, 'updateProfileImage'])->name('profile.update.image');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('admin/account/updateStatus', [UpdateStatusAccount::class, 'updateStatus'])->name('admin.account.updateStatus');

Route::post('admin/reservation/updateStatus', [UpdateStatusReservation::class, 'updateStatus'])->name('admin.reservation.updateStatus');
Route::post('admin/reservation/updateTableStatus', [UpdateStatusReservation::class, 'updateTableStatus'])->name('admin.reservation.updateTableStatus');

Route::get('get-available-tables', [UpdateStatusReservation::class, 'getAvailableTables']);
Route::get('get-available-menus', [UpdateStatusReservation::class, 'getAvailableMenus']);
Route::get('get-data-search-menu', [UpdateStatusReservation::class, 'getDataSearchleMenus']);
Route::get('get-invoice-item-data', [UpdateStatusReservation::class, 'getInvoiceItemData']);
Route::post('create-new-reservation', [UpdateStatusReservation::class, 'createNewReservation']);
Route::post('create-invoice-detail', [UpdateStatusReservation::class, 'createInvoiceDataDetail']);
Route::post('update-invoice-detail', [UpdateStatusReservation::class, 'updateInvoiceDataDetail']);
Route::post('update-status-menu-invoice-detail', [UpdateStatusReservation::class, 'updateStatusMenuInvoiceDetail']);
Route::post('cancel-reservation-payment', [UpdateStatusReservation::class, 'cancelReservationPayment']);




Route::post('admin/menu/updateStatus', [UpdateStatusMenu::class, 'updateStatus'])->name('admin.menu.updateStatus');
Route::post('admin/blog/updateStatus', [UpdateStatusBlog::class, 'updateStatus'])->name('admin.blog.updateStatus');
Route::post('admin/review/updateStatus', [UpdateStatusReview::class, 'updateStatus'])->name('admin.review.updateStatus');
Route::post('admin/category/updateStatus', [UpdateStatusCategory::class, 'updateStatus'])->name('admin.category.updateStatus');
Route::post('admin/table/updatePositions', [UpdatePositionTable::class, 'updatePositions'])->name('admin.table.updatePositions');
Route::post('blog/upload', [BlogController::class, 'uploadImage'])->name('blog.upload');
Route::get('reservation/{id}/detail', [ReservationController::class, 'detail'])->where('id', '[0-9]+');
Route::get('reservation/{id}/canceled', [ReservationController::class, 'canceled'])->name('reservation.canceled');

Route::get('table/updateStatus', [TableController::class, 'updateStatus']);

Route::get('count-new-reviews-endpoint', [UpdateStatusReview::class, 'getNewReviewCount']);

Route::get('messages/users', [ChatController::class, 'getUsersWithMessages']);
Route::post('messages/send', [ChatController::class, 'sendMessage']);
Route::get('messages/{userId}', [ChatController::class, 'getMessages']);

Route::get('notifications/index', [NotificationController::class, 'index'])->name('notification.index');
Route::get('notifications/search', [NotificationController::class, 'search'])->name('notification.search');
Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::get('count-new-notifications-endpoint', [NotificationController::class, 'countUnreadNotifications']);
Route::get('seed-all', [NotificationController::class, 'seedAll']);

Route::post('check-availability', [ReservationController::class, 'checkAvailability'])->name('check.availability');
Route::get('checkTable', [BackendReservationController::class, 'checkTableFullyBookedTimes'])->name('checkTableFullyBookedTimes');

Route::post('/favorite-toggle', [FavoriteController::class, 'toggleFavorite'])->name('favorite.toggle');

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

Route::get("/checkVoucher", [AjaxPromotion::class, "getDetailVoucher"]);
Route::get("/checkVoucherClient", [AjaxPromotion::class, "getDetailVoucherClient"]);
Route::get("/searchVoucher", [AjaxPromotion::class, "searchVoucher"]);
Route::get("/getAllVoucher", [AjaxPromotion::class, "getAllVoucher"]);
Route::get('/reservation/confirm/{code}', [ReservationController::class, 'confirm'])->name('reservation.confirm');