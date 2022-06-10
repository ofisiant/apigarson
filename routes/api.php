<?php

use App\Http\Controllers\Api\Admin\JobController;
use App\Http\Controllers\Api\AppealController;
use App\Http\Controllers\Api\ArchiveJobsController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WorkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('works', WorkController::class)->except('update');
    Route::apiResource('works/archive', ArchiveJobsController::class);
    Route::apiResource('appeal', AppealController::class);
    Route::apiResource('profile', ProfileController::class);

    //@TODO add The Middleware
    Route::apiResource('admin/jobs', JobController::class);
});
