<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('input_details', function (Blueprint $table) {
            $table->increments('dt_id');
            $table->string('dt_unit');
            $table->Integer('dt_quantity');
            $table->string('dt_lotnumber');
            $table->date('dt_expried')->default(DB::raw('now()'));
            $table->integer('dt_vat')->default(0);
            $table->integer('dt_inputprice');
            $table->integer('dt_saleprice');
            $table->integer('dt_totalprice')->default(0);
            $table->Integer('prd_id')->unsigned();
            $table->Integer('ip_id')->unsigned();
            $table->foreign('prd_id')->references('prd_id')->on('products')->onDelete('cascade');
            $table->foreign('ip_id')->references('ip_id')->on('inputs')->onDelete('cascade');
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
        Schema::dropIfExists('input_details');
    }
};
