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
        Schema::create('products', function (Blueprint $table) {
            $table->id('prod_id');
            $table->bigInteger('cc_id')->unsigned();
            $table->string('prod_title', 100);
            $table->string('prod_img', 100);
            $table->string('prod_content', 2000);
            $table->bigInteger('prod_price');
            $table->string('prod_latitude', 100);
            $table->string('prod_longitude', 100);
            $table->string('prod_address', 100);
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
        Schema::dropIfExists('products');
    }
};
