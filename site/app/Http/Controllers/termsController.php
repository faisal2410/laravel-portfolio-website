<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class termsController extends Controller
{
    function termsPage(){
        return view('terms');
    }
}
