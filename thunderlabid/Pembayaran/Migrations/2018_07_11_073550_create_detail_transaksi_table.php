<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailTransaksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ref_id');
            $table->text('produk');
            $table->integer('kuantitas');
            $table->double('harga');
            $table->double('diskon');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('id_header_transaksi')->unsigned();
            $table->foreign('id_header_transaksi')->references('id')->on('Header_transaksi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_transaksi');
    }
}
