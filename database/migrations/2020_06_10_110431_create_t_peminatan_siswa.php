<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPeminatanSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_peminatan_siswa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendaftar_id')->unsigned();
			$table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
			$table->bigInteger('peminatan_id')->unsigned()->unique();
			$table->foreign('peminatan_id')->on('t_peminatan')->references('id')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_peminatan_siswa');
    }
}
