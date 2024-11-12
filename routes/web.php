<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
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
Route::post('review', [ReviewController::class, 'store'])->name('contact');
Route::get('blog', [BlogController::class, 'index'])->name('blog.list');
Route::get('blog-detail/{slug}', [BlogController::class, 'detail'])->name('blog.detail');