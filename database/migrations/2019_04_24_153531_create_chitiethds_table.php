<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitiethdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitiethds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hds_id')->unsigned();
            $table->integer('sach_id')->unsigned();
            $table->integer('tinhtrang');
            $table->integer('tienphathongsach');
            $table->foreign('sach_id')->references('id')->on('sach')->onDelete('CASCADE');
            $table->foreign('hds_id')->references('id')->on('hoadonsach')->onDelete('CASCADE');
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
        Schema::dropIfExists('chitiethds');
    }
}
