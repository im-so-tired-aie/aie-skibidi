<?php

use App\Http\Controllers\Criteriacontroller;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

Route::get('/admin/criteria', [Criteriacontroller::class,"manageview"]);

Route::get('/admin/criteria/create', [Criteriacontroller::class,"createview"]);
