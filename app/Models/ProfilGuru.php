<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilGuru extends Model
{
    protected $fillable = [
        'nomor_user','nama','tgl', 'jk', 'nim', 'agama', 'alamat', 'transportasi', 'nomor_hp', 'nama_ayah','nama_ibu', 'alamat_ortu', 'keterangan_ayah', 'keterangan_ibu', 'foto', 'ijazah', 'lulusan'
    ];
}
