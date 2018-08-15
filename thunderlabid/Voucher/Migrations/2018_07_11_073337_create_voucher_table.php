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
            $table->integer('jumlah');
            $table->text('syarat');
            $table->boolean('status');
            $table->timestamp('tanggal_pemakaian')->nullableTimestamps();
            $table->dateTime('tanggal_kadaluarsa');
            $table->string('logo_voucher');
            $table->softDeletes();
            $table->timestamps();
            $table->unsignedInteger('owner_id')->index();
            $table->foreign('owner_id')->references('id')->on('o_users')->onDelete('cascade');
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
