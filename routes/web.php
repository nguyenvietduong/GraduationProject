<?php

use App\Events\NotificationEvent;
use App\Http\Controllers\Backend\PaymentController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FavoriteController;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

Route::get('', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->get('history/reservation/list',[ReservationController::class,'listReservation'])->name('reservation.list');
Route::post('history/reservation/list', [ReviewController::class, 'store']);
Route::get('reservation', [ReservationController::class, 'create'])->name('reservation');
Route::post('reservation', [ReservationController::class, 'store'])->name('reservation');
Route::get('menu', [HomeController::class, 'menu'])->name('menu');
Route::get('review', [ReviewController::class, 'index'])->name('contact');
Route::post('review', [ReviewController::class, 'store'])->name('review.post');
Route::get('blog', [BlogController::class, 'index'])->name('blog.list');
Route::get('blog-detail/{slug}', [BlogController::class, 'detail'])->name('blog.detail');
Route::get('favortite/{menus}', [FavoriteController::class,  'favorite'])->name('favorite');
Route::get('favortite', [FavoriteController::class,  'favorite_list'])->name('favorite.list');

// Cổng thanh toán VNpay
Route::post('vnpay_payment', [PaymentController::class,  'vnpay_payment'])->name('vnpay_payment');
Route::get('/vnpay/callback', [PaymentController::class, 'handlePaymentReturn'])->name('vnpay.return');

Route::group(['middleware' => 'profile'], function () {
    Route::get('profile', [ProfilesController::class, 'profile'])->name('profile');
    Route::post('profile', [ProfilesController::class, 'update_profile'])->name('profile');
});

Route::get('json', function () {
    $categories = Category::with('menus')->get();

    return [
        'response' => response()->json(['message' => 'Status updated successfully']),
        'categories' => $categories
    ];
});
