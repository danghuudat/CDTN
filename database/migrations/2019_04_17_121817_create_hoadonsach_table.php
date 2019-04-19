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
            $table->integer('tienphat');
            $table->integer('total');
            $table->integer('user_id_tt');

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
