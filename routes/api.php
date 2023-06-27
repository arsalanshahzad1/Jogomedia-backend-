<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\BlockchainUserApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UserApiController::class)->group(function () {
    Route::post('/send-user-data', 'sendUserData');
});

Route::controller(BlockchainUserApiController::class)->group(function () {
    Route::post('/blockchain-user-data', 'blockchaninUserData');
    Route::get('/get-blockchain-users', 'getUserData');
    Route::get('/get-blockchain-users-month-vice', 'getUserDataMonthVice');
    Route::get('/get-blockchain-users-month-vice2', 'getUserDataMonthVice2');
});
