<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->string('jenis');
            $table->double('jumlah');
            $table->text('referensi');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('id_header_transaksi')->unsigned();
            $table->foreign('id_header_transaksi')->references('id')->on('Header_transaksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
}
