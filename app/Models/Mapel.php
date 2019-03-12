<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $fillable = [
        'id_kelas','mapel','deskripsi','jenis'
    ];

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
    public function bab()
    {
        return $this->hasMany(Bab::class, 'id_mapel', 'id');
    }
}
