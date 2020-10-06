<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_cart_details', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('sales_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->double('rate', 16, 2);
            $table->double('amount', 16, 2);
            //$table->foreign('sales_id')->reference('id')->on('sales')->onDelete('cascade');
            //$table->foreign('product_id')->reference('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_cart_details');
    }
}
