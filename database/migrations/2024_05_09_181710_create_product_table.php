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
        Schema::create('product', function (Blueprint $table) {
            $table->increments('product_id');
            $table->integer('category_id');
            $table->integer('manufacturer_id');
            $table->string('product_name');
            $table->longText('product_image');
            $table->decimal('product_price');
            $table->integer('warranty_period');
            $table->integer('product_quantity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
