<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductsController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'products', 'middleware' => 'auth:sanctum'],  function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::post('/', [ProductsController::class, 'store']);
    Route::get('/{id}', [ProductsController::class, 'show']);
    Route::patch('/{id}', [ProductsController::class, 'update']);
    Route::delete('/{id}', [ProductsController::class, 'delete']);
});

Route::group(['prefix' => 'auth'],
    function () {
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/registration', [AuthController::class, 'registration']);
        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::get('/logout', [AuthController::class, 'logout']);
        });
    });
