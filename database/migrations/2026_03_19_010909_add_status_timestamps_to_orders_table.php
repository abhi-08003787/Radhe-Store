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
        Schema::table('orders', function (Blueprint $table) {
            // Add timestamp columns for each status
            $table->timestamp('placed_at')->nullable();
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            // $table->timestamp('delivered_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['placed_at', 'processing_at', 'shipped_at', 'delivered_at']);
        });
    }
};
