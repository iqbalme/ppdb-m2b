<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTDataPendaftar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_data_pendaftar', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pendaftar_id')->unsigned();
            $table->foreign('pendaftar_id')->on('t_pendaftar')->references('id')->delete('cascade');
            $table->string('no_peserta_un');
            $table->double('total_nilai_un');
            $table->date('tanggal_kelulusan');
            $table->string('nama_sekolah_asal');
            $table->enum('status_sekolah_asal', ['negeri', 'swasta']);
            $table->string('npsn_sekolah_asal');
            $table->longText('lokasi_sekolah_asal');
            $table->bigInteger('jenis_tempat_tinggal_id')->unsigned();
            $table->foreign('jenis_tempat_tinggal_id')->on('t_jenis_tempat_tinggal')->references('id')->delete('cascade');
            $table->longText('alamat');
            $table->string('kel_id');
            $table->string('kode_pos')->nullable();
            $table->bigInteger('jarak_rumah_madrasah_id')->unsigned();
            $table->foreign('jarak_rumah_madrasah_id')->on('t_jarak')->references('id')->delete('cascade');
            $table->bigInteger('transportasi_id')->unsigned();
            $table->foreign('transportasi_id')->on('t_transportasi')->references('id')->delete('cascade');
            $table->string('no_kk');
            $table->string('nama_ayah');
            $table->string('nik_ayah');
            $table->string('no_hp_ayah')->nullable();
            $table->bigInteger('pekerjaan_ayah_id')->unsigned();
            $table->foreign('pekerjaan_ayah_id')->on('t_pekerjaan')->references('id')->delete('cascade');
            $table->bigInteger('pendidikan_ayah_id')->unsigned();
            $table->foreign('pendidikan_ayah_id')->on('t_pendidikan')->references('id')->delete('cascade');
            $table->string('nama_ibu_kandung');
            $table->string('nik_ibu_kandung');
            $table->string('no_hp_ibu_kandung')->nullable();
            $table->bigInteger('pekerjaan_ibu_id')->unsigned();
            $table->foreign('pekerjaan_ibu_id')->on('t_pekerjaan')->references('id')->delete('cascade');
            $table->bigInteger('pendidikan_ibu_id')->unsigned();
            $table->foreign('pendidikan_ibu_id')->on('t_pendidikan')->references('id')->delete('cascade');
            $table->bigInteger('penghasilan_id')->unsigned();
            $table->foreign('penghasilan_id')->on('t_penghasilan')->references('id')->delete('cascade');
            $table->string('nama_wali');
            $table->string('nik_wali');
            $table->date('tanggal_lahir_wali');
            $table->bigInteger('pekerjaan_wali_id')->unsigned();
            $table->foreign('pekerjaan_wali_id')->on('t_pekerjaan')->references('id')->delete('cascade');
            $table->bigInteger('pendidikan_wali_id')->unsigned();
            $table->foreign('pendidikan_wali_id')->on('t_pendidikan')->references('id')->delete('cascade');
            $table->bigInteger('hubungan_wali_id')->unsigned();
            $table->foreign('hubungan_wali_id')->on('t_hubungan')->references('id')->delete('cascade');
            $table->string('no_hp_wali')->nullable();
            $table->longText('alamat_ortu_wali');
            $table->string('no_kip')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('t_data_pendaftar');
    }
}
