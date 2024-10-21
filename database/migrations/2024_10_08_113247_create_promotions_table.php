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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->json('title'); // Hỗ trợ đa ngôn ngữ
            $table->json('description')->nullable(); // Hỗ trợ đa ngôn ngữ
            $table->string('code')->nullable();
            $table->enum('type', ['percentage', 'fixed']);
            $table->integer('total')->default(1); // Số lần được dùng
            $table->json('min_order_value')->nullable(); // Để default thành JSON
            $table->json('max_discount')->nullable(); // Để max_discount là JSON
            $table->json('discount');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
