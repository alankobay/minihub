<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/healthcheck', function () {
    return response()->json([
        'status' => 200,
    ]);
})->name('api.healthcheck');

Route::group(['prefix' => 'v1'], function () {
    Route::any('webhook/platform', [App\Http\Controllers\NotificationController::class, 'platform'])
        ->name('api.v1.webhook.platform');
});
