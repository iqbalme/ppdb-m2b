<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTEmailToSend extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_email_to_send', function (Blueprint $table) {
            $table->id();
			$table->bigInteger('pendaftar_id')->unsigned()->unique();
            $table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
			$table->string('email');
			$table->longText('data');
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
        Schema::dropIfExists('t_email_to_send');
    }
}
