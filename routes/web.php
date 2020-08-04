<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UrlController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('u/{url}', [UrlController::class, 'show']);

Route::view('{any}', 'app')->where(['any' => '.*']);
