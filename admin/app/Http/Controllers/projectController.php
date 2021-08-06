<?php

namespace App\Http\Controllers;
use App\Models\projectsModel;

use Illuminate\Http\Request;

class projectController extends Controller
{
    function projectIndex(){
        return view('project');	
     }
     function getProjectData(){
        $result=json_encode(projectsModel::orderBy('id','desc')->get());
        return $result;
     }
     function getProjectDetails(Request $req){
        $id= $req->input('id');
        $result=json_encode(projectsModel::where('id',$id)->get());
        return $result;
      }
      function projectDelete(Request $req){
        $id= $req->input('id');
        $result= projectsModel::where('id',$id)->delete();
   
        if($result==true){      
          return 1;
        }
        else{
            return 0;
        }
   }


function projectUpdate(Request $req){
    $id= $req->input('id');
    $projectName= $req->input('projectName');
    $projectDesc= $req->input('projectDesc');
    $projectLink= $req->input('projectLink');
    $projectImg = $req->input('projectImg');

    $result= projectsModel::where('id',$id)->update([
        'projectName'=>$projectName,
        'projectDesc'=>$projectDesc,
        'projectLink'=>$projectLink,
        'projectImg'=>$projectImg	
    ]);

    if($result==true){      
      return 1;
    }
    else{
     return 0;
    }
}

function projectAdd(Request $req){    
    $projectName= $req->input('name');
    $projectDesc= $req->input('des');
    $projectLink= $req->input('link');
    $projectImg = $req->input('img');
    $result= projectsModel::insert([
        'projectName'=>$projectName,
        'projectDesc'=>$projectDesc,
        'projectLink'=>$projectLink,
        'projectImg'=>$projectImg
    ]);

    if($result==true){      
      return 1;
    }
    else{
     return 0;
    }
}
}

      




