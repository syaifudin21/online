<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kurikulum;

class KurikulumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index()
    {
        $kurikulums = Kurikulum::paginate(10);
    	return view('superadmin.kurikulum', compact('kurikulums'));
    }
    public function create()
    {
        return view('superadmin.kurikulum-tambah');
    }
    public function store(Request $request)
    {
        $kurikulum = new Kurikulum();
        $kurikulum['kurikulum'] = $request->kurikulum;
        $kurikulum['jurusan'] =  json_encode($request->jurusan);
        $kurikulum['jenis_mapel'] =  json_encode($request->jenis_mapel);
        $kurikulum->save();

        if($kurikulum){
            return redirect(route('superadmin.kurikulum.home'))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function edit($id_kurikulum)
    {
        $kurikulum = Kurikulum::findOrFail($id_kurikulum);
        return view('superadmin.kurikulum-edit', compact('kurikulum'));
    }
    public function update(Request $request)
    {
        $kurikulum = Kurikulum::findOrFail($request->id);
        $kurikulum['kurikulum'] = $request->kurikulum;
        $kurikulum['jurusan'] =  json_encode($request->jurusan);
        $kurikulum['jenis_mapel'] =  json_encode($request->jenis_mapel);
        $kurikulum->save();

        if($kurikulum){
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
        $kurikulum = Kurikulum::findOrFail($id);
        if (!empty($kurikulum)) {
            foreach ($kurikulum->kelas()->get() as $kelas) {
                foreach ($kelas->mapel()->get() as $mapel) {
                    Bab::where('id_mapel',$mapel->id)->delete();
                }
                $kelas->mapel()->delete();
            }
            $kurikulum->kelas()->delete();
            $kurikulum->delete();
            return response()->json(['kode'=>'00'], 200);
        }else{
            return response()->json(['kode'=>'01'], 200);
        }
    }
}
