<?php

use App\Http\Controllers\UrlController;
use \Illuminate\Support\Facades\Route;

Route::get('u/{url}', [UrlController::class, 'show']);
Route::view('{any}', 'app')->where(['any' => '.*']);
