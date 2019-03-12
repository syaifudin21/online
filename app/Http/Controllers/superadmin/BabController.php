<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Mapel;
use App\Models\Bab;

class BabController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index($id_mepel)
    {
        $mapel = Mapel::findOrfail($id_mepel);
        $babs = Bab::where('id_mapel', $id_mepel)->get();
    	return view('superadmin.bab', compact('babs','mapel'));
    }
    public function create($id_mapel)
    {
        $mapel = Mapel::findOrFail($id_mapel);
        return view('superadmin.bab-tambah', compact('mapel'));
    }
    public function store(Request $request, $id_mapel)
    {
        $bab = new Bab();
        $bab->fill($request->all());
        $bab['id_mapel'] = $id_mapel;
        $bab['topik'] =  json_encode($request->topik);
        $bab->save();

        if($bab){
            return redirect(route('superadmin.bab.home', ['id_mapel'=> $bab->id_mapel]))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function edit($id_bab)
    {
        $bab = Bab::findOrFail($id_bab);
        return view('superadmin.bab-edit', compact('bab'));
    }
    public function update(Request $request)
    {
        $bab = Bab::findOrFail($request->id);
        $bab->fill($request->all());
        $bab['topik'] =  json_encode($request->topik);
        $bab->save();

        if($bab){
            return redirect(route('superadmin.bab.home', ['id_mapel'=> $bab->id_mapel]))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function delete($id_bab)
    {
        $bab = Bab::findOrFail($id_bab);
        if (!empty($bab)) {
            $bab->delete();
            return response()->json(['kode'=>'00'], 200);
        }else{
            return response()->json(['kode'=>'01'], 200);
        }
    }
}
