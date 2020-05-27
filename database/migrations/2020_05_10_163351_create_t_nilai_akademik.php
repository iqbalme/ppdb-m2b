<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTNilaiAkademik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_nilai_akademik', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendaftar_id')->unsigned();
            $table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
            $table->bigInteger('mapel_id')->unsigned();
            $table->foreign('mapel_id')->on('t_mapel')->references('id')->delete('cascade');
            $table->double('semester1');
            $table->double('semester2');
            $table->double('semester3');
            $table->double('semester4');
            $table->double('semester5');
            $table->double('avg')->nullable(); //otomatis dari trigger
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
        Schema::dropIfExists('t_nilai_akademik');
    }
}
