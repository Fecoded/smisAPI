<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
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

// Route::resource('books', BookController::class);

Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'create']);
Route::get('/books/{id}', [BookController::class, 'getById']);
Route::put('/books/{id}', [BookController::class, 'update']);
Route::delete('/books/{id}', [BookController::class, 'delete']);
Route::get('/books/{name}', [BookController::class, 'search']);

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/me', [UserController::class, 'getUser']);

Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile', [ProfileController::class, 'create']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
