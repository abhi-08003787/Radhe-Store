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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // કૂપન કોડ
            $table->string('type')->default('fixed'); // fixed અથવા percent
            $table->decimal('value', 10, 2); // કૂપનની કિંમત
            $table->decimal('cart_value', 10, 2); // ઓછામાં ઓછી કાર્ટ વેલ્યુ
            $table->date('expiry_date'); // એક્સપાયરી ડેટ
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
