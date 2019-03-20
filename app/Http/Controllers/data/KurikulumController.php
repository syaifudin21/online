<?php

namespace App\Http\Controllers\data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use App\Models\ProfilSiswa;

class KurikulumController extends Controller
{
    public function switch()
    {
        $ta = TahunAjaran::find($_GET['id']);
        if ($ta->status == 'Show') {
            $ta->update(['status' => 'Hidden']);
            return 'Hidden';
        }else{
            $ta->update(['status' => 'Show']);
            return 'Show';
        }
    }
    public function absen()
    {
        $ta = ProfilSiswa::find($_GET['id']);
        if ($ta->status == 'Hadir Test') {
            $ta['pendaftaran->hadir_test'] = '';
        }else{
            $ta['pendaftaran->hadir_test'] = date("Y-m-d H:i:s");
        }
        $ta->save();
    }
}
