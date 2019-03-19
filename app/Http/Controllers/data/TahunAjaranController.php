<?php

namespace App\Http\Controllers\data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Kurikulum;

class TahunAjaranController extends Controller
{
    public function kurikulumkelas()
    {
        $data['kelas'] = Kelas::where('id_kurikulum', $_GET['id_kurikulum'])
                ->select('kelas.id', 'kelas.kelas', 'kelas.jenis')
                ->orderBy('kelas', 'ASC')->get();
        $data['jurusan'] = json_decode(Kurikulum::where('id',$_GET['id_kurikulum'])->select('jurusan')->first()->jurusan);
        return response()->json([
            'data' => $data,
            'kode' => '00' 
        ], 200);
    }
}
