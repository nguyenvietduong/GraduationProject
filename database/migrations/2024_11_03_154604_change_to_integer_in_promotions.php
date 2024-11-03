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
        Schema::table('promotions', function (Blueprint $table) {
            $table->integer('min_order_value')->nullable()->default(0)->change();
            $table->integer('max_discount')->nullable()->default(0)->change();
            $table->integer('discount')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('promotions', function (Blueprint $table) {
            $table->json('min_order_value')->nullable()->change();
            $table->json('max_discount')->nullable()->change();
            $table->json('discount')->change();
        });
    }
};
