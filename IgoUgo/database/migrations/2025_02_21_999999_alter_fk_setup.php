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
            // $table->foreign('bc_type')->references('bc_type')->on('board_categories');
            $table->foreign('bc_code')->references('bc_code')->on('board_categories');
        });
        
        Schema::table('questions', function(Blueprint $table) {
            $table->foreign('board_id')->references('board_id')->on('boards');
            $table->foreign('user_id')->references('user_id')->on('users');
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
            $table->foreign('area_code')->references('area_code')->on('areas');
            // $table->foreign('rc_type')->references('rc_type')->on('review_categories');
            $table->foreign('rc_code')->references('rc_code')->on('review_categories');
        });

        // Schema::table('hotels', function(Blueprint $table) {
        //     $table->foreign('area_code')->references('area_code')->on('areas');
        // });

        Schema::table('hotel_infos', function(Blueprint $table) {
            // $table->foreign('hotel_id')->references('hotel_id')->on('hotels');
            // $table->foreign('hc_type')->references('hc_type')->on('hotel_categories');
            $table->foreign('product_id')->references('product_id')->on('products');
            $table->foreign('hc_code')->references('hc_code')->on('hotel_categories');
        });

        Schema::table('products', function(Blueprint $table) {
            $table->foreign('area_code')->references('area_code')->on('areas');
        });

        // Schema::table('festivals', function(Blueprint $table) {
        //     $table->foreign('area_code')->references('area_code')->on('areas');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('boards', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['bc_type']);
        });
        
        Schema::table('questions', function(Blueprint $table) {
            $table->dropForeign(['board_id']);
        });

        Schema::table('comments', function(Blueprint $table) {
            $table->dropForeign(['board_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('likes', function(Blueprint $table) {
            $table->dropForeign(['board_id']);
            $table->dropForeign(['user_id']);
        });

        Schema::table('reviews',  function(Blueprint $table) {
            $table->dropForeign(['board_id']);
            $table->dropForeign(['area_code']);
            $table->dropForeign(['rc_type']);
        });

        Schema::table('hotels', function(Blueprint $table) {
            $table->dropForeign(['area_code']);
        });

        Schema::table('hotel_infos', function(Blueprint $table) {
            $table->dropForeign(['hotel_id']);
            $table->dropForeign(['hc_type']);
        });

        Schema::table('products', function(Blueprint $table) {
            $table->dropForeign(['area_code']);
        });

        Schema::table('festivals', function(Blueprint $table) {
            $table->dropForeign(['area_code']);
        });
    }
};
