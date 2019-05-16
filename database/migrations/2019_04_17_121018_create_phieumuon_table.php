<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieumuonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieumuon', function (Blueprint $table) {
            $table->integer('muontra_id')->unsigned();
            $table->foreign('muontra_id')->references('id')->on('muontrasach')->onDelete('CASCADE');
            $table->integer('sach_id')->unsigned();
            $table->integer('active');
            $table->date('ngaytra')->nullable();
            $table->primary(['muontra_id','sach_id']);
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
        Schema::dropIfExists('phieumuon');
    }
}
