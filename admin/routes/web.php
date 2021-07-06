<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\Reviewcontroller;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServicesController;
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




Route::get('/login',[LoginController::class,'loginIndex']);
Route::post('/onlogin',[LoginController::class,'onLogin']);
Route::get('/logout',[LoginController::class,'onlogout']);





Route::get('/',[HomeController::class,'HomeIndex'])->middleware('loginCheck');
Route::get('/visitor',[VisitorController::class,'VisitorIndex'])->middleware('loginCheck');

//service admin

Route::get('/services',[ServicesController::class,'ServicesIndex'])->middleware('loginCheck');
Route::get('/getServicesData',[ServicesController::class,'getServicesData'])->middleware('loginCheck');
Route::post('/ServicesDelete',[ServicesController::class,'ServiceDelete'])->middleware('loginCheck');
Route::post('/ServicesDetails',[ServicesController::class,'getdetails'])->middleware('loginCheck');
Route::post('/ServicesUpdate',[ServicesController::class,'serviceUpdate'])->middleware('loginCheck');
Route::post('/ServicesAdd',[ServicesController::class,'serviceAdd'])->middleware('loginCheck');



//Adminpanel courses management

Route::get('/courses',[coursesController::class,'CoursesIndex'])->middleware('loginCheck');

Route::get('/getCoursesData',[coursesController::class,'getCoursesData'])->middleware('loginCheck');
Route::post('/CourseDelete',[coursesController::class,'CourseDelete'])->middleware('loginCheck');
Route::post('/CourseDetails',[coursesController::class,'getCoursedetails'])->middleware('loginCheck');
Route::post('/CourseUpdate',[coursesController::class,'CourseUpdate'])->middleware('loginCheck');
Route::post('/CourseAdd',[coursesController::class,'CourseAdd'])->middleware('loginCheck');



// Adminpanel Project
Route::get('/projects',[ProjectsController::class,'ProjectsIndex'])->middleware('loginCheck')->middleware('loginCheck');
Route::get('/getprojectsdata',[ProjectsController::class,'getProjectsData'])->middleware('loginCheck')->middleware('loginCheck');
Route::post('/projectdelete',[ProjectsController::class,'ProjectDelete'])->middleware('loginCheck')->middleware('loginCheck');

Route::post('/ProjectUpdate',[ProjectsController::class,'ProjectUpdate'])->middleware('loginCheck')->middleware('loginCheck');
Route::post('/projectAdd',[ProjectsController::class,'ProjectAdd'])->middleware('loginCheck')->middleware('loginCheck');

Route::post('/ProjectDetails',[ProjectsController::class,'getProjectdetails'])->middleware('loginCheck')->middleware('loginCheck');


// Contact
Route::get('/contact',[ContactController::class,'ContactIndex'])->middleware('loginCheck');
Route::get('/getcontactdata',[ContactController::class,'getContactData'])->middleware('loginCheck');
Route::post('/contactdelete',[ContactController::class,'ContactDelete'])->middleware('loginCheck');


// review
Route::get('/reviews',[Reviewcontroller::class,'reviewsIndex'])->middleware('loginCheck');
Route::get('/getreviewsdata',[Reviewcontroller::class,'getreviewsData'])->middleware('loginCheck');
Route::post('/reviewdelete',[Reviewcontroller::class,'reviewDelete'])->middleware('loginCheck');

Route::post('/ReviewUpdate',[Reviewcontroller::class,'reviewUpdate'])->middleware('loginCheck');
Route::post('/reviewAdd',[Reviewcontroller::class,'reviewAdd'])->middleware('loginCheck');
Route::post('/ReviewDetails',[Reviewcontroller::class,'getreviewdetails'])->middleware('loginCheck');




Route::get('/photos',[PhotoController::class,'photoIndex'])->middleware('loginCheck');

Route::post('/photoupload',[PhotoController::class,'PhotoUpload'])->middleware('loginCheck');
Route::get('/photoall',[PhotoController::class,'photoJson'])->middleware('loginCheck');
Route::get('/photojsonbyid/{id}',[PhotoController::class,'photoJsonById'])->middleware('loginCheck');
Route::post('/photodelete',[PhotoController::class,'photoDelete'])->middleware('loginCheck');






