<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->longText('description')->nullable();
            $table->double('purchase_price', 16, 2);
            $table->double('sale_price', 16, 2);
            $table->integer('current_stock')->nullable();
            $table->timestamps();
        });
        
        DB::statement("ALTER TABLE products AUTO_INCREMENT = 1000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
