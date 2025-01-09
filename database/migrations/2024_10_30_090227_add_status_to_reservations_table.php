<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modify the 'status' column to add a new value 'arrived'
        DB::statement("ALTER TABLE reservations MODIFY COLUMN status ENUM('verification_pending', 'pending', 'confirmed', 'canceled', 'completed', 'arrived') DEFAULT 'verification_pending'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the 'status' column back to its original ENUM options
        DB::statement("ALTER TABLE reservations MODIFY COLUMN status ENUM('verification_pending', 'pending', 'confirmed', 'canceled', 'completed') DEFAULT 'verification_pending'");
    }
};
