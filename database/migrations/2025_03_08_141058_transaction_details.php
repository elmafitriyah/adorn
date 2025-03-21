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
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id_transaction_detail');
            $table->unsignedInteger('id_transaction');
            $table->unsignedInteger('id_product');
            $table->integer('total');
            $table->decimal('unit_price');
            
            $table->foreign('id_transaction')->references('id_transaction')->on('transactions');
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
