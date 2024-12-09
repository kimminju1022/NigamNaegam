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
            $table->string('board_img', 100)->default('/default/board_default.png');
            $table->integer('board_star');
            $table->timestamps();
            $table->softDeletes();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('bc_id')->unsigned();
            $table->bigInteger('local_id')->unsigned();
            $table->bigInteger('cc_id')->unsigned();
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
