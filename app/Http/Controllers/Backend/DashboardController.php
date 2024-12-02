<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Menu;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request){
        $countUser =  User::count();
        $countFood =  Menu::count();
        $countCategory =  Category::count();
        $countTable =  Table::count();
        $countBlog =  Blog::count();
        $totalMonth = Invoice::whereYear('created_at', Carbon::now()->year)
        ->whereMonth('created_at', Carbon::now()->month)->sum('total_amount');
        $totalYear = Invoice::whereYear('created_at', Carbon::now()->year)->sum('total_amount');
        $totalToday = Invoice::whereDate('created_at', Carbon::today())->sum('total_amount');
        $month = $request->get('month')??"";
        $year = $request->get('year')?? Carbon::now()->year;
        if (!$month && !$year) {
            $year = Carbon::now()->year;
        }
        $dataChart = [];
        if($month && $year){
            for ($day = 1; $day <= Carbon::create($year, $month)->daysInMonth; $day++) {
                $date = Carbon::create($year, $month, $day);
                $dailyTotal = Invoice::whereDate('created_at', $date)->where('status', 'paid')->sum('total_amount');
                $dailyOrder = Invoice::whereDate('created_at', $date)->where('status', 'paid')->count();
                $dataChart[] = [
                    "order" => $dailyOrder,
                    'total' => $dailyTotal,
                    'date' => $date->format('d/m/Y')
                ];
            }
        }elseif(!$month && $year)
        for ($month = 1; $month <= 12; $month++) {
            $monthlyTotal = Invoice::whereYear('created_at', $year)
                                   ->whereMonth('created_at', $month)
                                   ->where('status', 'paid')
                                   ->sum('total_amount');
            $monthlyOrder = Invoice::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->where('status', 'paid')
            ->count(); 
            $dataChart[] = [
                "order" => $monthlyOrder,
                'total' => $monthlyTotal,
                'date' => 'Tháng ' . $month
            ];
        }
        $data["countUser"] = $countUser;
        $data["countFood"] = $countFood;
        $data["countCategory"] = $countCategory;
        $data["countBlog"] = $countBlog;
        $data["countTable"] = $countTable;
        $data["totalMonth"] = $totalMonth;
        $data["totalYear"] = $totalYear;
        $data["totalToday"] = $totalToday;
        $data["dataChart"] = $dataChart;
        return view('backend.dashboard.index' , compact('data')); 
    }
}
