<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->increments('iv_id');
            $table->integer('iv_saleprice')->default(0);
            $table->integer('iv_inputprice')->default(0);
            $table->integer('prd_id')->unsigned();
            $table->integer('iv_final')->default(0);
            $table->integer('iv_export')->default(0);
            $table->integer('iv_realexport')->default(0);
            $table->Integer('dt_id')->unsigned();
            $table->foreign('dt_id')->references('dt_id')->on('input_details')->onDelete('cascade');
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
        Schema::dropIfExists('inventories');
    }
};
