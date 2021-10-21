<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
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

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::get('/me', [UserController::class, 'getUser']);

Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile', [ProfileController::class, 'create']);


Route::get('/class', [ClassController::class, 'index']);
Route::post('/class', [ClassController::class, 'create']);
Route::get('/class/{id}', [ClassController::class, 'getById']);
Route::put('/class/{id}', [ClassController::class, 'update']);
Route::delete('/class/{id}', [ClassController::class, 'delete']);
Route::get('/class/{name}', [ClassController::class, 'search']);
Route::get('/class/getStaff/{id}', [ClassController::class, 'getClassAndStaffById']);


Route::get('/staff', [StaffController::class, 'index']);
Route::post('/staff', [StaffController::class, 'create']);
Route::get('/staff/{id}', [StaffController::class, 'getById']);
Route::post('/staff/assignClass/{id}', [StaffController::class, 'assignTeacherToClass']);
Route::put('/staff/{id}', [StaffController::class, 'update']);
Route::delete('/staff/{id}', [StaffController::class, 'delete']);
Route::get('/staff/{name}', [StaffController::class, 'search']);
Route::get('/staff/getClass/{id}', [StaffController::class, 'getStaffAndClassById']);
Route::put('/staff/updateClass/{id}', [StaffController::class, 'updateClassAssignToStaff']);
Route::delete('/staff/deleteClass/{id}', [StaffController::class, 'deleteClassAssignToStaff']);


Route::get('/parent', [ParentController::class, 'index']);
Route::post('/parent', [ParentController::class, 'create']);
Route::get('/parent/{id}', [ParentController::class, 'getById']);
Route::put('/parent/{id}', [ParentController::class, 'update']);
Route::delete('/parent/{id}', [ParentController::class, 'delete']);

Route::get('/student', [StudentController::class, 'index']);
Route::post('/student', [StudentController::class, 'create']);
Route::get('/student/{id}', [StudentController::class, 'getById']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'delete']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
