<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register');
Route::post('login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('category', [\App\Http\Controllers\CategoryController::class, 'category'])->name('category');
Route::post('refreshToken', [\App\Http\Controllers\LoginController::class, 'refreshToken'])->name('refreshToken');
