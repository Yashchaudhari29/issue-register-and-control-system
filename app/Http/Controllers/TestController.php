<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use App\Models\Sensor;
use Auth;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class TestController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {        
      return view('test.index');
    }
}
