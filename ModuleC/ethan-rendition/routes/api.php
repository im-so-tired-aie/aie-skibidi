<?php

use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProgrammesController;
use App\Http\Controllers\DiaryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'create']);
Route::post('login', [UserController::class, 'login']);
Route::middleware(\App\Http\Middleware\AuthMiddleware::class)->group(function () {
   Route::get('logout', [UserController::class, 'logout']);
   Route::get('user', [UserController::class, 'show']);
   Route::get('user/all', [UserController::class, 'index']);
   Route::delete('user/{user}', [UserController::class, 'delete']);
   Route::put('user/{user}', [UserController::class, 'update']);

    // Categories
    Route::get('categories', [CategoriesController::class, 'index']);

    // Programmes
    Route::get('programmes', [ProgrammesController::class, 'index']);

    // Criteria
    Route::get('criteria', [CriteriaController::class, 'index']);

    // Diary Entries
    Route::post('diaries', [DiaryController::class, 'create']);
    Route::get('diaries_by_enrolment', [DiaryController::class, 'diariesByEnrolment']);
    Route::get('diaries_progress_by_enrolment', [DiaryController::class, 'diariesProgressByEnrolment']);

    // Manage Diaries
    Route::prefix('diary')->group(function () {
       Route::put('/approve/{id}', [DiaryController::class, 'approve']);
       Route::put('/reject/{id}', [DiaryController::class, 'reject']);
    });
});
