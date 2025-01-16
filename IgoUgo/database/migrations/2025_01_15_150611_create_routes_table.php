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
        Schema::create('routes', function (Blueprint $table) {
            $table->id('route_id');
            $table->bigInteger('board_id')->unsigned();
            $table->char('route_theme', 1)->comment('0 : 힐링, 1 : 액티비티, 2 : 맛집 투어, 3 : 쇼핑');
            $table->char('route_people', 1)->comment('0 : 나홀로 여행, 1 : 커플 여행, 2 : 우정 여행, 3 : 가족 여행');
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
        Schema::dropIfExists('routes');
    }
};
