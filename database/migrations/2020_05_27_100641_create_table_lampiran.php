<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableLampiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_lampiran', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('pendaftar_id')->unsigned();
            $table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
            $table->string('nama_file');
			$table->string('path');
			$table->string('jenis_file');
			$table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_lampiran');
    }
}
