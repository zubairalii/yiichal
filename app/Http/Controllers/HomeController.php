<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\sendCounter;
use App\Events\sendSpecific;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function index2()
    {
        
        return view('home2');
    }

    public function sendC() {
        $rand_number = rand(0, 1000);
        broadcast(new sendCounter($rand_number ))->toOthers();

    }

    public function sendS($id)
    {
        broadcast(new sendSpecific($id))->toOthers();
    }
}
