<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStrukturRuangKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('struktur_ruang_kelas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_rk');
            $table->string('nomor_user', 12);
            $table->string('jabatan');
            $table->enum('status', ['Daftar', 'Aktif', 'Block'])->default('Daftar');
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
        Schema::dropIfExists('struktur_ruang_kelas');
    }
}
