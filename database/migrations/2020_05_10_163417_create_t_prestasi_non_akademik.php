<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPrestasiNonAkademik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_prestasi_non_akademik', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendaftar_id')->unsigned();
            $table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
            $table->string('jenis_lomba');
            $table->string('tingkat')->nullable();
            $table->string('tempat_pelaksanaan')->nullable();
            $table->string('peringkat_juara');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_prestasi_non_akademik');
    }
}
