<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPendaftarKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pendaftar_kelas', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendaftar_id')->unsigned()->unique();
			$table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
			$table->bigInteger('kelas_id')->unsigned();
			$table->foreign('kelas_id')->on('t_kelas')->references('id')->delete('cascade');
			$table->string('nis')->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pendaftar_kelas');
    }
}
