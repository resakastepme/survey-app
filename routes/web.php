<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SurveyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//STORAGE:LINK ROUTE
Route::get('/generate', function () {
    Artisan::call('storage:link');
    echo 'ok';
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

Route::get('/', function () {
    return view('index');
});
Route::post('/submit', [SurveyController::class, 'submit']);
Route::post('/sendEmail', [SurveyController::class, 'sendEmail']);
Route::get('/getResponden', [SurveyController::class, 'getResponden']);
Route::get('/getRespondens', [SurveyController::class, 'getRespondens']);
Route::get('/fillAgain', [SurveyController::class, 'fillAgain']);
Route::get('/cache', [SurveyController::class, 'cache']);

// ADMIN ROUTE
Route::prefix('/adminPlace')->group(function () {
    Route::get('/create-acc', [AuthController::class, 'create']);
    Route::get('/', [AuthController::class, 'index']);
    Route::post('/auth', [AuthController::class, 'auth']);
    Route::get('/home', [AuthController::class, 'home']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

// CHECK ROUTE
Route::get('/check', function () {
    $q = cache()->forget('surveys_isSubmitted');
    $q2 = cache()->forget('surveys_responden_id');
    return 'isSubmitted: ' . $q . ' & responden_id: ' . $q2;
});
Route::get('/check2', function () {
    return 'isSubmitted: ' . cache('surveys_isSubmitted') . ' & responden_id: ' . cache('surveys_responden_id');
});
