<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GatewayController;

// Catch all API requests
Route::any('{any}', [GatewayController::class, 'handle'])->where('any', '.*');