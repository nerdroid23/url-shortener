<?php

use App\Http\Controllers\UrlController;
use \Illuminate\Support\Facades\Route;

Route::view('', 'app');
Route::get('{url}', [UrlController::class, 'show']);
