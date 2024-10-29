<?php

use App\Events\NotificationEvent;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
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
Route::get('reservation', [HomeController::class, 'reservation'])->name('reservation');
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
