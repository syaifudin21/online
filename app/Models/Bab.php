<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    protected $fillable = [
        'id_mapel','bab','deskripsi','topik'
    ];

    public function mapel(){
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }
}
