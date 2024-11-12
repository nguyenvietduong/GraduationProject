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
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên nhà hàng
            $table->string('slug'); // Slug tạo URL thân thiện
            $table->string('address'); // Địa chỉ nhà hàng
            $table->string('phone'); // Số điện thoại nhà hàng
            $table->string('opening_hours', 50)->nullable();
            $table->string('closing_time', 50)->nullable();
            $table->decimal('rating', 2, 1)->default(0.0);  // Đánh giá trung bình
            $table->text('description')->nullable(); // Mô tả nhà hàng
            $table->text('google_map_link')->nullable();
            $table->string('image')->nullable(); // Hình ảnh đại diện
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
