<?php

use App\Http\Controllers\Auth\SocialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes([
    'verify' => false,
]);

Route::get('auth/redirect/google', [SocialController::class, 'redirect'])->name('auth.google');
Route::get('callback/{provider}', [SocialController::class, 'callback']);
