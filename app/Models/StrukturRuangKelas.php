<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrukturRuangKelas extends Model
{
    protected $fillable = [
        'id_rk','nomor_user','jabatan','status'
    ];
    public function ruangkelas(){
        return $this->belongsTo(RuangKelas::class, 'id_rk', 'id');
    }
    public function profilsiswa(){
        return $this->belongsTo(ProfilSiswa::class, 'nomor_user', 'nomor_user');
    }
    
}
