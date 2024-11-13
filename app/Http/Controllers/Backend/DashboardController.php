<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $countUser =  User::count();
        $countFood =  Menu::count();
        $data["countUser"] = $countUser;
        $data["countFood"] = $countFood;
        return view('backend.dashboard.index'); 
    }
}
