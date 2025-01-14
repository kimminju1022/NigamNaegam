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
        Schema::create('boards', function (Blueprint $table) {
            $table->id('board_id');
            $table->string('board_title', 100);
            $table->string('board_content', 2000);
            // $table->string('board_img1', 100)->nullable()->default('/default/board_default.png');
            // $table->string('board_img2', 100)->nullable()->default('/default/board_default.png');
            $table->char('board_flg', 1)->default('0');
            $table->bigInteger('view_cnt')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->char('bc_type', 1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boards');
    }
};
