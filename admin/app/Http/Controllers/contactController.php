<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\contactModel;

class contactController extends Controller
{
    function contactIndex(){
        return view('contact');	
        }
    function getContactData(){
            $result=json_encode(contactModel::orderBy('id','desc')->get());
            return $result;
        }
     function contactDelete(Request $req){
            $id= $req->input('id');
            $result=contactModel::where('id',$id)->delete();
            if($result==true){      
              return 1;
            }
            else{
                return 0;
            }
       }    
}
