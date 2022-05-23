<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/admin', [\App\Http\Controllers\Admin\AuthAdminController::class, 'login']);
Route::post('/adminn', [\App\Http\Controllers\Admin\AuthAdminController::class, 'signup']);


Route::post('test', [\App\Http\Controllers\General\LoginController::class, 'login']);

Route::prefix('AcademicYear')->group(function () {
    Route::get('all', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'index']);
    Route::post('add', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'store']);
    Route::put('update/{yearId}', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'update']);
    Route::delete('delete/{yearId}', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'destroy']);
});
