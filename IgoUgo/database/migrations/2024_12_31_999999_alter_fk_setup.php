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
        Schema::table('boards', function(Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('bc_id')->references('bc_id')->on('board_categories');
        });
        
        Schema::table('questions', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        Schema::table('likes', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        Schema::table('reviews',  function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('area_id')->references('area_id')->on('areas');
            $table->foreign('rc_id')->references('rc_id')->on('review_categories');
        });

        Schema::table('hotels', function(Blueprint $table) {
            $table->foreign('areacode')->references('areacode')->on('areas');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->foreign('areacode')->references('areacode')->on('areas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boards', function(Blueprint $table) {
            $table->foreign('user_id')->references('user_id')->on('users');
            $table->foreign('bc_id')->references('bc_id')->on('board_categories');
        });
        
        Schema::table('questions', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        Schema::table('likes', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('user_id')->references('user_id')->on('users');
        });

        Schema::table('reviews',  function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('area_id')->references('area_id')->on('areas');
            $table->foreign('rc_id')->references('rc_id')->on('review_categories');
        });

        Schema::table('hotels', function(Blueprint $table) {
            $table->foreign('areacode')->references('areacode')->on('areas');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->foreign('areacode')->references('areacode')->on('areas');
        });
    }
};
