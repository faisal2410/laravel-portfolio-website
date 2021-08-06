<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\adminModel;

class loginController extends Controller
{
    function loginIndex() {
        return view('login');
    }

    function onLogout(Request $request){
    $request->session()->flush();
    return redirect('/login');
    }

    function onLogin(Request $request){
      $user= $request->input('user');
       $pass= $request->input('pass');
     $countValue= adminModel::where([['userName','=',$user],['password','=',$pass]])->count();
        
        if($countValue==1){
            $request->session()->put('user',$user);
            return 1;
        }else{
            return 0;
        }

    }
}
