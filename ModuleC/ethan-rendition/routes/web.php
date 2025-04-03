<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/admin/criteria');
});

Route::view('/login', 'login')->name('login');
Route::prefix("admin")->group(function () {
    Route::prefix("criteria")->group(function () {
        Route::view("/", "criteria.index");
        Route::view("/create", "criteria.create");
        Route::get("/{id}/edit", function (int $id) {
            return view("criteria.edit", [
                "id" => $id
            ]);
        });
    });

    Route::prefix("users")->group(function () {
        Route::view("/", "users.index");
        Route::view("/create", "users.create");
        Route::get("/{id}/edit", function (int $id) {
            return view("users.edit", [
                "id" => $id
            ]);
        });
    });
})->middleware("auth");
