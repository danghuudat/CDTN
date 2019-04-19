<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuonsachtrasachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muonsahtrasach', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sach_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->date('ngaymuon');
            $table->date('ngaytra');
            $table->integer('tiendatcoc');
            $table->integer('tienthue');
            $table->integer('active');
            $table->foreign('sach_id')->references('id')->on('sach');
            $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('muonsahtrasach');
    }
}
