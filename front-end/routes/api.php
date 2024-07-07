<?php

use App\Http\Controllers\Auth\LoginRegisterController;
use App\Http\Controllers\FormController;
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


Route::post('/login', [LoginRegisterController::class, 'login']);
Route::post('/signup', [LoginRegisterController::class, 'signup']);

Route::post('/logout', [LoginRegisterController::class, 'logout']);

Route::post('/review_post', [FormController::class, 'review_post']);