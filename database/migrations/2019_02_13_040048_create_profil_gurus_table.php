<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilGurusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_gurus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nomor_user');
            $table->string('nama');
            $table->string('tgl');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->integer('nim')->nullable();
            $table->enum('agama', ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Budha', 'Kong Hu Cu']);
            $table->string('alamat');
            $table->enum('transportasi', ['Sepeda Motor', 'Jalan Kaki', 'Transportasi Umum', 'Lainnya']);
            $table->string('nomor_hp');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('alamat_ortu')->nullable();
            $table->enum('keterangan_ayah', ['Hidup', 'Meninggal'])->default('Meninggal');
            $table->enum('keterangan_ibu', ['Hidup', 'Meninggal'])->default('Meninggal');
            $table->text('foto');
            $table->text('ijazah');
            $table->string('lulusan');
            $table->string('moto')->nullable();
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
        Schema::dropIfExists('profil_gurus');
    }
}
