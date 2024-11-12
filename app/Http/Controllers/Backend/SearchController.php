<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Table;
use App\Models\Blog;
use App\Models\Promotion;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Initialize empty results
        $results = [
            'reservation'  => [],
            'user'         => [],
            'menu'          => [],
            'category'      => [],
            'table'         => [],
            'blog'          => [],
            'promotion'     => [],
        ];

        if ($searchTerm) {
            // Search across different models
            $results['reservation'] = Reservation::where('name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%")
                ->orWhere('phone', 'like', "%$searchTerm%")
                ->get();

            $results['user'] = User::where('status', '!=', 'locked')
                ->where('full_name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%")
                ->orWhere('phone', 'like', "%$searchTerm%")
                ->get();

            $results['menu'] = Menu::where("name", 'like', "%$searchTerm%")
                ->orWhere("description", 'like', "%$searchTerm%")
                ->orWhere('price', 'like', "%$searchTerm%")
                ->get();

            $results['category'] = Category::where("name", 'like', "%$searchTerm%")
                ->get();

            $results['table'] = Table::where("name", 'like', "%$searchTerm%")
                ->orWhere("description", 'like', "%$searchTerm%")
                ->get();

            $results['blog'] = Blog::where("title", 'like', "%$searchTerm%")
                ->orWhere("content", 'like', "%$searchTerm%")
                ->get();

            $results['promotion'] = Promotion::where("title", 'like', "%$searchTerm%")
                ->orWhere("description", 'like', "%$searchTerm%")
                ->orWhere("code", 'like', "%$searchTerm%")
                ->get();
        }

        return view('backend.search.results', compact('results', 'searchTerm'));
    }
}
