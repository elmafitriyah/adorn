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
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->increments('id_purchase_detail');
            $table->unsignedInteger('id_purchase');
            $table->unsignedInteger('id_product');
            $table->integer('price');
            $table->decimal('unit_price');
            
            $table->foreign('id_purchase')->references('id_purchase')->on('purchases');
            $table->foreign('id_product')->references('id_product')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
