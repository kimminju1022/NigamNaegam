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
        Schema::create('board_categories', function (Blueprint $table) {
            $table->id('bc_id');
            $table->char('bc_code', 1)->unique()->comment('0 : 리뷰, 1 : 자유, 2 : 문의, 3 : 체험단 신청, 4 : 이달의 추천, 5 : 공지사항');
            // $table->string('bc_name', 20);
            $table->string('bc_name', 10)->comment('0 : 리뷰, 1 : 자유, 2 : 문의, 3 : 체험단 신청, 4 : 이달의 추천, 5 : 공지사항');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_categories');
    }
};
