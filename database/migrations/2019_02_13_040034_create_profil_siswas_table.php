<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_siswas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_ta'); //tahun daftar
            $table->Integer('no_induk')->nullable();
            $table->string('nomor_user', 12)->nullable();
            $table->bigInteger('nisn');
            $table->string('nama'); //
            $table->string('ttl'); //tempat, tgl
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Budha', 'Kong Hu Cu']);
            $table->string('alamat');
            $table->enum('tinggal', ['Orang Tua', 'Kost', 'Asrama', 'Lainnya'])->nullable();
            $table->enum('transportasi', ['Sepeda Motor', 'Jalan Kaki', 'Transportasi Umum', 'Lainnya'])->nullable();
            $table->string('nomor_hp');
            $table->text('ayah'); //nama, tempat_lahir, tgl_lahir, pekerjaan, penghasilan, hidup
            $table->text('ibu');//nama, tempat_lahir, tgl_lahir, pekerjaan, penghasilan, hidup
            $table->string('keluarga'); //alamat ortu, nomor hp orut, anak_ke, jml_saudara
            $table->text('foto'); // foto, ijazah, kps, 
            $table->text('sekolah_asal'); //nama, alamat, angkatan
            $table->text('ket_tambahan')->nullable(); //tinggi, berat_badan, jarak_tempu , waktu_tempu, hobi,
            $table->text('prestasi')->nullable(); // [nama_prestasi, tahun, foto_bukti]
            $table->text('pendaftaran')->nullable(); //waktu_daftar, waktu_konfirmasi_admin, waktu_test_masuk, waktu_daftar_ulang, waktu_diterima, diterima_kelas, minat_jurusan
            $table->enum('status', [ 'Daftar', 'Verifikasi Admin', 'Diterima','Tidak Lolos'])->default('Daftar');
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
        Schema::dropIfExists('profil_siswas');
    }
}
