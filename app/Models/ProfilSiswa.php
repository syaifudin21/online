<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProfilSiswa extends Model
{
	protected $fillable = [
        'id_ta','no_induk','nomor_user','nisn','nama','ttl','jk','agama','alamat','tinggal','transportasi','nomor_hp','ayah','ibu','keluarga','foto','sekolah_asal','ket_tambahan','prestasi','pendaftaran','status'
    ];
    
    public function ta(){
        return $this->belongsTo(TahunAjaran::class, 'id_ta', 'id');
    }
    // public function bab()
    // {
    //     return $this->hasMany(Bab::class, 'id_mapel', 'id');
    // }
	
	function createNoUser($nopendaftar){
        $kodesekolah = env('SEKOLAH_KODE');
        $kodeuser = 10;
        $th = date('y');
        $no = sprintf('%04d', $nopendaftar);
        return $kodesekolah.$kodeuser.$th.$no;
    }
    public function umur($tgl)
    {
        // %y = tahun %m = bulan %d hari
        $umur = Carbon::parse($tgl)->diff(Carbon::now())->format('%y Tahun, %m Bulan');
        return $umur;
    }
    public function getAge(){
        $this->ttl->diff(Carbon::now())
             ->format('%y years, %m months and %d days');
    }

    // untuk menggabungkan json
    // $data = json_decode($user->pendaftaran, true);
    //     $data['waktusenggang'] = 'beseok';

    // mengubah isi json
        // $user['pendaftaran->waktu_daftar'] = $jsonData;
}
