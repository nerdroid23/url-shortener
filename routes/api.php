<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UrlController;


Route::apiResource('urls', UrlController::class)->except(['update']);
