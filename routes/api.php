<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobLevelController;
use App\Models\JobLevel;

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::prefix('auth')->middleware('auth:sanctum')->group(function () {
    Route::post('/refresh-token', [AuthController::class, 'refresh_token']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::apiResource('/departments', DepartmentController::class)->only('index');
    Route::apiResource('/levels', JobLevelController::class)->only('index');
});

Route::post('/register', [AuthController::class, 'register']);

Route::resource('careers', CareerController::class)->only(['index','store']);
Route::get('careers/{department_slug}', [CareerController::class, 'getByDepartment'])->name('career.departmentJob');