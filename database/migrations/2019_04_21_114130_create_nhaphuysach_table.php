<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhaphuysachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhaphuysach', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sach_id')->unsigned();
            $table->integer('status');
            $table->integer('soluong')->nullable();
            $table->integer('soluongbd')->nullable();
            $table->date('ngay');
            $table->string('ghichu')->nullable();

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
        Schema::dropIfExists('nhaphuysach');
    }
}
