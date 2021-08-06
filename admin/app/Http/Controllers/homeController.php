<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courseModel;
use App\Models\projectsModel;
use App\Models\servicesModel;
use App\Models\reviewModel;
use App\Models\visitorModel;
use App\Models\contactModel;

class homeController extends Controller
{
    function homeIndex(){
      $totalCourse=  courseModel::count();
      $totalProject=  projectsModel::count();
       $totalService= servicesModel::count();
      $totalReview=  reviewModel::count();
     $totalVisitor=   visitorModel::count();
      $totalContact=  contactModel::count();
        return view('home',[
            'totalCourse'=>$totalCourse,
            'totalProject'=>$totalProject,
            'totalService' =>$totalService,
            'totalReview'=>$totalReview,
            'totalVisitor'=>$totalVisitor,
            'totalContact'=>$totalContact        
        ]);
    }
}
