<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode');
            $table->string('jenis');
            $table->text('syarat');
            $table->boolean('status');
            $table->dateTime('tanggal_pemakaian');
            $table->dateTime('tanggal_kadaluarsa');
            $table->softDeletes();
            $table->timestamps();
            $table->string('owner_id');
            $table->foreign('owner_id')->references('username')->on('o_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voucher');
    }
}
