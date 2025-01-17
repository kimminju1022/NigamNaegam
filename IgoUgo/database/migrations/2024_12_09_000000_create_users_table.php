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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->char('manager_flg', 1)->default('0');
            $table->char('user_flg', 1)->default('0');
            $table->string('user_email', 50)->unique();
            $table->string('user_password', 255);
            $table->string('user_name', 20);
            $table->string('user_nickname', 50)->unique();
            $table->string('user_phone', 50)->unique();
            $table->string('user_profile', 100)->default('/default/profile_default.png');
            $table->string('refresh_token', 512)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password_reset_token', 512)->nullable();
            $table->timestamp('password_reset_expires_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
