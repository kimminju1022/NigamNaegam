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
        Schema::create('tester_due_dates', function (Blueprint $table) {
            $table->id('tester_dd_id');
            $table->bigInteger('board_id')->unsigned();
            $table->char('tester_code', '1')->comment('0 : 호텔, 1 : 관광지, 2 : 문화시설, 3 : 레포츠, 4 : 쇼핑, 5 : 음식점'); 
            $table->char('tester_name', '1')->comment('0 : 호텔, 1 : 관광지, 2 : 문화시설, 3 : 레포츠, 4 : 쇼핑, 5 : 음식점');
            $table->timestamp('due_date');
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
        Schema::dropIfExists('tester_due_dates');
    }
};
