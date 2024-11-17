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

    // Đơn hàng
    public function getRevenueStatistics(Request $request)
    {
        // Retrieve start and end dates from the request, defaulting to 2020 if not provided
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $type = $request->input('type', 'year');

        // If no start or end date is provided, default to January 1, 2020, until the current date
        if (!$startDate && !$endDate) {
            $startDate = Carbon::parse('2020-01-01')->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        } else {
            $startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::parse('2020-01-01')->startOfDay();
            $endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfDay();
        }

        // Calculate revenue based on the specified type
        $result = [];

        if ($type === 'year') {
            $result = $this->calculateYearlyRevenue($startDate, $endDate);
        } elseif ($type === 'month') {
            $result = $this->calculateMonthlyRevenue($startDate, $endDate);
        } elseif ($type === 'day') {
            $result = $this->calculateDailyRevenue($startDate, $endDate);
        }

        return response()->json(['revenue_statistics' => $result]);
    }

    private function calculateYearlyRevenue($startDate, $endDate)
    {
        $revenueData = Invoice::where('status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('YEAR(created_at) as year, SUM(total_amount) as total_revenue')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('total_revenue', 'year')
            ->toArray();

        // Tạo các năm trong khoảng thời gian
        $years = CarbonPeriod::create($startDate, '1 year', $endDate);

        $result = [];
        foreach ($years as $year) {
            $yearKey = $year->year;
            $result[$yearKey] = $revenueData[$yearKey] ?? 0; // Nếu không có dữ liệu, trả về 0
        }

        return $result;
    }

    private function calculateMonthlyRevenue($startDate, $endDate)
    {
        $revenueData = Invoice::where('status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_amount) as total_revenue')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->mapWithKeys(function ($item) {
                $key = "{$item->year}-{$item->month}";
                return [$key => $item->total_revenue];
            })
            ->toArray();

        // Tạo các tháng trong khoảng thời gian
        $months = CarbonPeriod::create($startDate, '1 month', $endDate);

        $result = [];
        foreach ($months as $month) {
            $key = $month->format('Y-n'); // Ví dụ: "2023-1"
            $result[$key] = $revenueData[$key] ?? 0; // Nếu không có dữ liệu, trả về 0
        }

        return $result;
    }

    private function calculateDailyRevenue($startDate, $endDate)
    {
        $revenueData = Invoice::where('status', 'paid')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total_revenue')
            ->groupBy('date')
            ->orderBy('date')
            ->pluck('total_revenue', 'date')
            ->toArray();

        // Tạo các ngày trong khoảng thời gian
        $days = CarbonPeriod::create($startDate, '1 day', $endDate);

        $result = [];
        foreach ($days as $day) {
            $key = $day->toDateString(); // Ví dụ: "2023-01-01"
            $result[$key] = $revenueData[$key] ?? 0; // Nếu không có dữ liệu, trả về 0
        }

        return $result;
    }

    // Khách hàng 
    public function getPopularReservationTimes(Request $request)
    {
        // Get start and end date from the request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $limit = $request->input('limit', 10); // Default to 10 results

        // If no start and end dates, use a default range from 1st Jan 2020 to now
        if (!$startDate && !$endDate) {
            $startDate = Carbon::parse('2020-01-01')->startOfDay();
            $endDate = Carbon::now()->endOfDay();
        } else {
            $startDate = $startDate ? Carbon::parse($startDate)->startOfDay() : Carbon::parse('2020-01-01')->startOfDay();
            $endDate = $endDate ? Carbon::parse($endDate)->endOfDay() : Carbon::now()->endOfDay();
        }

        // Fetch customers with the highest number of reservations
        $topCustomers = $this->getTopCustomers($startDate, $endDate, $limit);

        return response()->json(['top_customers' => $topCustomers]);
    }

    private function getTopCustomers($startDate, $endDate, $limit)
    {
        // Get the customer data with reservation count
        $customerData = Reservation::where('status', 'completed')->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('name, email, phone, COUNT(*) as reservation_count')
            ->groupBy('name', 'email', 'phone') // Group by customer details
            ->orderByDesc('reservation_count') // Order by the highest reservation count
            ->limit($limit)
            ->get();

        // Prepare the result with detailed customer information
        $result = [];
        foreach ($customerData as $data) {
            $result[] = [
                'name' => $data->name,
                'email' => $data->email,
                'phone' => $data->phone,
                'reservation_count' => $data->reservation_count
            ];
        }

        return $result;
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
}
