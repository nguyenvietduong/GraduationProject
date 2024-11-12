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
            $table->id(); 
            $table->string('name');
            $table->integer('capacity'); 
            $table->enum('status', ['available', 'occupied', 'reserved', 'out_of_service'])->default('available'); // Trạng thái bàn
            $table->text('description')->nullable(); 
            $table->string('position'); 
            $table->timestamps(); 
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
