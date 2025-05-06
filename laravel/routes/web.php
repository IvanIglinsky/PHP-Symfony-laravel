<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\RepairController;
use App\Http\Controllers\RepairPartController;
Route::get('/', function () {
return view('welcome');
});

Route::resource('clients', ClientController::class);
Route::resource('cars', CarController::class);


Route::resource('parts', PartController::class);
Route::resource('repairs', RepairController::class);

Route::resource('repairParts', RepairPartController::class);
