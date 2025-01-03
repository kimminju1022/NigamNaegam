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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id('hotel_id');
            $table->string('title', 100);
            $table->string('addr1', 255)->nullable();
            $table->string('addr2', 255)->nullable();
            $table->string('tel', 50)->nullable();
            $table->string('area_code', 3)->nullable();
            $table->boolean('benikia')->default(false);
            $table->boolean('booktour')->default(false);
            $table->boolean('goodstay')->default(false);
            $table->boolean('hanok')->default(false);
            $table->char('cat1', 3)->nullable();
            $table->char('cat2', 5)->nullable();
            $table->char('cat3', 9)->nullable();
            $table->integer('contentid');
            $table->char('contenttypeid', 2);
            $table->string('firstimage', 255)->nullable();
            $table->string('firstimage2', 255)->nullable();
            $table->string('cpyrhtdivcd', 7)->nullable();
            $table->string('mapx', 50)->nullable();
            $table->string('mapy', 50)->nullable();
            $table->string('mlevel', 50)->nullable();
            $table->string('sigungucode', 3)->nullable();
            $table->timestamp('createdtime');
            $table->timestamp('modifiedtime');
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
        Schema::dropIfExists('hotels');
    }
};
