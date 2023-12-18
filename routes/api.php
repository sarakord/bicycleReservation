<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::prefix('v1')->namespace('V1')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::post('login', 'AuthController@login');
    });

    Route::middleware(['auth:api'])->namespace('Users')->group(function () {
        Route::get('profile', 'ProfileController@profile');
        Route::get('bicycles', 'BicycleController@index');
        Route::post('bicycle/{bicycle}/reservation', 'ReservationController@reservation');
    });

    Route::prefix('admin')->namespace('Admin')->middleware(['auth:api', 'checkAdmin'])->group(function () {
        Route::patch('reservation/{reservation}/cancel', 'CancelReservationController@cancel');
    });
});

