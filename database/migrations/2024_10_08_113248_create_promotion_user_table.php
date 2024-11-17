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
        Schema::create('promotion_user', function (Blueprint $table) {
            $table->foreignId('promotion_id')->constrained('promotions')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->unique(['promotion_id', 'name', 'email', 'phone'], 'promotion_user_unique');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_user');
    }
};
