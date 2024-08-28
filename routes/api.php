<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TaskController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
//Route::post('/v1/register', [UserController::class, 'register']);
Route::post('/v1/login', [UserController::class, 'login']);
//Route::get('/v1/confirm-email/{user_id}/{key}', [UserController::class, 'confirmMail']);
//
//
//// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['prefix' => 'v1'], function () {
            Route::post('/task/get-all', [TaskController::class, 'index']);
            Route::put('/task/statusChange', [TaskController::class, 'statusChange']);
            Route::get('/task/percentage', [TaskController::class, 'calculationPercentage']);
            Route::post('/task/create', [TaskController::class, 'store']);
            Route::put('/task/update', [TaskController::class, 'update']);
            Route::delete('/task/delete/{id}', [TaskController::class, 'destroy']);

            Route::get('/user/get', [UserController::class, 'get']);


    });

});

