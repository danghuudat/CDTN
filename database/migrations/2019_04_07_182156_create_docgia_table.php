<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocgiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docgia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_docgia');
            $table->string('slug_name_dg');
            $table->string('hinhanh')->nullable();
            $table->string('diachi')->nullable();
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
        Schema::dropIfExists('docgia');
    }
}
