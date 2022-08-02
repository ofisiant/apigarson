<?php


use App\Http\Controllers\Api\v1\AppealController;
use App\Http\Controllers\Api\v1\ArchiveJobsController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\Admin\JobController;


use App\Http\Controllers\Api\v1\WorkController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('works', WorkController::class)->except('update');
    Route::apiResource('archive', ArchiveJobsController::class);
    Route::apiResource('appeal', AppealController::class);
    Route::apiResource('profile', ProfileController::class)->except('destroy');

    //@TODO add The Middleware
    Route::apiResource('admin/jobs', JobController::class);
});
