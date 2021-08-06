<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\visitorModel;

class visitorController extends Controller
{
    function visitorIndex(){

 $visitorData=json_decode(visitorModel::orderBy('id','desc')->take(30)->get()) ;



        return view('visitor',['visitorData'=>$visitorData]);
    }
}
