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
        Schema::table('hotels', function(Blueprint $table) {
            $table->foreign('hc_id')->references('hc_id')->on('hotel_categories');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->foreign('cc_id')->references('cc_id')->on('content_categories');
        });

        Schema::table('boards', function(Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('bc_id')->references('bc_id')->on('board_categories');
            $table->foreign('local_id')->references('local_id')->on('locals');
            $table->foreign('cc_id')->references('cc_id')->on('content_categories');
        });
        
        Schema::table('question_boards', function(Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('bc_id')->references('bc_id')->on('board_categories');
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        Schema::table('likes', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hotels', function(Blueprint $table) {
            $table->dropForeign(['hc_id']);
        });

        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign(['cc_id']);
        });

        Schema::table('boards', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['bc_id']);
            $table->dropForeign(['local_id']);
            $table->dropForeign(['cc_id']);
        });

        Schema::table('question_boards', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['bc_id']);
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign(['board_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('likes', function(Blueprint $table) {
            $table->dropForeign(['board_id']);
            $table->dropForeign(['user_id']);
        });
    }
};
