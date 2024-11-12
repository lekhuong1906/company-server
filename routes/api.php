<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\JobLevelController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\StripeWebhookController;
use App\Models\JobLevel;

Route::post('login', [AuthController::class, 'login'])->name('login');

Route::prefix('auth')->middleware('auth:api')->group(function () {
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', action: [AuthController::class, 'me']);
    Route::apiResource('/departments', DepartmentController::class)->only('index');
    Route::apiResource('/levels', JobLevelController::class)->only('index');
});

Route::post('/register', [AuthController::class, 'register']);

Route::resource('careers', CareerController::class)->only(['index', 'store']);
Route::get('careers/{department_slug}', [CareerController::class, 'getByDepartment'])->name('career.departmentJob');

//Stripe
Route::post('/stripe/create-customer', [StripeController::class, 'createCustomer']);
Route::put('/stripe/update-customer/{user}', [StripeController::class, 'updateCustomer']);


//Webhook
Route::post('/webhook/stripe', [StripeWebhookController::class, 'handleWebhook']);
Route::post('/webhook/stripe/update-customer', [StripeWebhookController::class, 'handleWebhookUpdateCustomer']);