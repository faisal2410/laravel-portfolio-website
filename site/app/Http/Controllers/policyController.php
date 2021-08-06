<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class policyController extends Controller
{
    function policyPage(){
        return view('policy');
    }
}
