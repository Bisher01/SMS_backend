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
//Route::prefix('grades')->group(function (){
//    Route::get('/', [App\Http\Controllers\GradeController::class, 'index']);
//    Route::post('/', [App\Http\Controllers\GradeController::class, 'store']);
//    Route::get('/{grade}', [App\Http\Controllers\GradeController::class, 'show']);
//    Route::put('/{grade}', [App\Http\Controllers\GradeController::class, 'update']);
//    Route::delete('/{grade}', [App\Http\Controllers\GradeController::class, 'destroy']);
//    Route::get('/getSections/{grade}', [App\Http\Controllers\GradeController::class, 'getSections']);
//});
//Route::resource('class', 'App\Http\Controllers\ClassController');
////Route::delete('/class', [App\Http\Controllers\ClassController::class, 'destroy']);
//
//Route::resource('section', 'App\Http\Controllers\SectionController');
//Route::resource('class_section', 'App\Http\Controllers\Class_SectionController');
//Route::get('/classsections/{class_id}', [App\Http\Controllers\Class_SectionController::class, 'getclassSection']);



// abd
Route::post('test', [\App\Http\Controllers\General\LoginController::class, 'login']);
