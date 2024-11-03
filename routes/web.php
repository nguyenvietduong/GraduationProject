<?php

use App\Events\NotificationEvent;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
Route::get('reservation', [ReservationController::class, 'create'])->name('reservation');
Route::post('reservation', [ReservationController::class, 'store'])->name('reservation');
Route::get('menu', [HomeController::class, 'menu'])->name('menu');
Route::get('team', [HomeController::class, 'team'])->name('team');
Route::get('review', [ReviewController::class, 'index'])->name('contact');
Route::post('review', [ReviewController::class, 'store'])->name('contact')->middleware('auth');
Route::get('blog', [BlogController::class, 'index'])->name('blog.list');
Route::get('blog-detail/{slug}', [BlogController::class, 'detail'])->name('blog.detail');

Route::get('notification', function () {
    $dataNotification = [
        'title' => 'Hello Tân',
        'message' => 'Hay',
        'type' => 'success',
        'data' => 'Duong2004',
        'created_at' => '24/10/2024 16:04:33',
    ];

    return event(new NotificationEvent($dataNotification));
});

Route::get('checkTable', function (Request $request) {
    $selectedDate = $request->input('date');

    // Convert to Carbon for further processing
    $now = Carbon::parse($selectedDate); // Lấy ngày đã chọn từ request
    $totalTables = 10;
    $threshold = $totalTables * (2 / 3);

    // Lấy tất cả đơn hàng đã xác nhận trong ngày
    $reservations = Reservation::whereDate('reservation_time', '=', $now)
        ->where('status', '=', 'confirmed')
        ->get();

    // Sắp xếp các đơn hàng theo giờ và 30 phút và kiểm tra số lượng
    $overdueReservationsByTimeSlot = $reservations->groupBy(function ($reservation) {
        $reservationTime = Carbon::parse($reservation->reservation_time);
        $hour = $reservationTime->format('H');
        $minutes = $reservationTime->minute < 30 ? '00' : '30'; // Đặt về 00 hoặc 30 phút
        return "$hour:$minutes"; // Nhóm theo giờ và 30 phút
    });

    $availabilityByTimeSlot = [];

    foreach ($overdueReservationsByTimeSlot as $timeSlot => $timeSlotReservations) {
        $reservationCount = $timeSlotReservations->count();
        $availabilityByTimeSlot[$timeSlot] = $reservationCount < $threshold; // true nếu còn chỗ, false nếu hết chỗ
    }

    // Trả về kết quả dưới dạng JSON
    return response()->json([
        'success' => true,
        'availability' => $availabilityByTimeSlot,
        'totalReservations' => $reservations->count(),
    ]);
});