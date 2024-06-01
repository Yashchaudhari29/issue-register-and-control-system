<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class dashController extends Controller
{
    public function dash()
{
    $user = Auth::user(); 

    if ($user) {

        switch ($user->role) {
            case 'om':
                return redirect()->route('om.page'); 
            case 'im':
                return redirect()->route('im.page'); 
            case 'si':
                return redirect()->route('si.dashboard'); 
            default:
                return redirect()->route('login.index'); 
        }
    }

    return redirect()->route('login.index');
}

public function dashlist()
{
    $user = Auth::user(); 

    if ($user) {

        switch ($user->role) {
            case 'om':
                return redirect()->route('om.list');  
            case 'im':
                return redirect()->route('im.list'); 
            case 'si':
                return redirect()->route('si.issue.list');  //remaining to change
            default:
                return redirect()->route('login.index'); 
        }
    }

    return redirect()->route('login.index');
}



public function dashform()
{
    $user = Auth::user(); 

    if ($user) {

        switch ($user->role) {
            case 'om':
                return redirect()->route('om.list.form');  
            case 'im':
                return redirect()->route('im.list.form'); 
            case 'si':
                return redirect()->route('si.dashboard');  //remaining to change
            default:
                return redirect()->route('login.index'); 
        }
    }

    return redirect()->route('login.index');
}

public function dashContactList()
{
    return view('contact_list');
}
}