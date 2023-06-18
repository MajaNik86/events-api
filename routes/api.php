<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\CommentController;

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

Route::controller(AuthController::class)->group(
    function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::post('refresh', 'refresh');
        Route::post('logout', 'logout');
        Route::get('me', 'getActiveUser');
    }
);

Route::resource('events', EventsController::class);


Route::get('/events/{id}/comments', [CommentController::class, 'index']);
Route::get('/comments/{id}', [CommentController::class, 'show']);
Route::post('/events/{id}/comments', [CommentController::class, 'store']);
Route::delete('/comments/{id}', [CommentController::class, 'destroy']);



Route::get('/user/{id}', [UserController::class, 'show']);