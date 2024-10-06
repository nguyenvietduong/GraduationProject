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
            $table->string('slug')->unique(); // Slug tạo URL thân thiện
            $table->string('address'); // Địa chỉ nhà hàng
            $table->string('phone_number'); // Số điện thoại nhà hàng
            $table->text('description')->nullable(); // Mô tả nhà hàng
            $table->string('image')->nullable(); // Hình ảnh đại diện
            $table->timestamps();
            $table->softDeletes(); // Xóa mềm để có thể khôi phục
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
