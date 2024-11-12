<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Table;
use App\Models\Blog;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Initialize empty results
        $results = [
            'reservations'  => [],
            'users'         => [],
            'menus'          => [],
            'categories'      => [],
            'tables'         => [],
            'blogs'          => [],
        ];

        if ($searchTerm) {
            // Search across different models
            $results['reservations'] = Reservation::where('name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%")
                ->orWhere('phone', 'like', "%$searchTerm%")
                ->get();

            $results['users'] = User::where('status', '!=', 'locked')
                ->where('full_name', 'like', "%$searchTerm%")
                ->orWhere('email', 'like', "%$searchTerm%")
                ->orWhere('phone', 'like', "%$searchTerm%")
                ->get();

            $results['menus'] = Menu::where("name", 'like', "%$searchTerm%")
                ->orWhere("description", 'like', "%$searchTerm%")
                ->orWhere('price', 'like', "%$searchTerm%")
                ->get();

            $results['categories'] = Category::where("name", 'like', "%$searchTerm%")
                ->get();

            $results['tables'] = Table::where("name", 'like', "%$searchTerm%")
                ->orWhere("description", 'like', "%$searchTerm%")
                ->get();

            $results['blogs'] = Blog::where("title", 'like', "%$searchTerm%")
                ->orWhere("content", 'like', "%$searchTerm%")
                ->get();
        }

        return view('backend.search.results', compact('results', 'searchTerm'));
    }
}
