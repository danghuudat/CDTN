<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoadonsachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoadonsach', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('muontra_id')->unsigned();
            $table->integer('tienquahan');
            $table->integer('tienthanhtoan');
            $table->integer('songayquahan');
            $table->string('nguoitt');
            $table->foreign('muontra_id')->references('id')->on('muontrasach')->onDelete('CASCADE');

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
        Schema::dropIfExists('hoadonsach');
    }
}
