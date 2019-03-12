<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilSiswa extends Model
{
	protected $fillable = ['id_ta','nomor_user','no_induk', 'nama', 'tgl', 'jk', 'nisn', 'agama', 'alamat', 'tinggal', 'transportasi', 'nomor_hp', 'nama_ayah', 'nama_ibu', 'tgl_ayah', 'tgl_ibu', 'nomor_hp_ortu', 'pendidikan_ayah', 'pendidikan_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu', 'alamat_ortu', 'penghasilan_ayah', 'penghasilan_ibu', 'keterangan_ayah', 'keterangan_ibu', 'tinggi', 'berat', 'jarak_sekolah', 'tempu_sekolah', 'anak_ke', 'jml_saudara', 'foto', 'akte', 'kps', 'ijazah', 'sekolah_asal', 'sekolah_alamat', 'sekolah_angkatan', 'nilai_test','minat_jurusan','diterima_kelas', 'status'];
}
