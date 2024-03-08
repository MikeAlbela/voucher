<?php

use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\VoucherController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(RegisterController::class)->group(function() {
    Route::post('/register', 'register')->name('register');
   
    Route::post('/login', 'login')->name('login');
});
//Route::post('register', 'RegisterController@register');
//Route::post('login', 'RegisterController@login');
Route::middleware('auth:api')->group( function () {
    Route::controller(VoucherController::class)->group(function() {
        Route::get('/list', 'getAllVouchers')->name('list');
        Route::get('/generate', 'getVoucher')->name('generate');
        Route::post('/delete', 'deleteVoucher')->name('delete');
    });
});