<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;

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
        $listBlogs = Blog::orderBy('created_at', 'desc')
        ->take(3)
        ->get();

        return view('frontend.index', compact('categories', 'listBlogs'));
    }

    public function reservation()
    {
        return view('frontend.reservation');
    }

    public function menu()
    {
        $bestSeller = Menu::getBestSellers(1)->first();
        $categories = Category::with('menus')->get();

        return view('frontend.menu', compact('categories', 'bestSeller'));

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
