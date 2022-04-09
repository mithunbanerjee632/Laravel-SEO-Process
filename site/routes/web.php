<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ContactController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class,'HomeIndex']);
Route::post('/contactsend', [HomeController::class,'ContactSend']);

Route::get('/course', [CourseController::class,'CoursePage']);
Route::get('/projects', [ProjectsController::class,'ProjectsPage']);
Route::get('/privacy', [PrivacyController::class,'PrivacyPage']);
Route::get('/terms', [TermsController::class,'TermsPage']);
Route::get('/contact', [ContactController::class,'ContactPage']);
