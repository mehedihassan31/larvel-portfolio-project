<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TermsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[HomeController::class,'HomeIndex']);

Route::get('/course',[CourseController::class,'courseIndex']);
Route::get('/projects',[ProjectController::class,'projectIndex']);
Route::get('/terms-condition',[TermsController::class,'termsIndex']);
Route::get('/policy',[PolicyController::class,'policyIndex']);
Route::post('/Contactsend',[HomeController::class,'contactSend']);
