<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\projectsModel;

class projectsController extends Controller
{
    function projectsPage(){
        $projectsData=json_decode(projectsModel::orderBy('id','desc')->get()); 
        return view('projects',['projectsData'=>$projectsData]);
    }
}
