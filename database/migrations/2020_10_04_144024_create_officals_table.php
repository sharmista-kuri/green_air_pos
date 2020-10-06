<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfficalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('officals', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE officals AUTO_INCREMENT = 1000000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('officals');
    }
}
