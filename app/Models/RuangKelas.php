<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RuangKelas extends Model
{
    protected $fillable = [
        'id_ta','id_kelas','jurusan','icon','ruang_kelas','deskripsi'
    ];
    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
    public function ta(){
        return $this->belongsTo(TahunAjaran::class, 'id_ta', 'id');
    }
    public function struktur()
    {
        return $this->hasMany(StrukturRuangKelas::class, 'id_rk', 'id');
    }
}
