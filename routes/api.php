<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use function PHPSTORM_META\map;

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

Route::prefix('general')->group(function () {
    Route::post('/login', [\App\Http\Controllers\General\LoginController::class, 'login']);
});

Route::prefix('AcademicYear')->group(function () {
    Route::get('all', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'index']);
    Route::post('add', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'store']);
    Route::put('update/{yearId}', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'update']);
    Route::delete('delete/{yearId}', [App\Http\Controllers\Academic_year\AcademicYearController::class, 'destroy']);
});

<<<<<<< HEAD
Route::prefix('student')->group(function () {
    Route::post('add', [\App\Http\Controllers\Student\AddStudentController::class, 'store']);
});
=======

//Route::post('store', [App\Http\Controllers\StudentController::class, 'store']);

Route::resource('student', 'App\Http\Controllers\StudentController');
>>>>>>> 536c4fc4de2cc2935a79c310fa76c4918a8b1d79
