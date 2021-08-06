<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;
use App\Models\servicesModel;
use App\Models\courseModel;
use App\Models\projectsModel;
use App\Models\contactModel;
use App\Models\reviewModel;

class homeController extends Controller
{
    function homeIndex(){
        $userIP=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate= date("Y-m-d h:i:sa");
        visitorModel::insert(['ipAddress'=>$userIP,'visitTime'=>$timeDate]);
        $servicesData= json_decode(servicesModel::all());
        $coursesData= json_decode(courseModel::orderBy('id','desc')->limit(6)->get());
        $projectsData=json_decode(projectsModel::orderBy('id','desc')->limit(10)->get()); 
        $reviewData= json_decode( reviewModel::all());

        return view('home',[
            'servicesData'=>$servicesData, 
            'coursesData'=>$coursesData,
            'projectsData'=>$projectsData,
            'reviewData'=>$reviewData

        ]);
    }

    function contactSend(Request $request){
        $contactName=$request->input('contactName');
        $contactMobile= $request->input('contactMobile');
       $contactEmail=  $request->input('contactEmail');
       $contactMsg=  $request->input('contactMsg');
       $result= contactModel::insert([
            'contactName'=>$contactName,
            'contactMobile'=>$contactMobile,
            'contactEmail' =>$contactEmail,
            'contactMsg' =>$contactMsg
        ]);
        if($result==true){
            return 1;
        }else{
            return 0;
        }

    }
}
