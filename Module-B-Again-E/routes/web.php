<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TourPackageController;

Route::get("/", [TourPackageController::class, "index"]);
Route::get("/create", [TourPackageController::class, "create"]);
Route::post("/create", [TourPackageController::class, "store"]);
Route::get("/{path}", [TourPackageController::class, "show"])->where("path", ".*");
