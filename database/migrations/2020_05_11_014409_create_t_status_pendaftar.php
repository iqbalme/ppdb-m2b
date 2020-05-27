<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTStatusPendaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_status_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendaftar_id')->unsigned();
            $table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
			$table->string('noRegistrasi')->unique();
            $table->enum('status', ['aktif', 'non aktif'])->default('non aktif');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_status_pendaftar');
    }
}
