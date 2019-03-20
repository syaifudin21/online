<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'id_kurikulum','kelas','jenis'
    ];

    public function kurikulum(){
        return $this->belongsTo(Kurikulum::class, 'id_kurikulum', 'id');
    }
    public function mapel()
    {
        return $this->hasMany(Mapel::class, 'id_kelas', 'id');
    }
    public function ruangkelas()
    {
        return $this->hasMany(RuangKelas::class, 'id_kelas', 'id');
    }
}
