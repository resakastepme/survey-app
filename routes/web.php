<?php

use Illuminate\Support\Facades\Route;
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
    \Illuminate\Support\Facades\Artisan::call('storage:link');
    echo 'ok';
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

// CHECK ROUTE
Route::get('/check', function () {
    $q = cache()->forget('surveys_isSubmitted');
    $q2 = cache()->forget('surveys_responden_id');
    return 'isSubmitted: ' . $q . ' & responden_id: ' . $q2;
});
Route::get('/check2', function () {
    return 'isSubmitted: ' . cache('surveys_isSubmitted') . ' & responden_id: ' . cache('surveys_responden_id');
});
