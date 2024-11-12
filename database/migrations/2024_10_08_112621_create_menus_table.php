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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Lưu tên sản phẩm theo ngôn ngữ
            $table->string('slug'); // Lưu tên sản phẩm theo ngôn ngữ
            $table->string('description')->nullable(); // Lưu mô tả sản phẩm theo ngôn ngữ
            $table->string('price'); // Lưu giá theo nhiều ngôn ngữ hoặc đơn vị tiền tệ
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('image_url')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
