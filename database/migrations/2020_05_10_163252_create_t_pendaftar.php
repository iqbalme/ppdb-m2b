<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPendaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nis_lokal');
            $table->string('nisn')->unique();
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->bigInteger('agama_id')->unsigned();
            $table->foreign('agama_id')->on('t_agama')->references('id')->delete('cascade');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->bigInteger('hobi_id')->unsigned();
            $table->foreign('hobi_id')->on('t_hobi')->references('id')->delete('cascade');
            $table->bigInteger('cita_cita_id')->unsigned();
            $table->foreign('cita_cita_id')->on('t_cita_cita')->references('id')->delete('cascade');
            $table->integer('jumlah_saudara');
            $table->integer('anak_ke');
            $table->string('foto_path')->nullable();
			$table->string('email')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_pendaftar');
    }
}
