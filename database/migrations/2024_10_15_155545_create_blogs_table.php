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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id(); // ID của bài viết
            $table->string('title'); // Tiêu đề bài viết hỗ trợ đa ngôn ngữ
            $table->string('content'); // Nội dung bài viết hỗ trợ đa ngôn ngữ
            $table->string('slug')->unique(); // Đường dẫn thân thiện (slug) hỗ trợ đa ngôn ngữ
            $table->string('image')->nullable(); // Đường dẫn hình ảnh (nếu có)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID của người dùng đăng bài
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->softDeletes(); // Xóa mềm (nếu cần)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
