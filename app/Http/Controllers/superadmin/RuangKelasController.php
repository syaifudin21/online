<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\RuangKelas;
use Illuminate\Support\Facades\Storage;

class RuangKelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function create($id_ta)
    {
        $kurikulums = Kurikulum::all();
        return view('superadmin.rk-tambah', compact('kurikulums', 'id_ta'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'ruang_kelas' => 'required|string|max:255',
        ]);

        $rk = new Ruangkelas();
        $rk->fill($request->all());
        $rk->save();
        if($rk){
            return redirect($request->redirect)
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function edit($id)
    {
        $rk = RuangKelas::findOrFail($id);
        $kurikulums = Kurikulum::all();
        return view('superadmin.rk-edit', compact('rk', 'kurikulums'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'ruang_kelas' => 'required|string|max:255',
            // 'brosur' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $rk = Ruangkelas::findOrFail($request->id);
        $rk->fill($request->all());
        if ($request->hasFile('icon')){
            $filenamewithextension = $request->file('icon')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('icon')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp')->put(env('APP_ENV').'/ta/'.$filenametostorefoto, fopen($request->file('icon'), 'r+'));
            $rk['icon'] = env('APP_ENV').'/ta/'.$filenametostorefoto;
        }
        $rk->save();

        if($rk){
            return redirect($request->redirect)
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function show($id)
    {
        $rk = RuangKelas::findOrFail($id);
        return view('superadmin.rk-id', compact('rk'));
    }
    public function delete($id)
    {
        $rk = RuangKelas::findOrFail($id);
        if (!empty($rk)) {
            $srk = $rk->struktur()->delete();
            $rk->delete();
            return response()->json(['kode'=>'00'], 200);
        }else{
            return response()->json(['kode'=>'01'], 200);
        }
    }
}
