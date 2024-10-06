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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Tên danh mục (ví dụ: Món chính, Tráng miệng)
            $table->string('slug')->unique(); // Slug tạo URL thân thiện
            $table->foreignId('parent_id')->nullable()->constrained('categories')->onDelete('cascade'); // Danh mục cha
            $table->string('description')->nullable(); // Mô tả danh mục
            $table->timestamps();
            $table->softDeletes(); // Xóa mềm để có thể khôi phục
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
