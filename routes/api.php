<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffNextOfKinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group whiparent
parent
parent
parent
parentch
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
Route::get('/class/{id}', [ClassController::class, 'getClassBySchoolName']);
Route::put('/class/{id}', [ClassController::class, 'update']);
Route::delete('/class/{id}', [ClassController::class, 'delete']);
Route::get('/class/{name}', [ClassController::class, 'search']);
Route::get('/class/getStaff/{id}', [ClassController::class, 'getClassAndStaffById']);


Route::get('/staff', [StaffController::class, 'index']);
Route::get('/staff/{id}', [StaffController::class, 'getStaffBySchoolName']);
Route::post('/staff', [StaffController::class, 'create']);
Route::post('/staff/assignClass/{id}', [StaffController::class, 'assignTeacherToClass']);
Route::put('/staff/{id}', [StaffController::class, 'update']);
Route::delete('/staff/{id}', [StaffController::class, 'delete']);
Route::get('/staff/search/{name}', [StaffController::class, 'search']);
Route::get('/staff/getClass/{id}', [StaffController::class, 'getStaffAndClassById']);
Route::put('/staff/updateClass/{id}', [StaffController::class, 'updateClassAssignToStaff']);
Route::delete('/staff/deleteClass/{id}', [StaffController::class, 'deleteClassAssignToStaff']);\


Route::get('/staffNextOfKin', [StaffNextOfKinController::class, 'index']);
Route::post('/staffNextOfKin', [StaffNextOfKinController::class, 'create']);
Route::get('/staffNextOfKin/{id}', [StaffNextOfKinController::class, 'getById']);
Route::put('/staffNextOfKin/{id}', [StaffNextOfKinController::class, 'update']);
Route::delete('/staffNextOfKin/{id}', [StaffNextOfKinController::class, 'delete']);


Route::get('/parent', [ParentController::class, 'index']);
Route::post('/parent', [ParentController::class, 'create']);
Route::get('/parent/{id}', [ParentController::class, 'getParentsBySchoolName']);
Route::put('/parent/{id}', [ParentController::class, 'update']);
Route::delete('/parent/{id}', [ParentController::class, 'delete']);


Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment', [PaymentController::class, 'create']);
Route::get('/payment/{id}', [PaymentController::class, 'getPaymentsBySchoolName']);
Route::put('/payment/{id}', [PaymentController::class, 'update']);
Route::delete('/payment/{id}', [PaymentController::class, 'delete']);

Route::get('/paymentType', [PaymentTypeController::class, 'index']);
Route::post('/paymentType', [PaymentTypeController::class, 'create']);
Route::get('/paymentTypeBySchoolName', [PaymentTypeController::class, 'getPaymentTypeBySchoolName']);
Route::put('/paymentType/{id}', [PaymentTypeController::class, 'update']);
Route::delete('/paymentType/{id}', [PaymentTypeController::class, 'delete']);

Route::get('/session', [SessionController::class, 'index']);
Route::post('/session', [SessionController::class, 'create']);
Route::get('/session/{id}', [SessionController::class, 'getSessionBySchoolName']);
Route::put('/session/{id}', [SessionController::class, 'update']);
Route::delete('/session/{id}', [SessionController::class, 'delete']);

Route::get('/student', [StudentController::class, 'index']);
Route::post('/student', [StudentController::class, 'create']);
Route::get('/student/{id}', [StudentController::class, 'getStudentsBySchoolName']);
Route::put('/student/{id}', [StudentController::class, 'update']);
Route::delete('/student/{id}', [StudentController::class, 'delete']);
Route::post('/student/{id}', [StudentController::class, 'promote']);


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
