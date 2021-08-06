<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courseModel;

class coursesController extends Controller
{
    function coursePage(){
        $coursesData= json_decode(courseModel::orderBy('id','desc')->get());

        return view('course',['coursesData'=>$coursesData]);
    }
}
