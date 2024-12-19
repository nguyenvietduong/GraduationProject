<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Reservation;
use App\Models\ReservationDetail;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Menu;
use App\Models\Table; // Model Table
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ReservationSeeder extends Seeder
{
    public function run()
    {
        // Đảm bảo chạy trên môi trường an toàn
        DB::transaction(function () {
            // Lấy danh sách người dùng
            $users = User::all();
            // Lấy danh sách các bàn
            $tables = Table::all();
            // Lấy danh sách món ăn
            $menus = Menu::all();
            // Tạo dữ liệu đặt hàng cho mỗi người dùng
            foreach ($users as $user) {
                // Tạo ngẫu nhiên số lượng đơn hàng
                $reservationCount = rand(1, 5);
                for ($i = 0; $i < $reservationCount; $i++) {
                    $randomDay = Carbon::createFromTimestamp(rand(strtotime('2020-01-01'), strtotime('now')));
                    $status = collect(['canceled', 'completed'])->random();
                    // Tạo đơn hàng
                    $guests = rand(1, 5);
                    $reservation = Reservation::create([
                        'user_id' => $user->id,
                        'code' => 'R' . Str::upper(Str::random(6)), // Mã đặt bàn ngẫu nhiên
                        'name' => $user->full_name,  // Sử dụng tên người dùng
                        'email' => $user->email,
                        'phone' => $user->phone,
                        'reservation_time' => $randomDay, // Ngày ngẫu nhiên trong tháng tới
                        'guests' => $guests, // Số lượng khách ngẫu nhiên
                        'special_request' => 'None', // Yêu cầu đặc biệt (tuỳ chỉnh nếu cần)
                        'status' => $status,
                    ]);
                    if (in_array($status, ['pending', 'confirmed', 'canceled'])) {
                        continue; // Dừng vòng lặp này và chuyển qua vòng lặp tiếp theo
                    }
                    // Tạo reservation_details (bàn)
                        ReservationDetail::create([
                            'reservation_id' => $reservation->id,
                            'table_id' => $tables->random()->id, // Chọn bàn ngẫu nhiên từ bảng 'tables'
                            'guests_detail' => $guests, // Số lượng khách cho bàn cụ thể
                        ]);

                    // Tạo hóa đơn
                    $invoice = Invoice::create([
                        'reservation_id' => $reservation->id,
                        'payment_method' => collect(['cash', 'bank'])->random(),
                        'status' => 'paid',
                        'total_amount' => 0, // Tổng tiền ban đầu
                        'note' => 'No additional notes',
                        'created_at' => $randomDay,
                        'updated_at' => $randomDay,
                    ]);

                    // Tạo invoice_items (món ăn)
                    $invoiceTotal = 0;
                    $itemsCount = rand(1, 5);
                    for ($k = 0; $k < $itemsCount; $k++) {
                        $menuItem = $menus->random();
                        $quantity = rand(1, 3); // Số lượng ngẫu nhiên
                        // Tạo item trong hóa đơn
                        $invoiceItem = $invoice->invoiceItems()->create([
                            'invoice_id' => $invoice->id,
                            'menu_id' => rand(1, 25), // Giả sử có 50 món ăn, lấy ngẫu nhiên menu_id
                            'quantity' => $quantity,
                            'price' => $menuItem->price,
                            'total' => $quantity * $menuItem->price,
                        ]);

                        // Cộng dồn tổng tiền cho hóa đơn
                        $invoiceTotal += $invoiceItem->total;
                    }

                    // Cập nhật tổng tiền trong hóa đơn
                    $invoice->update(['total_amount' => $invoiceTotal]);
                }
            }
        });
    }
}
