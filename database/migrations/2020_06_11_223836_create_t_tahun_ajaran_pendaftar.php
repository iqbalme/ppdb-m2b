<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTTahunAjaranPendaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_tahun_ajaran_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tahun_ajaran_id')->unsigned();
			$table->foreign('tahun_ajaran_id')->on('t_tahun_ajaran')->references('id')->delete('cascade');
			$table->bigInteger('pendaftar_id')->unsigned()->unique();
			$table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_tahun_ajaran_pendaftar');
    }
}
