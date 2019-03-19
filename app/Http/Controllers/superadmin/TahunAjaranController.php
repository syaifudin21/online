<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use Illuminate\Support\Facades\Storage;
use App\Models\Kelas;
use App\Models\ProfilSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;
use Session;

class TahunAjaranController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function index()
    {
        $tas = TahunAjaran::orderBy('id','DESC')->paginate(3);
    	return view('superadmin.ta', compact('tas'));
    }
    public function create()
    {
        return view('superadmin.ta-tambah');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'tahun_ajaran' => 'required|string|max:255',
            'jadwal' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'brosur' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $ta = new TahunAjaran();
        $ta->fill($request->all());
        if ($request->hasFile('jadwal')){
            $filenamewithextension = $request->file('jadwal')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('jadwal')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp')->put(env('APP_ENV').'/ta/'.$filenametostorefoto, fopen($request->file('jadwal'), 'r+'));
            $ta['jadwal'] = env('APP_ENV').'/ta/'.$filenametostorefoto;
        }
        if ($request->hasFile('brosur')){
            $filenamewithextension = $request->file('brosur')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('brosur')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp')->put(env('APP_ENV').'/ta/'.$filenametostorefoto, fopen($request->file('brosur'), 'r+'));
            $ta['brosur'] = env('APP_ENV').'/ta/'.$filenametostorefoto;
        }
        $ta->save();

        dd($ta);
        if($ta){
            return redirect(route('superadmin.ta.home'))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function edit($id_ta)
    {
        $ta = TahunAjaran::findOrFail($id_ta);
        return view('superadmin.ta-edit', compact('ta'));
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'tahun_ajaran' => 'required|string|max:255',
            'jadwal' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'brosur' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $ta = TahunAjaran::findOrFail($request->id);
        $ta->fill($request->all());
        if ($request->hasFile('jadwal')){
            $filenamewithextension = $request->file('jadwal')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('jadwal')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp')->put(env('APP_ENV').'/ta/'.$filenametostorefoto, fopen($request->file('jadwal'), 'r+'));
            $ta['jadwal'] = env('APP_ENV').'/ta/'.$filenametostorefoto;
        }
        if ($request->hasFile('brosur')){
            $filenamewithextension = $request->file('brosur')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('brosur')->getClientOriginalExtension();
            $filenametostorefoto = $filename.'_'.uniqid().'.'.$extension;
            Storage::disk('ftp')->put(env('APP_ENV').'/ta/'.$filenametostorefoto, fopen($request->file('brosur'), 'r+'));
            $ta['brosur'] = env('APP_ENV').'/ta/'.$filenametostorefoto;
        }
        $ta->save();

        if($ta){
            return redirect(route('superadmin.ta.show', ['id'=> $ta->id]))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Menyimpan','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"])
            ->withInput($request->all());
        }
    }
    public function show($id)
    {
        $ta = TahunAjaran::findOrFail($id);
        return view('superadmin.ta-id', compact('ta'));
    }
    public function delete($id)
    {
        $ta = TahunAjaran::findOrFail($id);
        if (!empty($ta)) {
            $ta->ruangkelas()->delete();
            $ta->delete();
            return response()->json(['kode'=>'00'], 200);
        }else{
            return response()->json(['kode'=>'01'], 200);
        }
    }
    public function taSiswa($id)
    {
        $ta = TahunAjaran::findOrFail($id);
        $siswas = $ta->siswaDaftar()->orderBy('nomor_user', 'ASC')->paginate(10);
        return view('superadmin.ta-siswa', compact('ta', 'siswas'));
    }
    public function absenSiswa($id)
    {
        $ta = TahunAjaran::findOrFail($id);
        $siswas = $ta->siswaDaftar()->orderBy('nomor_user', 'ASC')
                ->where('status', 'Verifikasi Admin')
                ->orWhere('status', 'Hadir Test')
                ->orWhere('status', 'Absen Test')
                ->paginate(10);
        return view('superadmin.ta-absen', compact('ta', 'siswas'));
    }
    
    public function nilaiSiswa($id)
    {
        $ta = TahunAjaran::findOrFail($id);
        $siswas = $ta->siswaDaftar()->orderBy('nomor_user', 'ASC')
                ->Where('status', 'Hadir Test')
                ->orWhere('status', 'Daftar Ulang')
                ->orWhere('status', 'Gagal')
                ->paginate(10);
        return view('superadmin.ta-nilai', compact('ta', 'siswas'));
    }
    public function nilaiStore(Request $request)
    {
        foreach ($request->idsiswa as $siswa) {
            if ($request->nilai[$siswa] != null) {
                $profil = ProfilSiswa::find($siswa);
                $profil['pendaftaran->nilai_test'] = $request->nilai[$siswa];
                if ($request->nilai[$siswa] >= $request->kkm) {
                    $profil['pendaftaran->hasil_test'] = 'Lolos Tes';
                }else{
                    $profil['pendaftaran->hasil_test'] =  'Tidak Lolos Tes';
                }
                $profil->save();
            }
        }
        Session::put('kkm', $request->kkm);
        return back()
        ->with(['alert'=> "'title':'Berhasil','text':'Nilai Berhasil Disimpan', 'icon':'success','buttons': false, 'timer': 1200"]);
    }
    public function loknilai($idta)
    {
        $ta = TahunAjaran::findOrFail($idta);
        $siswas = $ta->siswaDaftar()->orderBy('nomor_user', 'ASC')
                ->Where('status', 'Hadir Test')
                ->get();

        foreach ($siswas as $siswa) {
            $pendaftaran = json_decode($siswa->pendaftaran);
            if (!empty($pendaftaran->nilai_test)) {
                $profil = ProfilSiswa::find($siswa->id);
                if ($pendaftaran->nilai_test >= $_GET['kkm']) {
                    $profil['pendaftaran->hasil_test'] = 'Lolos Tes';
                    $profil['status'] = 'Diterima';
                }else{
                    $profil['pendaftaran->hasil_test'] =  'Tidak Lolos Tes';
                    $profil['status'] = 'Tidak Lolos';
                }
                $profil->save();
            }
        }
        Session::put('kkm', $_GET['kkm']);
        return back()
        ->with(['alert'=> "'title':'Berhasil','text':'Nilai Berhasil Diumumkan ke Calon Siswa', 'icon':'success','buttons': false, 'timer': 1200"]);
    }
    public function daftarUlang($idta)
    {
        $ta = TahunAjaran::findOrFail($idta);
        $siswas = $ta->siswaDaftar()->orderBy('nomor_user', 'ASC')
                ->Where('status', 'Diterima')
                ->get();
        return view('superadmin.ta-daftarulang', compact('ta', 'siswas'));
    }
    public function storeDaftarUlang(Request $request)
    {
        $siswa = ProfilSiswa::find($request->id);
        if (!empty(json_decode($siswa->pendaftaran)->daftar_ulang)) {
            $siswa['pendaftaran->daftar_ulang'] = '';
        }else{
            $siswa['pendaftaran->daftar_ulang'] = date("Y-m-d H:i:s");
        }
        $siswa->save();
        if ($siswa) {
            $user = new Siswa();
            $user['nama'] = $siswa->nama;
            $user['username'] = $siswa->nisn;
            $user['nomor_user'] = $siswa->nomor_user;
            $user['password'] = Hash::make($siswa->nisn);
            $user->save();
            if ($user) {
                return response()->json(['kode' => '00'], 200);
            }else{
                return response()->json(['kode' => '02'], 300);
            }
        }else{
            return response()->json(['kode' => '01'], 400);

        }
    }
   
}
