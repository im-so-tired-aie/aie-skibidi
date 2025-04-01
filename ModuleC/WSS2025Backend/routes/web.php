<?php

use App\Http\Controllers\Criteriacontroller;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/admin/criteria', [Criteriacontroller::class,"manageview"]);

Route::get('/admin/criteria/create', [Criteriacontroller::class,"createview"]);


Route::post("/criteria/create",[Criteriacontroller::class,"create"]);

Route::get("/admin/criteria/{id}/delete",[Criteriacontroller::class,"delete"]);

Route::get("/admin/criteria/{id}/edit",[Criteriacontroller::class,"editview"]);

Route::post("/criteria/{id}/edit",[Criteriacontroller::class,"edit"]);

Route::get("/admin/users",[Usercontroller::class,"userconsoleview"]);

Route::get("/admin/users/create",[Usercontroller::class,"usercreateview"]);

Route::get("/admin/users/{id}/update",[Usercontroller::class,"userupdateview"]);

Route::post("/users/{id}/update",[Usercontroller::class,"userupdate"]);
Route::get("/admin/users/{id}/delete",[Usercontroller::class,"userdeleteview"]);

Route::post("/users/create",[Usercontroller::class,"createuser"]);
