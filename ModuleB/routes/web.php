<?php

use App\Http\Controllers\TourPackageController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [TourPackageController::class, 'index']);
