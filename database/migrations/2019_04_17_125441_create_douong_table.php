<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDouongTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('douong', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_du');
            $table->string('name_slug_du');
            $table->integer('gia');
            $table->integer('noibat');
            $table->string('hinhanh');
            $table->integer('tldu_id')->unsigned();
            $table->foreign('tldu_id')->references('id')->on('theloaidouong')->onDelete('CASCADE');


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
        Schema::dropIfExists('douong');
    }
}
