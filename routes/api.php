<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'v1'], function () {

    Route::prefix('auth')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('login', 'login');
        });
    });

    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::post('logout', 'logout');
        });

        Route::group(['prefix' => 'user'], function () {
            Route::controller(UserController::class)->group(function() {
                Route::get('get-user', 'index');
                Route::post('switch-country', 'switchCountry');
            });

        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('all', [ProductController::class, 'index']);
        });

    });



    Route::group(['prefix' => 'country'], function () {
        Route::get('all', [CountryController::class, 'index']);
    });
});
