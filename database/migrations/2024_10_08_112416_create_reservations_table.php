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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('table_id')->nullable()->constrained('tables')->onDelete('cascade');
            $table->dateTime('reservation_time'); // thời gian đặt chỗ
            $table->integer('guests');  // Số khách
            $table->text('special_request')->nullable();  // Yêu cầu đặc biệt
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'completed'])->default('pending');
            $table->timestamps();
            $table->softDeletes();

            // Thêm chỉ mục vào các trường cần thiết
            $table->unique(['user_id', 'table_id', 'reservation_time'], 'unique_user_table_reservation');
            $table->index(['user_id', 'table_id']); // Chỉ mục cho user_id và table_id
            $table->index('reservation_time'); // Chỉ mục cho thời gian đặt chỗ
            $table->index('status'); // Chỉ mục cho trạng thái
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
