<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPeminatan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_peminatan', function (Blueprint $table) {
            $table->id();
            $table->string('peminatan')->unique();
			$table->string('keterangan')->comment('misalnya: map warna merah, dll');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_peminatan');
    }
}
