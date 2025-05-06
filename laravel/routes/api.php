<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/admin/data', [AdminController::class, 'index']);
});

Route::middleware(['auth:api', 'role:manager'])->group(function () {
    Route::get('/manager/data', [ManagerController::class, 'index']);
});

Route::middleware(['auth:api', 'role:client'])->group(function () {
    Route::get('/client/data', [ClientController::class, 'index']);
});
