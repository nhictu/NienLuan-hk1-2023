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
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('sl_id');
            $table->integer('sl_vat');
            $table->string('sl_note')->nullable();
            $table->string('sl_name');
            $table->string('sl_phone');
            $table->string('sl_addr');
            $table->integer('ImportStatus')->default(0); // trạng thái nhập kho (đã nhập, chờ)
            $table->integer('sl_status')->default(0);
            $table->date('sl_date')->default(DB::raw('now()'));
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
};
