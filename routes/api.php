<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\AuthController;

Route::post('/login',[AuthController::class,'login'])->name('login');

Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});

Route::post('/register', [AuthController::class, 'register']);

Route::resource('careers', CareerController::class)->only(['index']);
Route::get('careers/{department_slug}', [CareerController::class, 'getByDepartment'])->name('career.departmentJob');