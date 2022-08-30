<?php


use App\Http\Controllers\Api\v1\Admin\ConfirmUserController;
use App\Http\Controllers\Api\v1\Admin\UsersController;
use App\Http\Controllers\Api\v1\AppealController;
use App\Http\Controllers\Api\v1\ArchiveJobsController;
use App\Http\Controllers\Api\v1\ProfileController;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\Admin\JobController;


use App\Http\Controllers\Api\v1\UpdateProfileController;
use App\Http\Controllers\Api\v1\WorkController;
use Illuminate\Support\Facades\Route;


Route::controller(AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::apiResource('works', WorkController::class)->except('update' , 'destroy');
    Route::apiResource('archive', ArchiveJobsController::class);
    Route::apiResource('appeal', AppealController::class);
    Route::apiResource('profile', ProfileController::class)->except('destroy');
    Route::post('update-profile', [UpdateProfileController::class, 'updateProfile']);

    //@TODO Middleware - Yalniz adminlerin girishi !


    Route::prefix('admin')->group(function () {
        Route::apiResource('users', UsersController::class);
        Route::get('confirm-user',[ConfirmUserController::class , 'index']);
        Route::get('appeals',[\App\Http\Controllers\api\v1\Admin\AppealController::class , 'index']);
        Route::post('confirm-user/{id}',[ConfirmUserController::class , 'confirmUser']);


        Route::apiResource('jobs', JobController::class);
       // Route::post('create-job',[JobController::class , 'store']);

    });

});
