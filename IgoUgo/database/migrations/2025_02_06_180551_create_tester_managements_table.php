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
        Schema::create('tester_managements', function (Blueprint $table) {
            $table->id('tester_id');
            $table->bigInteger('board_id')->unsigned();
            $table->char('tester_code', 1)->comment('0 : 호텔, 1 : 관광지, 2 : 문화시설, 3 : 레포츠, 4 : 쇼핑, 5 : 음식점'); 
            $table->string('tester_name', 10)->comment('0 : 호텔, 1 : 관광지, 2 : 문화시설, 3 : 레포츠, 4 : 쇼핑, 5 : 음식점');
            $table->timestamp('due_date');
            $table->string('tester_place', 100);
            $table->string('tester_area', 10);
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
        Schema::dropIfExists('tester_managements');
    }
};
