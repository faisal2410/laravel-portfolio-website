<?php

use App\Http\Controllers\homeController;
use App\Http\Controllers\coursesController;
use App\Http\Controllers\projectsController;
use App\Http\Controllers\policyController;
use App\Http\Controllers\termsController;
use App\Http\Controllers\contactController;

use Illuminate\Support\Facades\Route;



Route::get('/',[homeController::class,'homeIndex'] );
Route::post('/contactSend',[homeController::class,'contactSend']);
Route::get('/courses',[coursesController::class,'coursePage']);
Route::get('/projects',[projectsController::class,'projectsPage']);
Route::get('/policy',[policyController::class,'policyPage']);
Route::get('/terms',[termsController::class,'termsPage']);
Route::get(('/contact'),[contactController::class,'contactPage']);