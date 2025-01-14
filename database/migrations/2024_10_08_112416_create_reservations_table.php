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
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('confirmation_code')->nullable();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('ipAddress')->nullable();
            $table->dateTime('reservation_time');
            $table->integer('guests');
            $table->text('special_request')->nullable();
            $table->enum('status', ['verification_pending', 'pending', 'confirmed', 'canceled', 'completed'])->default('verification_pending');
            $table->timestamps();
            $table->softDeletes();

            $table->index('reservation_time');
            $table->index('status');
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
