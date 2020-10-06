<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseCartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_cart_details', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('purchase_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->double('rate', 16, 2);
            $table->double('amount', 16, 2);
            //$table->foreign('purchase_id')->reference('id')->on('purchases')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_cart_details');
    }
}
