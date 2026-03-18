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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('category')->nullable(); // Select માટે
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();    // મેઈન પ્રોડક્ટ ઈમેજ
            $table->decimal('regular_price', 10, 2)->default(0);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->string('SKU')->unique();
            $table->integer('quantity')->default(0);
            $table->string('stock_status')->default('instock'); // instock, outofstock
            $table->boolean('featured')->default(false);        // Yes/No
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
