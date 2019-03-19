<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTahunAjaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_ajarans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tahun_ajaran');
            $table->string('tgl_pendaftaran')->nullabel();
            $table->string('tgl_test')->nullabel();
            $table->string('tgl_pengumuman')->nullabel();
            $table->string('tgl_daftar_ulang')->nullabel();
            $table->text('jadwal')->nullabel();
            $table->text('brosur')->nullabel();
            $table->enum('status', ['Show','Hidden'])->default('Hidden');
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
        Schema::dropIfExists('tahun_ajarans');
    }
}
