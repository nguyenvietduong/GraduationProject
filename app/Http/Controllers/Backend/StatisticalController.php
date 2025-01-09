<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\Repositories\PermissionRepositoryInterface as PermissionRepository;
use App\Interfaces\Repositories\RestaurantRepositoryInterface;
use App\Interfaces\Services\RestaurantServiceInterface;
use App\Models\Invoice;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Table;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

use App\Services\ImageService;
use Illuminate\Support\Facades\DB;

class StatisticalController extends Controller
{
    protected $restaurantService;
    protected $restaurantRepository;
    protected $permissionRepository;
    protected $imageService;

    const PATH_VIEW = 'backend.statistical.';

    public function __construct(
        RestaurantServiceInterface $restaurantService,
        RestaurantRepositoryInterface $restaurantRepository,
        PermissionRepository $permissionRepository,
        ImageService $imageService
    ) {
        $this->restaurantService = $restaurantService;
        $this->restaurantRepository = $restaurantRepository;
        $this->permissionRepository = $permissionRepository;
        $this->imageService = $imageService;
    }

    public function index()
    {
        return view(self::PATH_VIEW . __FUNCTION__, []);
    }

    public function menu()
    {
        return view(self::PATH_VIEW . __FUNCTION__, []);
    }

    public function client()
    {
        return view(self::PATH_VIEW . __FUNCTION__, []);
    }

    // Đơn hàng
    public function getRevenueStatistics(Request $request)
    {
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');
        $result = [];

        // Xử lý logic dựa trên các tham số được gửi lên
        if (!$year && !$month && !$day) {
            $day = Carbon::now()->day;
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;

            $result = $this->calculateRevenue($day, $month, $year);
        } elseif ($year && !$month && !$day) {
            if ($year != 'all') {
                $result = $this->calculateYearly($year);
            } else {
                $result = $this->calculateYearlyRevenue();
            }
        } elseif (!$year && $month && !$day) {
            $month = $month;
            $year = Carbon::now()->year;
            $result = $this->calculateRevenue($day, $month, $year);
        } elseif ($year && $month && !$day) {
            $month = $month;
            $year = $year;
            $result = $this->calculateRevenue($day, $month, $year);
        } elseif (!$year && !$month && $day) {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            $result = $this->calculateRevenue($day, $month, $year);
        } elseif (!$year && $month && $day) {
            $month = $month;
            $year = Carbon::now()->year;
            $result = $this->calculateRevenue($day, $month, $year);
        } elseif ($year && !$month && $day) {
            $month = Carbon::now()->month;
            $year = $year;
            $result = $this->calculateRevenue($day, $month, $year);
        } else if ($year && $month && $day) {
            $result = $this->calculateRevenue($day, $month, $year);
        }

        return response()->json(['revenue_statistics' => $result]);
    }

    // Thêm một phương thức mới để tính doanh thu cho nhiều năm từ 2020 đến năm hiện tại
    private function calculateYearly($year)
    {
        // Get the revenue data for the specified year, grouped by month
        $revenueData = Invoice::where('status', 'paid')
            ->whereYear('created_at', $year) // Filter by the specified year
            ->selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->groupBy('month') // Group by month
            ->orderBy('month') // Ensure months are ordered
            ->pluck('total_revenue', 'month') // Get the total revenue by month
            ->toArray();

        // Initialize an array for all 12 months, ensuring no months are missing
        $result = [];
        for ($month = 1; $month <= 12; $month++) {
            $result['Tháng ' . $month] = $revenueData[$month] ?? 0; // If no data for the month, return 0
        }

        return $result;
    }

    private function calculateYearlyRevenue()
    {
        // Define start and end years
        $startDate = 2020;
        $endDate = Carbon::now()->year;

        // Query the revenue data based on the selected years
        $revenueData = Invoice::where('status', 'paid')
            ->whereBetween('created_at', [Carbon::createFromDate($startDate, 1, 1), Carbon::createFromDate($endDate, 12, 31)])
            ->selectRaw('YEAR(created_at) as year, SUM(total_amount) as total_revenue')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('total_revenue', 'year')
            ->toArray();

        // Create a range of years from 2020 to the current year
        $years = range($startDate, $endDate);

        // Prepare the result
        $result = [];
        foreach ($years as $year) {
            $result['Năm ' . $year] = $revenueData[$year] ?? 0; // If no data, set revenue to 0
        }

        return $result;
    }

    private function calculateRevenue($day = null, $month = null, $year = null)
    {
        $revenueData = [];

        if (!$day && $month && $year) {
            // Get start and end of the month
            $startOfMonth = Carbon::create($year, $month, 1)->startOfDay();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            // Initialize an array for all days in the month with revenue = 0
            $defaultRevenueData = [];
            for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
                $defaultRevenueData[$date->toDateString()] = 0;
            }

            // Fetch revenues grouped by day
            $invoices = DB::table('invoices')
                ->selectRaw('DATE(created_at) as day, SUM(total_amount) as total_revenue')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            // Map database results to the revenue data
            foreach ($invoices as $revenue) {
                $defaultRevenueData[$revenue->day] = $revenue->total_revenue;
            }

            // Return the final result for the entire month
            return $defaultRevenueData;
        } else if ($day && $month && $year) {
            // Specific day: Calculate hourly revenue between 7:00 AM and 10:00 PM
            $specificDate = Carbon::create($year, $month, $day)->startOfDay();
            $startHour = 7;
            $endHour = 22;
            // Initialize an array for the specified hours with revenue = 0
            $defaultRevenueData = [];
            for ($hour = $startHour; $hour <= $endHour; $hour++) {
                $hourKey = $specificDate->copy()->addHours($hour)->format('H:00');
                $defaultRevenueData[$hourKey] = 0;
            }

            // Fetch revenue grouped by hour for the given day
            $invoices = DB::table('invoices')
                ->selectRaw('HOUR(created_at) as hour, SUM(total_amount) as total_revenue')
                ->whereDate('created_at', $specificDate)
                ->whereBetween(DB::raw('HOUR(created_at)'), [$startHour, $endHour])
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();

            // Map database results to the revenue data
            foreach ($invoices as $revenue) {
                $hourKey = str_pad($revenue->hour, 2, '0', STR_PAD_LEFT) . ':00'; // Format hour as "HH:00"
                $defaultRevenueData[$hourKey] = $revenue->total_revenue;
            }

            // Convert the revenue data to a one-dimensional array format
            $revenueData = $defaultRevenueData;
        }
        return $revenueData;
    }

    // Khách hàng 
    public function getCustomerStatistics(Request $request)
    {
        $day = $request->input('day');
        $month = $request->input('month');
        $year = $request->input('year');
        $result = [];

        // Xử lý logic dựa trên các tham số được gửi lên
        if (!$year && !$month && !$day) {
            $day = Carbon::now()->day;
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;

            $result = $this->calculateCustomerCount($day, $month, $year);
        } elseif ($year && !$month && !$day) {
            if ($year != 'all') {
                $result = $this->calculateYearlyCustomers($year);
            } else {
                $result = $this->calculateYearlyCustomerCount();
            }
        } elseif (!$year && $month && !$day) {
            $month = $month;
            $year = Carbon::now()->year;
            $result = $this->calculateCustomerCount($day, $month, $year);
        } elseif ($year && $month && !$day) {
            $month = $month;
            $year = $year;
            $result = $this->calculateCustomerCount($day, $month, $year);
        } elseif (!$year && !$month && $day) {
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            $result = $this->calculateCustomerCount($day, $month, $year);
        } elseif (!$year && $month && $day) {
            $month = $month;
            $year = Carbon::now()->year;
            $result = $this->calculateCustomerCount($day, $month, $year);
        } elseif ($year && !$month && $day) {
            $month = Carbon::now()->month;
            $year = $year;
            $result = $this->calculateCustomerCount($day, $month, $year);
        } else if ($year && $month && $day) {
            $result = $this->calculateCustomerCount($day, $month, $year);
        }

        return response()->json(['customer_statistics' => $result]);
    }

    // Thêm một phương thức mới để tính số lượng khách hàng theo năm
    private function calculateYearlyCustomers($year)
    {
        // Lấy tổng số khách hàng đến theo từng tháng
        $userData = Invoice::where('invoices.status', 'paid') // Chỉ rõ 'invoices.status'
            ->whereYear('invoices.created_at', $year) // Chỉ rõ 'invoices.created_at'
            ->selectRaw('MONTH(invoices.created_at) as month, COUNT(*) as user_count') // Không đổi
            ->groupBy('month') // Không đổi
            ->orderBy('month') // Không đổi
            ->pluck('user_count', 'month') // Không đổi
            ->toArray();

        // Khởi tạo kết quả cho 12 tháng, mặc định là 0
        $result = [];
        for ($month = 1; $month <= 12; $month++) {
            $result['Tháng ' . $month] = $userData[$month] ?? 0; // Nếu không có dữ liệu, trả về 0
        }

        return $result;
    }

    private function calculateYearlyCustomerCount()
    {
        // Define start and end years
        $startDate = 2020;
        $endDate = Carbon::now()->year;

        // Query the customer count data based on the selected years
        $user_count = Invoice::where('status', 'paid') // Removed 'invoices.' as it's not necessary
            ->whereBetween('created_at', [
                Carbon::createFromDate($startDate, 1, 1),
                Carbon::createFromDate($endDate, 12, 31)
            ])
            ->selectRaw('YEAR(created_at) as year, COUNT(*) as user_count') // Select year and count
            ->groupBy('year') // Group by year
            ->orderBy('year') // Order by year
            ->pluck('user_count', 'year') // Pluck by year
            ->toArray();

        // Create a range of years from 2020 to the current year
        $years = range($startDate, $endDate);

        // Prepare the result
        $result = [];
        foreach ($years as $year) {
            // If no data for the year, set count to 0
            $result['Năm ' . $year] = $user_count[$year] ?? 0;
        }

        return $result;
    }

    private function calculateCustomerCount($day = null, $month = null, $year = null)
    {
        $customerData = [];

        // Handle customer count for a specific month
        if (!$day && $month && $year) {
            $startOfMonth = Carbon::create($year, $month, 1)->startOfDay();
            $endOfMonth = $startOfMonth->copy()->endOfMonth();

            $defaultCustomerData = [];
            for ($date = $startOfMonth->copy(); $date->lte($endOfMonth); $date->addDay()) {
                $defaultCustomerData[$date->toDateString()] = 0;
            }

            // Query to count unique customers (by name, email, phone) per day in the given month
            $reservations = Invoice::where('invoices.status', 'paid')
                ->selectRaw('DATE(created_at) as day, COUNT(*) as customer_count')
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->groupBy('day')
                ->orderBy('day')
                ->get();

            // Map results to default data structure
            foreach ($reservations as $reservation) {
                $defaultCustomerData[$reservation->day] = $reservation->customer_count;
            }

            return $defaultCustomerData;
        } else if ($day && $month && $year) {
            $specificDate = Carbon::create($year, $month, $day)->startOfDay();
            $startHour = 7;
            $endHour = 22;

            // Initialize an array for the specified hours with customer count = 0
            $defaultCustomerData = [];
            for ($hour = $startHour; $hour <= $endHour; $hour++) {
                $hourKey = $specificDate->copy()->addHours($hour)->format('H:00');
                $defaultCustomerData[$hourKey] = 0;
            }

            // Query to count unique customers (by name, email, phone) per hour on the given day
            $reservations = Invoice::where('invoices.status', 'paid')
                ->selectRaw('HOUR(created_at) as hour, COUNT(*) as customer_count')
                ->whereDate('created_at', $specificDate)  // Ensure it's for the correct date
                ->whereBetween(DB::raw('HOUR(created_at)'), [$startHour, $endHour]) // Restrict hours range
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();

            // Map results to the data structure for each hour
            foreach ($reservations as $reservation) {
                if (isset($reservation->hour)) {
                    $hourKey = str_pad($reservation->hour, 2, '0', STR_PAD_LEFT) . ':00';
                    $defaultCustomerData[$hourKey] = $reservation->customer_count;
                }
            }

            return $defaultCustomerData;
        }

        return $customerData;
    }


    // Món ăn
    public function getMenuItemsWithReservationCounts(Request $request)
    {
        // Get start and end date from the request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit'); // Optional limit parameter
        $type = $request->input('sort', 'most'); // Default to 'most' (most reserved)

        // If no start and end dates, use a default range from 1st Jan 2020 to now
        if (!$startDate && !$endDate) {
            $startDate = Carbon::parse('2020-01-01')->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        } else {
            $startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::parse('2020-01-01')->startOfDay();
            $endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfDay();
        }

        // Get menu items with reservation counts
        $menuItems = $this->getMenusWithReservationCounts($startDate, $endDate, $limit, $type);

        return response()->json(['menu_items' => $menuItems]);
    }

    private function getMenusWithReservationCounts($startDate, $endDate, $limit, $type)
    {
        // Lấy các món ăn chỉ có trong hóa đơn
        $query = Menu::join('invoice_items', 'menus.id', '=', 'invoice_items.menu_id') // Join để chỉ lấy menu có hóa đơn
            ->join('invoices', 'invoice_items.invoice_id', '=', 'invoices.id') // Chỉ lấy hóa đơn có dữ liệu
            ->whereBetween('invoices.created_at', [$startDate, $endDate]) // Lọc theo ngày
            ->where('invoice_items.quantity', '>', 0) // Chỉ lấy các món có số lượng lớn hơn 0
            ->selectRaw('menus.id, menus.name, menus.price, SUM(invoice_items.quantity) as total_quantity')
            ->groupBy('menus.id', 'menus.name', 'menus.price');

        // Sắp xếp dựa trên loại (most/least)
        if ($type === 'least') {
            $query->orderBy('total_quantity'); // Ít được đặt nhất
        } else {
            $query->orderByDesc('total_quantity'); // Được đặt nhiều nhất
        }

        // Áp dụng giới hạn nếu có
        if ($limit) {
            $query->limit($limit);
        }

        $menuData = $query->get();

        // Định dạng kết quả
        $result = [];
        foreach ($menuData as $menuItem) {
            $result[] = [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'total_quantity' => $menuItem->total_quantity,
            ];
        }

        return $result;
    }

    // Bàn ăn
    public function getTableReservationStats(Request $request)
    {
        // Lấy ngày bắt đầu, kết thúc, loại sắp xếp và số lượng kết quả từ request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $type = $request->input('sort', null); // 'most' hoặc 'least', mặc định null để lấy tất cả
        $limit = $request->input('limit', null); // Số lượng kết quả muốn hiển thị, mặc định null (hiển thị tất cả)

        // Nếu không có startDate hoặc endDate, mặc định khoảng từ 1 tháng trước đến hôm nay
        if (!$startDate && !$endDate) {
            $startDate = Carbon::now()->subMonth()->startOfDay(); // Mặc định 1 tháng trước
            $endDate = Carbon::now()->endOfDay(); // Đến hết hôm nay
        } else {
            $startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::now()->subMonth()->startOfDay();
            $endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfDay();
        }

        // Gọi hàm xử lý
        $tableStats = $this->getTablesWithCompletedReservations($startDate, $endDate, $type, $limit);

        return response()->json(['tables' => $tableStats]);
    }

    private function getTablesWithCompletedReservations($startDate, $endDate, $type, $limit)
    {
        // Lấy thông tin các bàn và số lượt đặt chỗ đã hoàn tất trong khoảng thời gian
        $query = Table::join('reservation_details', 'tables.id', '=', 'reservation_details.table_id') // Liên kết với reservation_details
            ->join('reservations', 'reservation_details.reservation_id', '=', 'reservations.id') // Liên kết với reservations
            ->whereBetween('reservations.reservation_time', [$startDate, $endDate]) // Chỉ lấy dữ liệu trong khoảng thời gian
            ->where('reservations.status', 'completed') // Chỉ tính các đặt chỗ đã hoàn tất
            ->selectRaw('tables.id, tables.name, tables.capacity, COUNT(reservation_details.id) as reservation_count') // Đếm số lượt đặt
            ->groupBy('tables.id', 'tables.name', 'tables.capacity');

        // Xử lý sắp xếp theo loại
        if ($type === 'most') {
            $query->orderByDesc('reservation_count'); // Sắp xếp bàn được đặt nhiều nhất
        } elseif ($type === 'least') {
            $query->orderBy('reservation_count'); // Sắp xếp bàn được đặt ít nhất
        }

        // Áp dụng giới hạn số lượng nếu có
        if ($limit) {
            $query->limit($limit);
        }

        // Lấy dữ liệu
        $tableData = $query->get();

        // Định dạng kết quả
        $result = [];
        foreach ($tableData as $table) {
            $result[] = [
                'id' => $table->id,
                'name' => $table->name,
                'capacity' => $table->capacity,
                'reservation_count' => $table->reservation_count,
            ];
        }

        return $result;
    }

    public function reservation(Request $request)
    {
        // Nhận giá trị ngày bắt đầu và kết thúc từ request
        $startDate = $request->get('startDate') ? Carbon::parse($request->get('startDate')) : Carbon::today();
        $endDate = $request->get('endDate') ? Carbon::parse($request->get('endDate')) : Carbon::today();
    
        // Tổng số đơn hàng trong năm
        $totalYear = Reservation::whereYear('created_at', Carbon::now()->year)->count();
    
        // Tổng số đơn hàng trong khoảng thời gian (ngày bắt đầu đến ngày kết thúc)
        $totalOrders = Reservation::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])->count();
    
        // Chuẩn bị dữ liệu thống kê (theo ngày)
        $dataChart = Reservation::selectRaw('DATE(created_at) as date, COUNT(*) as total_orders')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'date' => $item->date,
                    'order' => $item->total_orders,
                ];
            });
    
        // Chuẩn bị dữ liệu cho view
        $data = [
            'totalYear' => $totalYear,      // Tổng số đơn hàng trong năm
            'totalOrders' => $totalOrders, // Tổng số đơn hàng trong khoảng thời gian
            'dataChart' => $dataChart,     // Số lượng đơn hàng theo ngày
        ];
    
        // Trả dữ liệu về view
        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'startDate', 'endDate'));
    }         
}
