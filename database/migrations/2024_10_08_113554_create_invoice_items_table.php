<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade');  // Hóa đơn liên quan
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');  // Món ăn trong hóa đơn
            $table->integer('quantity');  // Số lượng món ăn
            $table->json('price');  // Giá món ăn hỗ trợ đa loại tiền tệ
            $table->json('total');  // Tổng tiền cho món (số lượng * giá) hỗ trợ đa loại tiền tệ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
