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
            // $table->integer('hc_code')->unique(); // 얘는 왜 또 integer?
            $table->char('hc_code', 1)->unique()->comment('0: 수영장, 1: 바베큐장, 2: 캠프파이어, 3: 뷰티시설, 4: 피트니스센터, 5: 픽업서비스');
            $table->string('hc_name', 10);
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
