<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IpAddressController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['jwt.verify'])->group(function () {
    Route::get('ips', [IpAddressController::class, 'index']);
    Route::post('ips', [IpAddressController::class, 'store']);
    Route::put('ips/{id}', [IpAddressController::class, 'update']);
    Route::delete('ips/{id}', [IpAddressController::class, 'destroy']);
});
