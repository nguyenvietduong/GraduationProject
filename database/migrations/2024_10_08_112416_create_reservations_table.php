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
            $table->foreignId('table_id')->nullable()->constrained('tables')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->dateTime('reservation_time');
            $table->integer('guests');
            $table->text('special_request')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'canceled', 'completed'])->default('pending');
            $table->timestamps();
            $table->softDeletes();

            // Adding indexes for optimization
            $table->unique(['table_id', 'reservation_time'], 'unique_user_table_reservation');
            // $table->index(['user_id', 'table_id']);
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
