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
        Schema::table('tester_lists', function(Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('board_id')->references('board_id')->on('boards');
        });

        Schema::table('tester_managements', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tester_lists', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['board_id']);
        });

        Schema::table('tester_managements', function (Blueprint $table) {
            $table->dropForeign(['board_id']);
        });
    }
};
