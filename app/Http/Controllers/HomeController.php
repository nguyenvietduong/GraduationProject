<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function reservation()
    {
        return view('frontend.reservation');
    }

    public function menu()
    {
        return view('frontend.menu');
    }

    public function team()
    {
        return view('frontend.team');
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
