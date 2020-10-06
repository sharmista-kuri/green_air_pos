<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('invoice_no');
            $table->integer('employee_id');
            $table->date('sale_date');
            $table->integer('sale_type');
            $table->integer('customer_id');
            $table->double('subtotal', 16, 2);
            $table->double('vat', 16, 2)->nullable();
            $table->double('transport_labour', 16, 2)->nullable();
            $table->double('discount', 16, 2)->nullable();
            $table->double('total', 16, 2);
            $table->double('paid', 16, 2);
            $table->double('due', 16, 2);
            $table->string('remarks')->nullable();
            //$table->foreign('employee_id')->reference('id')->on('employees')->onDelete('cascade');
            //$table->foreign('customer_id')->reference('id')->on('customers')->onDelete('cascade');
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
        Schema::dropIfExists('sales');
    }
}
