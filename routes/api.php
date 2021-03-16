<?php

use App\Http\Controllers\Api\V1\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\NewsController;
use App\Http\Controllers\Api\V1\EventController;
use App\Http\Controllers\Api\V1\CommentController;

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

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('news', [NewsController::class, 'index']);
Route::get('events', [EventController::class, 'index']);

Route::middleware(['auth:api'])->group(function () {
    Route::get('news/{id}', [NewsController::class, 'getById']);
    Route::post('news', [NewsController::class, 'create']);
    Route::put('news/{id}', [NewsController::class, 'update']);
    Route::delete('news/{id}', [NewsController::class, 'delete']);

    Route::get('events/{id}', [EventController::class, 'getById']);
    Route::post('events', [EventController::class, 'create']);
    Route::put('events/{id}', [EventController::class, 'update']);
    Route::delete('events/{id}', [EventController::class, 'delete']);

    Route::post('comments', [CommentController::class, 'create']);
    Route::delete('comments/{id}', [CommentController::class, 'delete']);
});
