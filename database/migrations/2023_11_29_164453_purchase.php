<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Purchase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pur_id');
            $table->string('pur_name');
            $table->string('pro_id');
            $table->string('category_id');
            $table->string('unit_id');
            $table->float('amount');
            $table->integer('qty');
            $table->float('total_amt',10,2);
            $table->string('status');
            $table->string('remark');
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
        Schema::dropIfExists('purchase');
    }
}