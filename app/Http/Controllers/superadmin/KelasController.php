<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\Kelas;
use App\Models\Bab;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index($id_kurikulum)
    {
        $kurikulum = Kurikulum::findOrfail($id_kurikulum);
        $kelass = Kelas::where('id_kurikulum', $id_kurikulum)->get();
    	return view('superadmin.kelas', compact('kurikulum','kelass'));
    }
    public function create($id_kurikulum)
    {
        $kurikulum = Kurikulum::findOrfail($id_kurikulum);
        return view('superadmin.kelas-tambah', compact('kurikulum'));
    }
    public function store(Request $request, $id_kurikulum)
    {
        $kelas = new Kelas();
        $kelas->fill($request->all());
        $kelas['id_kurikulum'] = $id_kurikulum;
        $kelas->save();

        if($kelas){
            return redirect(route('superadmin.kelas.home', ['id_kurikulum'=> $id_kurikulum]))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function edit($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        return view('superadmin.kelas-edit', compact('kelas'));
    }
    public function update(Request $request)
    {
        $kelas = Kelas::findOrFail($request->id);
        $kelas->fill($request->all());
        $kelas->save();

        if($kelas){
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
        $kelas = Kelas::findOrFail($id);
        if (!empty($kelas)) {
            foreach ($kelas->mapel()->get() as $mapel) {
                Bab::where('id_mapel',$mapel->id)->delete();
            }
            $kelas->mapel()->delete();
            $kelas->delete();
            return response()->json(['kode'=>'00'], 200);
        }else{
            return response()->json(['kode'=>'01'], 200);
        }
    }
}
