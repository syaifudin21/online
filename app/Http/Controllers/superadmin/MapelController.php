<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Kelas;

class MapelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $mapels = Mapel::where('id_kelas',$id_kelas)->get();
    	return view('superadmin.mapel', compact('mapels', 'kelas'));
    }
    public function create($id_kelas)
    {
        $kelas = Kelas::findOrfail($id_kelas);
        $jenismapels = json_decode($kelas->kurikulum->jenis_mapel);
        return view('superadmin.mapel-tambah', compact('kelas', 'jenismapels'));
    }
    public function store(Request $request, $id_kelas)
    {
        $mapel = new Mapel();
        $mapel->fill($request->all());
        $mapel['id_kelas'] = $id_kelas;
        $mapel->save();
        if($mapel){
            return redirect(route('superadmin.mapel.home', ['id_kelas'=> $id_kelas]))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function edit($id_mapel)
    {
        $mapel = Mapel::findOrFail($id_mapel);
        $jenismapels = json_decode($mapel->kelas->kurikulum->jenis_mapel);
        return view('superadmin.mapel-edit', compact('mapel', 'jenismapels'));
    }
    public function update(Request $request)
    {
        $mapel = Mapel::findOrFail($request->id);
        $mapel->fill($request->all());
        $mapel->save();

        if($mapel){
            return redirect($request->redirect)
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function delete($id)
    {
        $mapel = Mapel::findOrFail($id);
        if (!empty($mapel)) {
            $mapel->bab()->delete();
            $mapel->delete();
            return response()->json(['kode'=>'00'], 200);
        }else{
            return response()->json(['kode'=>'01'], 200);
        }
    }
}
