<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailReservasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_reservasi', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('header_reservasi_id')->index();
            $table->unsignedInteger('karyawan_id')->index();
            $table->unsignedInteger('produk_id')->index();
            $table->string('jam_berakhir');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('header_reservasi_id')->references('id')->on('header_reservasi')->onDelete('cascade');
            $table->foreign('karyawan_id')->references('id')->on('karyawan')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_reservasi');
    }
}
