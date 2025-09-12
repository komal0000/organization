<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request){
        if(Auth::check()){
            redirect()->route('admin.index');
        }
        if(isGet()){
            $email=mt_rand(1111,9999);
            $password=mt_rand(1111,9999);
            session(['email'=>$email,'password'=>$password]);
            return view('login',compact('email','password'));
        }else{
            $email=session('email');
            $password=session('password');

            $email_input=$request->input($email);
            $password_input=$request->input($password);
            if(Auth::attempt(['email'=>$email_input,'password'=>$password_input])){
                return redirect()->route('admin.index')->with('message','Login Successful');
            }else{
                return redirect()->back()->with('error','Credential mismatch, Please try again');
            }


        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
