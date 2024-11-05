<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->nullable()->constrained('reservations')->onDelete('cascade');
            $table->json('total_amount');  // Tổng số tiền thanh toán hỗ trợ đa loại tiền tệ
            $table->json('payment_method');  // Phương thức thanh toán hỗ trợ đa ngôn ngữ
            $table->enum('status', ['unpaid', 'paid', 'canceled'])->default('unpaid');  // Trạng thái hóa đơn
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
