<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInReviewsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Thay đổi cột status để thêm giá trị 'pending'
            $table->enum('status', ['active', 'inactive', 'pending'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            // Thay đổi cột status để khôi phục lại giá trị ban đầu
            $table->enum('status', ['active', 'inactive'])->default('inactive')->change();
        });
    }
}
