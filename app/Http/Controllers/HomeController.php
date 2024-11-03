<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
        $categories = Category::with('menus')->get();


        return view('frontend.index', compact('categories'));
    }

    public function reservation()
    {
        return view('frontend.reservation');
    }

    public function menu()
    {
        $categories = Category::with('menus')->get();

        return view('frontend.menu', compact('categories'));

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
