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
        Schema::create('likes', function (Blueprint $table) {
            $table->id('like_id');
            $table->char('like_flg', 1)->default(0);
            // $table->char('like_flg', 1)->default('0'); // 문자열로 저장? boolean? int?
            // $table->boolean('like_flg')->default(false);
            $table->bigInteger('board_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
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
        Schema::dropIfExists('likes');
    }
};
