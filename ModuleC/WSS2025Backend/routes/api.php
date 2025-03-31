<?php

use App\Http\Controllers\Categoriescontroller;
use App\Http\Controllers\Criteriacontroller;
use App\Http\Controllers\Diarycontroller;
use App\Http\Controllers\Programmecontroller;
use App\Http\Controllers\Usercontroller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register',[Usercontroller::class,"register"]);

Route::get("/test",[Usercontroller::class,"create_test_prog"]);

Route::post("/login",[Usercontroller::class,"login"]);

Route::get("/logout",[Usercontroller::class,"logout"]);

Route::get("/user",[Usercontroller::class,"user"]);

Route::get("/categories",[Categoriescontroller::class,"index"]);

Route::get("/programmes",[Programmecontroller::class,"index"]);

Route::get("/criteria",[Criteriacontroller::class,"index"]);

Route::post("/diaries",[Diarycontroller::class,"submit"]);

Route::get("/diaries_by_enrolment",[Diarycontroller::class,"show"]);

Route::put("/diary/approve/{id}",[Diarycontroller::class,"approve"]);

Route::put("/diary/reject/{id}",[Diarycontroller::class,"reject"]);

Route::get("/diaries_progress_by_enrolment",[Diarycontroller::class,"show_progress"]);

