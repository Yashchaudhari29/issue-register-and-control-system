<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
   
    public function login()
    {        
      
        return view('auth.login');
    }
    

    public function do_login(Request $request){
      dd($request);
        /*
        $user = User::find(1);
        $user -> password = bcrypt('admin');
        $user -> save();
        */
       
        $request->validate([
        'username' => 'required',
        'password' => 'required',
      ],[
        'username.required' => 'This Username is required',
        'password.required' => 'This Field required',
      ]);


       /* if (Auth::guard('web')->attempt($userdata,$remember_me)) {
          return redirect()->route('category');
      }else{
        return redirect()->route('adminlogin')->withErrors(['login' => 'Login Details are Invalid']);

      }*/
      
      
      $credentials = $request->only('username', 'password');
 
        if (Auth::attempt($credentials)) {
          
            // if($request->username==1){
            //     $this->upload_csv();
            // }
            // else{
            //     return redirect()->intended('home');    
            // }
            dd("New");
            if(Auth::user()->hasrole('ssctf')){
              
              return view('ssctf.ssctf');
              dd("login successfull for ssctf");
                // return redirect()->intended('user-manage');
            }
            // elseif(Auth::user()->hasrole('user')){
            //     return redirect()->intended('user-dashboard');
            // }else{
            //     return redirect()->route('login');
            // }
            
        }else{
            return redirect()->route('login');
            // ->withErrors(['login' => 'Login Details are Invalid']);
        }

    }


    
}
