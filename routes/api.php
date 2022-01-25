<?php

use App\Http\Controllers\ChaptersController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\MentorsController;
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

// Route definition
// Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/mentors', [MentorsController::class, 'index']);
Route::get('/mentors/{id}', [MentorsController::class, 'show']);
Route::post('/mentors', [MentorsController::class, 'create']);
Route::put('/mentors/{id}', [MentorsController::class, 'update']);
Route::delete('/mentors/{id}', [MentorsController::class, 'destroy']);

Route::post('/courses', [CoursesController::class, 'create']);
Route::put('/courses/{id}', [CoursesController::class, 'update']);
Route::get('/courses', [CoursesController::class, 'index']);
Route::delete('/courses/{id}', [CoursesController::class, 'destroy']);

Route::post('/chapters', [ChaptersController::class, 'create']);
Route::put('/chapters/{id}', [ChaptersController::class, 'update']);
Route::get('/chapters', [ChaptersController::class, 'index']);
Route::get('/chapters/{id}', [ChaptersController::class, 'show']);
Route::delete('/chapters/{id}', [ChaptersController::class, 'destroy']);