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
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->integer('price')->default(0)->change();
            $table->integer('total')->default(0)->change();
            $table->boolean('is_served')->default(false)->after('total');
            $table->string('status_menu')->nullable()->after('is_served');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->json('price')->change();
            $table->json('total')->change();
            $table->dropColumn('is_served');
            $table->dropColumn('status_menu');
        });
    }
};
