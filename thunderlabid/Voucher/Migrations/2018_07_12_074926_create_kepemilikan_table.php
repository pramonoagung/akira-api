<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKepemilikanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kepemilikan', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('tanggal');
            $table->text('pemilik');
            $table->softDeletes();
            $table->timestamps();
            $table->integer('id_voucher')->unsigned();
            $table->foreign('id_voucher')->references('id')->on('Voucher');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kepemilikan');
    }
}
