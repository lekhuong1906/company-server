<?php

use App\Http\Controllers\CareerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('careers', CareerController::class)->only(['index']);
Route::get('careers/{department_slug}', [CareerController::class,'getByDepartment'])->name('career.departmentJob');