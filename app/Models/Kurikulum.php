<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    protected $fillable = [
        'kurikulum','jurusan','jenis_mapel'
    ];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_kurikulum', 'id');
    }
}
