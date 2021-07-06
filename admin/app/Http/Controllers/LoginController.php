<?php

namespace App\Http\Controllers;

use App\Models\AdminModel;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    function loginIndex(){

        return view('login');
    }

    function onLogin(Request $request){

        $user=$request->input('user');
        $password=$request->input('password');
        $countvalue=AdminModel::where('username','=',$user)->where('password','=',$password)->count();

        if($countvalue==1){
            $request->session()->put('user',$user);
            return 1;

        }else{
            return 0;
        }

    }

    function onlogout(Request $request){
        $request->session()->flush();
        return redirect('/login');

    }
}
