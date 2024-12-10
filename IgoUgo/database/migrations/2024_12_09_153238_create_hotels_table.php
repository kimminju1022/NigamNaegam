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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id('hotel_id');
            $table->bigInteger('hc_id')->unsigned();
            $table->decimal('hotel_latitude', 12, 9);
            $table->decimal('hotel_longitude', 12, 9);
            $table->string('hotel_title', 100);
            $table->string('hotel_content', 2000);
            $table->string('hotel_address', 100);
            $table->bigInteger('hotel_price');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
};
