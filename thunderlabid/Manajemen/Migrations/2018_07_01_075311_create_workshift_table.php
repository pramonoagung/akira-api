<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshiftTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshift', function (Blueprint $table) {
            $table->increments('id');            
            $table->string('hari');
            $table->time('jam_mulai');
            $table->time('jam_akhir');
            $table->integer('flag')->default(1);
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
        Schema::dropIfExists('workshift');
    }
}
