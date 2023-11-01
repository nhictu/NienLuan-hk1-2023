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
        Schema::create('inputs', function (Blueprint $table) {
            $table->increments('ip_id');
            $table->string('ip_bill');
            $table->integer('ip_vat');
            $table->date('ip_dateinput')->default(DB::raw('now()'));
            $table->date('ip_datecreate')->default(DB::raw('now()'));
            $table->integer('ip_status')->default(0);
            $table->integer('ImportStatus')->default(0); // trạng thái nhập kho (đã nhập, chờ)
            $table->integer('total')->default(0);// thành tiền
            $table->unsignedInteger('sp_id');
            $table->foreign('sp_id')->references('sp_id')->on('suppliers')->onDelete('cascade');
            $table->timestamps();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inputs');
    }
};
