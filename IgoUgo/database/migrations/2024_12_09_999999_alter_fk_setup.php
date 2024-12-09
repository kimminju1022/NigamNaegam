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
        Schema::table('hotel_category_links', function(Blueprint $table) {
            $table->foreign('hotel_id')->references('hotel_id')->on('hotels');
            $table->foreign('hc_type')->references('hc_type')->on('hotel_categories');
        });

        Schema::table('product_category_links', function(Blueprint $table) {
            $table->foreign('prod_id')->references('prod_id')->on('products');
            $table->foreign('cc_type')->references('cc_type')->on('product_categories');
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
        Schema::table('hotel_category_links', function(Blueprint $table) {
            $table->dropForeign(['hotel_id']);
            $table->dropForeign(['hc_type']);
        });

        Schema::table('product_category_links', function(Blueprint $table) {
            $table->dropForeign(['prod_id']);
            $table->dropForeign(['cc_type']);
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
