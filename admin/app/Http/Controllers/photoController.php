<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\photoModel;
use Illuminate\Support\Facades\Storage;

class photoController extends Controller
{
    function photoIndex(){
        return view('photo');
    }

    function photoUpload(Request $request){
     $photoPath= $request->file('photo')->store('public');
     $photoName=(explode('/',$photoPath))[1];

     $host= $_SERVER['HTTP_HOST'];

     $location="http://".$host."/storage/".$photoName;

     $result=photoModel::insert(['location'=>$location]);
     return $result;
    
    }

    function photoJSON(){
     return photoModel::take(3)->get();
     
    }

    function photoJSONById(Request $request){
        $firstId=$request->id;
        $lastId=$firstId+3;
        return photoModel::where('id','>',$firstId)->where('id','<=',$lastId)->get();
    }

    function photoDelete(Request $request){

        $oldPhotoURL=$request->input('oldPhotoURL');
        $oldPhotoId=$request->input('id');
        $oldPhotoURLArray= explode("/", $oldPhotoURL);
      $oldPhotoName=end($oldPhotoURLArray);
      $deletePhotoFile= Storage::delete('public/'.$oldPhotoName);

      $deleteRow= PhotoModel::where('id','=',$oldPhotoId)->delete();
      return  $deleteRow;
  
    }
}
