<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Inertia\Inertia;

Route::get('', function () {
    return Inertia::render('Index');
});

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('password/email', [ForgotPasswordController::class, 'sendresetlinkemail'])->name('password.email');
Route::post('password/confirm', [ResetPasswordController::class, 'reset'])->name('password.update');
