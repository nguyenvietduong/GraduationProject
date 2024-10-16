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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_amount', 10, 2);  // Tổng số tiền thanh toán
            $table->enum('payment_method', ['cash', 'credit_card', 'paypal'])->default('cash');  // Phương thức thanh toán
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
