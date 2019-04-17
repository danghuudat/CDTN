<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanDouongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ban_douong', function (Blueprint $table) {
            $table->integer('ban_id')->unsigned();
            $table->integer('douong_id')->unsigned();
            $table->integer('soluong')->unsigned();
            $table->foreign('ban_id')->references('id')->on('qlban')->onDelete('CASCADE');
            $table->foreign('douong_id')->references('id')->on('douong')->onDelete('CASCADE');
            $table->primary(['ban_id','douong_id']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ban_douong');
    }
}
