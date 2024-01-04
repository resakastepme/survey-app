<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// ROUTE TO MAINTENANCE MODE
Route::get('/maintenance-mode', function () {
    Artisan::call('down');
    return 'Maintenance mode is enabled';
});

// ROUTE TO DISABLE MAINTENANCE MODE
Route::get('/disable-maintenance-mode', function () {
    Artisan::call('up');
    return 'Maintenance mode is disabled';
});
