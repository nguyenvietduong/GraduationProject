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
            $table->string('title'); // Hỗ trợ đa ngôn ngữ
            $table->string('description')->nullable(); // Hỗ trợ đa ngôn ngữ
            $table->string('code')->nullable();
            $table->enum('type', ['percentage', 'fixed']);
            $table->integer('total')->default(1); // Số lần được dùng
            $table->string('min_order_value')->nullable();
            $table->string('max_discount')->nullable();
            $table->string('discount');
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
