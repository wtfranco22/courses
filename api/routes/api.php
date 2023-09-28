<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile', [AuthController::class, 'user']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/update',[AuthController::class,'updateProfile']);

    Route::resource('/files', FileController::class);
    Route::resource('/modules', ModuleController::class);

    Route::post('/inscription',[UserController::class,'inscription']);
    Route::get('/my-courses',[UserController::class,'myCourses']);
    Route::get('/my-courses/{id}',[UserController::class,'courseShow']);
    Route::get('/my-modules/{id}',[UserController::class,'moduleShow']);

    Route::post('/update-user/{id}',[UserController::class,'update']);
});

Route::resource('/courses', CourseController::class);
Route::get('/sales',[CourseController::class,'sales']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
