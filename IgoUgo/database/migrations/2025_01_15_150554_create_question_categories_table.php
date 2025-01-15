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
        Schema::create('question_categories', function (Blueprint $table) {
            $table->id('qc_id');
            $table->bigInteger('board_id')->unsigned();
            $table->char('qc_code', 1)->comment('0 : 로그인, 1 : 회원가입, 2 : 게시판, 3 : 호텔, 4 : 관광지, 5 : 문화시설, 6 : 레포츠, 7 : 쇼핑, 8 : 음식점');
            $table->string('qc_name', 10)->comment('0 : 로그인, 1 : 회원가입, 2 : 게시판, 3 : 호텔, 4 : 관광지, 5 : 문화시설, 6 : 레포츠, 7 : 쇼핑, 8 : 음식점');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_categories');
    }
};
