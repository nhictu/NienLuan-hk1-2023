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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('sdt_id');
            $table->Integer('sdt_quantity');
            $table->integer('sdt_saleprice');
            $table->integer('sdt_totalprice');
            $table->Integer('sl_id')->unsigned();
            $table->foreign('sl_id')->references('sl_id')->on('sales')->onDelete('cascade');
            $table->Integer('iv_id')->unsigned();
            $table->foreign('iv_id')->references('iv_id')->on('inventories')->onDelete('cascade');
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
        Schema::dropIfExists('sale_details');
    }
};
