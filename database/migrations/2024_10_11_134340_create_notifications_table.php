<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Người nhận thông báo
            $table->json('title');  // Tiêu đề thông báo hỗ trợ đa ngôn ngữ
            $table->json('message');  // Nội dung thông báo hỗ trợ đa ngôn ngữ
            $table->boolean('is_read')->default(false); // Trạng thái đã đọc
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
