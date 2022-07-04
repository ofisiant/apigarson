<?php

use App\Http\Controllers\Api\Admin\JobController;
use App\Http\Controllers\Api\AppealController;
use App\Http\Controllers\Api\ArchiveJobsController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('works', WorkController::class)->except('update');
    Route::apiResource('archive', ArchiveJobsController::class);
    Route::apiResource('appeal', AppealController::class);
    Route::apiResource('profile', ProfileController::class);

    //@TODO add The Middleware
    Route::apiResource('admin/jobs', JobController::class);
});
