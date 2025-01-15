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
        Schema::create('hotel_infos', function (Blueprint $table) {
            $table->id('hotel_info_id');
            $table->bigInteger('product_id')->unsigned();
            // $table->integer('hc_code'); // 얘 integer?
            $table->char('hc_code', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotel_infos');
    }
};
