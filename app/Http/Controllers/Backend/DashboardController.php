<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Table;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $countUser = User::count();
        $countFood = Menu::count();
        $countCategory = Category::count();
        $countTable = Table::count();
        $countBlog = Blog::count();

        // Tổng doanh thu
        $totalMonth = Invoice::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('total_amount');
        $totalYear = Invoice::whereYear('created_at', Carbon::now()->year)->sum('total_amount');
        $totalToday = Invoice::whereDate('created_at', Carbon::today())->sum('total_amount');

        // Các khoảng thời gian trong ngày
        $timeRanges = [
            'Ca sáng (7h - 11h)' => ['start' => '07:00:00', 'end' => '10:59:59'],
            'Ca chiều (11h - 17h)' => ['start' => '11:00:00', 'end' => '16:59:59'],
            'Ca tối (17h - 22h)' => ['start' => '17:00:00', 'end' => '22:00:00'],
        ];

        // Lấy ca làm việc từ request
        $selectedShift = $request->get('ca', 'all'); // Default là 'all'

        $dataChart = [];
        if ($selectedShift === 'all') {
            // Thống kê cả ngày
            foreach ($timeRanges as $period => $range) {
                $startTime = Carbon::today()->toDateString() . ' ' . $range['start'];
                $endTime = Carbon::today()->toDateString() . ' ' . $range['end'];

                $totalAmount = Reservation::join('invoices', 'invoices.reservation_id', '=', 'reservations.id')
                    ->whereBetween('reservation_time', [$startTime, $endTime])
                    ->where('reservations.status', 'completed')
                    ->sum('invoices.total_amount');
                $orderCount = Reservation::join('invoices', 'invoices.reservation_id', '=', 'reservations.id')
                    ->whereBetween('reservation_time', [$startTime, $endTime])
                    ->where('reservations.status', 'completed')
                    ->count();

                $dataChart[] = [
                    'period' => ucfirst($period), // Capital hóa tên khoảng thời gian
                    'order' => $orderCount,
                    'total' => $totalAmount,
                ];
            }
        } else {
            // Thống kê theo ca làm việc
            if (isset($timeRanges[$selectedShift])) {
                $startTime = Carbon::today()->toDateString() . ' ' . $timeRanges[$selectedShift]['start'];
                $endTime = Carbon::today()->toDateString() . ' ' . $timeRanges[$selectedShift]['end'];

                $totalAmount = Reservation::join('invoices', 'invoices.reservation_id', '=', 'reservations.id')
                    ->whereBetween('reservation_time', [$startTime, $endTime])
                    ->where('invoices.status', 'paid')
                    ->where('reservations.status', 'completed')
                    ->sum('invoices.total_amount');
            
                $orderCount = Reservation::join('invoices', 'invoices.reservation_id', '=', 'reservations.id')
                    ->whereBetween('reservation_time', [$startTime, $endTime])
                    ->where('invoices.status', 'paid')
                    ->where('reservations.status', 'completed')
                    ->count();

                $dataChart[] = [
                    'period' => ucfirst($selectedShift),
                    'order' => $orderCount,
                    'total' => $totalAmount,
                ];
            }
        }

        // Chuẩn bị dữ liệu cho view
        $data["countUser"] = $countUser;
        $data["countFood"] = $countFood;
        $data["countCategory"] = $countCategory;
        $data["countBlog"] = $countBlog;
        $data["countTable"] = $countTable;
        $data["totalMonth"] = $totalMonth;
        $data["totalYear"] = $totalYear;
        $data["totalToday"] = $totalToday;
        $data["dataChart"] = $dataChart;

        return view('backend.dashboard.index', compact('data'));
    }
}
