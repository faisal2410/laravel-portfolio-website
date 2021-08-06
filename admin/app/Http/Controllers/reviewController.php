<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reviewModel;

class reviewController extends Controller
{
    function reviewIndex(){
        return view('review');	
}
function getReviewData(){
	$result=json_encode(reviewModel::orderBy('id','desc')->get());
	return $result;
}



function getReviewDetails(Request $req){
    $id= $req->input('id');
    $result=json_encode(reviewModel::where('id',$id)->get());
    return $result;
  }
  function reviewDelete(Request $req){
    $id= $req->input('id');
    $result= reviewModel::where('id',$id)->delete();

    if($result==true){      
      return 1;
    }
    else{
        return 0;
    }
}  
function reviewAdd(Request $req){
    $reviewName= $req->input('reviewName');
    $reviewDesc= $req->input('reviewDesc');
    $reviewImg = $req->input('reviewImg');
    $result= reviewModel::insert([
        'name'=>$reviewName,
        'des'=>$reviewDesc,
        'img'=>$reviewImg
    ]);

    if($result==true){      
      return 1;
    }
    else{
     return 0;
    }
}
function reviewUpdate(Request $req){
    $id= $req->input('id');
    $reviewName= $req->input('reviewName');
    $reviewDesc= $req->input('reviewDesc');
    $reviewImg = $req->input('reviewImg');

    $result= reviewModel::where('id',$id)->update([
        'name'=>$reviewName,
        'des'=>$reviewDesc,
       'img'=>$reviewImg	
    ]);

    if($result==true){      
      return 1;
    }
    else{
     return 0;
    }
}

}


