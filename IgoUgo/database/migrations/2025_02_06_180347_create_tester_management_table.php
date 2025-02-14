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
        Schema::create('tester_management', function (Blueprint $table) {
            $table->id('tester_id');
            $table->bigInteger('board_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->char('review_chk', '1')->default('0');
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
        Schema::dropIfExists('tester_management');
    }
};
