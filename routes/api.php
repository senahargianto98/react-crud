<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoodController;
use App\Http\Controllers\AuthController;

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

Route::post('goods/edit', [GoodController::class, 'Update']);
Route::post('goods/delete/{id}', [GoodController::class, 'Delete']);
Route::post('goods', [GoodController::class, 'Store']);
Route::get('goods/paginate', [GoodController::class, 'Paginate']);
Route::get('goods', [GoodController::class, 'GetAll']);
Route::get('goods/{id}', [GoodController::class, 'Detail']);

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::get('user/{id}', [AuthController::class, 'detail']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('user', [AuthController::class, 'get']);
});
