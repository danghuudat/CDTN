<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDouongTheloaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('douong_theloai', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('theloai_douong_name');
            $table->string('theloai_douong_name_khongdau');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('douong_theloai');
    }
}
