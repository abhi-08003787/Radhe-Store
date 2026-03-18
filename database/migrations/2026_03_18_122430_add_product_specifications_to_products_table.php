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
        Schema::table('products', function (Blueprint $table) {
            $table->string('style_id')->nullable()->after('SKU');
            $table->integer('sla_days')->nullable()->after('style_id');
            $table->decimal('supplier_cost', 10, 2)->nullable()->after('sla_days');
            $table->decimal('weight', 8, 2)->nullable()->after('supplier_cost');
            $table->string('hsn_code')->nullable()->after('weight');
            $table->decimal('gst_percentage', 5, 2)->default(3.00)->after('hsn_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['style_id', 'sla_days', 'supplier_cost', 'weight', 'hsn_code', 'gst_percentage']);
        });
    }
};
