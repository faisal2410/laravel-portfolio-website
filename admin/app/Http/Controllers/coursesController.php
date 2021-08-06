<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courseModel;

class coursesController extends Controller
{
    function coursesIndex(){
        return view('courses');
    }
   
  
      function getCoursesData() {
        $result =json_encode(courseModel::orderBy('id','desc')->get());
        return $result;
      }
  
      function getCoursesDetails(Request $req) {
       $id= $req->input('id');
      $result= json_encode(courseModel::where('id',$id)->get()) ;
      return $result;
  
      }
      function courseDelete(Request $req) {
         $id= $req->input('id');
        $result= courseModel::where('id',$id)->delete();
        if($result==true){
          return 1;
        } else{
          return 0;
        }
       
       
      }
  
      function courseUpdate(Request $req) {
        $id= $req->input('id');
        $courseName= $req->input('courseName');
        $courseDes= $req->input('courseDes');
        $courseFee= $req->input('courseFee');
        $courseTotalEnroll= $req->input('courseTotalEnroll');
        $courseTotalClass= $req->input('courseTotalClass');       
        $courseLink= $req->input('courseLink');
        $courseImg= $req->input('courseImg');
       

       $result= courseModel::where('id',$id)->update([
         'courseName'=>$courseName,
         'courseDes'=>$courseDes,
         'courseFee'=>$courseFee,
         'courseTotalEnroll'=>$courseTotalEnroll,
         'courseTotalClass'=>$courseTotalClass,
         'courseLink'=>$courseLink,
         'courseImg'=>$courseImg
       ]);
       if($result==true){
         return 1;
       } else{
         return 0;
       }
      
      
     }
  
  
     function courseAdd(Request $req) {
     
        $courseName= $req->input('courseName');
        $courseDes= $req->input('courseDes');
        $courseFee= $req->input('courseFee');
        $courseTotalEnroll= $req->input('courseTotalEnroll');
        $courseTotalClass= $req->input('courseTotalClass');       
        $courseLink= $req->input('courseLink');
        $courseImg= $req->input('courseImg');
        $result= courseModel::insert([
        'courseName'=>$courseName,
        'courseDes'=>$courseDes,
        'courseFee'=>$courseFee,
        'courseTotalEnroll'=>$courseTotalEnroll,
        'courseTotalClass'=>$courseTotalClass,
        'courseLink'=>$courseLink,
        'courseImg'=>$courseImg
     ]);
     if($result==true){
       return 1;
     } else{
       return 0;
     }
    
    
   }
}
