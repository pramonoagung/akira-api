<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScopeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('o_scopes', function ($table) {
            // Id
            $table->BigIncrements('id');
            // Attr
            $table->string('scope', 255);
            $table->datetime('tanggal_kadaluarsa')->nullable();
            $table->integer('user_id');
            $table->integer('tenant_id');
            // Timestamp
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('o_scopes');
    }
}
