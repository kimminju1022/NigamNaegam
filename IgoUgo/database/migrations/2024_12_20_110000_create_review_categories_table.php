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
        Schema::create('review_categories', function (Blueprint $table) {
            $table->id('rc_id');
            $table->char('rc_code', 1)->unique()->comment('0 : 호텔, 1 : 관광지, 2 : 문화시설, 3 : 레포츠, 4 : 쇼핑, 5 : 음식점');
            $table->string('rc_name', 10);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('review_categories');
    }
};
