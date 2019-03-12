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
            $table->Integer('nomor_user')->nullable();
            $table->bigInteger('nisn');
            $table->string('nama');
            $table->string('tgl');
            $table->enum('jk', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Budha', 'Kong Hu Cu']);
            $table->string('alamat');
            $table->enum('tinggal', ['Orang Tua', 'Kost', 'Asrama', 'Lainnya']);
            $table->enum('transportasi', ['Sepeda Motor', 'Jalan Kaki', 'Transportasi Umum', 'Lainnya']);
            $table->string('nomor_hp');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('tgl_ayah');
            $table->string('tgl_ibu');
            $table->string('nomor_hp_ortu');
            $table->string('pendidikan_ayah')->nullable();
            $table->string('pendidikan_ibu')->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('alamat_ortu')->nullable();
            $table->string('penghasilan_ayah')->nullable();
            $table->string('penghasilan_ibu')->nullable();
            $table->enum('keterangan_ayah', ['Hidup', 'Meninggal'])->default('Meninggal');
            $table->enum('keterangan_ibu', ['Hidup', 'Meninggal'])->default('Meninggal');
            $table->string('tinggi');
            $table->string('berat');
            $table->string('jarak_sekolah');
            $table->string('tempu_sekolah');
            $table->string('anak_ke')->nullable();
            $table->string('jml_saudara')->nullable();
            $table->text('foto');
            $table->text('akte')->nullable();
            $table->text('kps')->nullable();
            $table->text('ijazah');
            $table->string('sekolah_asal');
            $table->string('sekolah_alamat');
            $table->integer('sekolah_angkatan');
            $table->integer('nilai_test')->nullable();
            $table->string('minat_jurusan')->nullable();
            $table->string('diterima_kelas')->nullable();
            $table->enum('status', ['Diterima','Gagal', 'Daftar', 'Verifikasi Siswa', 'Verifikasi Admin'])->default('Daftar');
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
