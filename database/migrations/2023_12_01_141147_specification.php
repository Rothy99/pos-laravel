<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Specification extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specification', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('specification_id');
            $table->integer('pro_id');
            $table->string('specification_name');
            $table->string('specification_value');
            $table->float('price', 10, 2);
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
        Schema::dropIfExists('specification');
    }
}
