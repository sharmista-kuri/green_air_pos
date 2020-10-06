<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->date('date');
            $table->integer('transaction_type_id');
            $table->integer('account_type_id');
            $table->integer('account_id');
            $table->string('description')->nullable();
            $table->double('amount', 16, 2);
            //$table->foreign('transaction_type_id')->reference('id')->on('transaction_types')->onDelete('cascade');
            //$table->foreign('account_id')->reference('id')->on('accounts')->onDelete('cascade');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE transactions AUTO_INCREMENT = 1000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
