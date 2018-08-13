<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKetersediaanTerapisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ketersediaan_terapis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_akhir');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('penempatan_id')->unsigned();
            $table->foreign('penempatan_id')->references('id')->on('penempatan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ketersediaan_terapis');
    }
}
