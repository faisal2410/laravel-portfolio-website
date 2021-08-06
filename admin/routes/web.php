<?php
use App\Http\Controllers\homeController;
use App\Http\Controllers\visitorController;
use App\Http\Controllers\serviceController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\contactController;
use App\Http\Controllers\reviewController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\photoController;
use Illuminate\Support\Facades\Route;



Route::get('/',[homeController::class,'homeIndex'] )->middleware('loginCheck');
Route::get('/visitor',[visitorController::class,'visitorIndex'] )->middleware('loginCheck');


// Admin Panel Service Management
Route::get('/service',[serviceController::class,'serviceIndex'] )->middleware('loginCheck');
Route::get('/getServicesData',[serviceController::class,'getServiceData'] )->middleware('loginCheck');
Route::post('/serviceDelete',[serviceController::class,'serviceDelete'] )->middleware('loginCheck');
Route::post('/serviceDetails',[serviceController::class,'getServiceDetails'] )->middleware('loginCheck');
Route::post('/serviceUpdate',[serviceController::class,'serviceUpdate'] )->middleware('loginCheck');
Route::post('/serviceAdd',[serviceController::class,'serviceAdd'] )->middleware('loginCheck');

// Admin Panel Course Management

Route::get('/courses',[coursesController::class,'coursesIndex'] )->middleware('loginCheck');
Route::get('/getCoursesData',[coursesController::class,'getCoursesData'] )->middleware('loginCheck');
Route::post('/courseDelete',[coursesController::class,'courseDelete'] )->middleware('loginCheck');
Route::post('/courseDetails',[coursesController::class,'getCoursesDetails'] )->middleware('loginCheck');
Route::post('/courseUpdate',[coursesController::class,'courseUpdate'] )->middleware('loginCheck');
Route::post('/courseAdd',[coursesController::class,'courseAdd'] )->middleware('loginCheck');

// Admin Panel Projects management

Route::get('/projects',[projectController::class,'projectIndex'])->middleware('loginCheck');
Route::get('/getProjectData',[projectController::class,'getProjectData'])->middleware('loginCheck');
Route::post('/projectDetails',[projectController::class,'getProjectDetails'])->middleware('loginCheck');
Route::post('/projectDelete',[projectController::class,'projectDelete'])->middleware('loginCheck');
Route::post('/projectUpdate',[projectController::class,'projectUpdate'])->middleware('loginCheck');
Route::post('/projectAdd',[projectController::class,'projectAdd'])->middleware('loginCheck');

// Contact Panel management

Route::get('/contact',[contactController::class,'contactIndex'])->middleware('loginCheck');
Route::get('/getcontactData',[contactController::class,'getContactData'])->middleware('loginCheck');
Route::post('/contactDelete',[contactController::class,'contactDelete'])->middleware('loginCheck');

// Review Panel Management
Route::get('/review',[reviewController::class,'reviewIndex'])->middleware('loginCheck');
Route::get('/getReviewData',[reviewController::class,'getReviewData'])->middleware('loginCheck');
Route::post('/reviewAdd',[reviewController::class,'reviewAdd'])->middleware('loginCheck');
Route::post('/reviewDetails',[reviewController::class,'getReviewDetails'])->middleware('loginCheck');
Route::post('/reviewUpdate',[reviewController::class,'reviewUpdate'])->middleware('loginCheck');
Route::post('/reviewDelete',[reviewController::class,'reviewDelete'])->middleware('loginCheck');

// Admin Photo Gallery Management

Route::get(('/photo'),[photoController::class,'photoIndex'])->middleware('loginCheck');
Route::post(('/photoUpload'),[photoController::class,'photoUpload'])->middleware('loginCheck');
Route::get(('/photoJSON'),[photoController::class,'photoJSON'])->middleware('loginCheck');
Route::get(('/photoJSONById/{id}'),[photoController::class,'photoJSONById'])->middleware('loginCheck');
Route::post(('/photoDelete'),[photoController::class,'photoDelete'])->middleware('loginCheck');



// Admin Panel Login Management

Route::get(('/login'),[loginController::class,'loginIndex']);
Route::post(('/onLogin'),[loginController::class,'onLogin']);
Route::get(('/logout'),[loginController::class,'onLogout']);

