<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\servicesModel;

class serviceController extends Controller
{
    function serviceIndex(){  
          
      return view('services');
           }

    function getServiceData() {
      $result =json_encode(servicesModel::orderBy('id','desc')->get());
      return $result;
    }

    function getServiceDetails(Request $req) {
     $id= $req->input('id');
    $result= json_encode(servicesModel::where('id',$id)->get()) ;
    return $result;

    }
    function serviceDelete(Request $req) {
       $id= $req->input('id');
      $result= servicesModel::where('id',$id)->delete();
      if($result==true){
        return 1;
      } else{
        return 0;
      }
     
     
    }

    function serviceUpdate(Request $req) {
      $id= $req->input('id');
      $name= $req->input('name');
      $des= $req->input('des');
      $img= $req->input('img');
     $result= servicesModel::where('id',$id)->update([
       'serviceName'=>$name,
       'serviceDes'=>$des,
       'serviceImg'=>$img
     ]);
     if($result==true){
       return 1;
     } else{
       return 0;
     }
    
    
   }


   function serviceAdd(Request $req) {
   
    $name= $req->input('name');
    $des= $req->input('des');
    $img= $req->input('img');
   $result= servicesModel::insert([
     'serviceName'=>$name,
     'serviceDes'=>$des,
     'serviceImg'=>$img
   ]);
   if($result==true){
     return 1;
   } else{
     return 0;
   }
  
  
 }
}
