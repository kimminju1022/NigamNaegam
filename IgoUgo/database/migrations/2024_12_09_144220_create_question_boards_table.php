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
        Schema::create('question_boards', function (Blueprint $table) {
            $table->id('qb_id');
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('bc_id')->unsigned();
            $table->string('qb_title', 100);
            $table->string('qb_content', 2000);
            $table->string('qb_img', 100)->default('/default/board_default.png');
            $table->string('qb_reply', 2000)->nullable();
            $table->char('qb_status', 1)->default(0);
            $table->timestamp('qb_reply_created_at')->nullable();
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
        Schema::dropIfExists('question_boards');
    }
};
