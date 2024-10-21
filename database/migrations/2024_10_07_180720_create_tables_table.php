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
        Schema::create('tables', function (Blueprint $table) {
            $table->id(); // ID của bàn
            $table->json('name'); // Tên bàn hỗ trợ đa ngôn ngữ
            $table->integer('capacity'); // Số người tối đa có thể ngồi
            $table->enum('status', ['available', 'occupied', 'reserved', 'out_of_service'])->default('available'); // Trạng thái bàn
            $table->text('description')->nullable(); // Mô tả bàn hỗ trợ đa ngôn ngữ
            $table->string('position'); // Vị trí bàn (ví dụ: A1, B3, C2... tương tự như bàn cờ vua)
            $table->timestamps(); // Thời gian tạo và cập nhật
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
