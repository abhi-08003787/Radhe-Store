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
            // Drop existing columns that are redundant or not needed
            if (Schema::hasColumn('orders', 'customer_name')) {
                $table->dropColumn('customer_name');
            }
            if (Schema::hasColumn('orders', 'subtotal')) {
                $table->dropColumn('subtotal');
            }
            if (Schema::hasColumn('orders', 'tax')) {
                $table->dropColumn('tax');
            }
            if (Schema::hasColumn('orders', 'total')) {
                $table->dropColumn('total');
            }
            if (Schema::hasColumn('orders', 'total_items')) {
                $table->dropColumn('total_items');
            }

            // Add new columns
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('total_amount', 10, 2);
            $table->text('shipping_address');
            $table->string('payment_method')->nullable();
            $table->string('payment_id')->nullable(); // For Razorpay
            $table->string('payment_status')->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_name')->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->integer('total_items')->default(1);

            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'total_amount', 'shipping_address', 'payment_method', 'payment_id', 'payment_status']);
        });
    }
};
