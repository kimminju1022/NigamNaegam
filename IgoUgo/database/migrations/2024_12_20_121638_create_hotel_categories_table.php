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
        Schema::create('hotel_categories', function (Blueprint $table) {
            $table->id('hc_id');
            $table->bigInteger('hotel_id', 20)->unsigned();
            $table->boolean('pool')->default(false);
            $table->boolean('grill')->default(false);
            $table->boolean('fire')->default(false);
            $table->boolean('beauty')->default(false);
            $table->boolean('fitness')->default(false);
            $table->boolean('pickup')->default(false);
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
        Schema::dropIfExists('hotel_categories');
    }
};
