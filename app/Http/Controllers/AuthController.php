<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(){
        return view('register');
    }   
    
    public function register_hendle(Request $request){
        
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed|min:4|max:8',
            'password_confirmation'=>'required',
        ]);

        // $validate = Validator::make($request->all(),[
        //     'name'=>'required|string',
        //     'email'=>'required|email',
        //     'password'=>'required|confirmed|min:4|max:8',
        //     'password_confirmation'=>'required',
        // ]);

        // if ($validate->passes()) {

        // }else {
        //     return redirect()->route('account.register')->withInput()->withErrors($validate);
        // }

            $user = new User();
            $user->name = $request->name ;
            $user->email = $request->email ;
            $user->password = Hash::make($request->password)  ;
            $user->role = 'user' ;
            $user->save();

            return redirect()->route('account.login')->with('success','You Are successfully Registerd');




    }   

    public function login(){
        return view('login');
    }

    public function login_hendle(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4|max:8',
        ]);

        if (Auth::attempt(['email'=>$request->email , 'password'=>$request->password])) {
            return redirect()->route('task.index');
        }else {
            return redirect()->route('account.login')->with('error','Either Email or Password is invalid');
        }
        
    }

    // public function welcome(){
    //     return view('welcome');
    // }
    public function logout(){
        Auth::logout();
        return view('login')->with('success','You are successfully Logout');
    }

}
