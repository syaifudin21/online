<?php

namespace App\Http\Controllers\superadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use App\Models\ProfilSiswa;
use App\Models\Images;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    public function show($nomor_user)
    {
        $profil = ProfilSiswa::where('nomor_user', $nomor_user)->first();
        return view('superadmin.siswa-id', compact('profil'));
    }
    public function status($id, $status)
    {
        $user = ProfilSiswa::find($id);
        $user['status'] = 'Verifikasi Admin';
        if ($status == 'Verifikasi Admin') {
            $user['pendaftaran->waktu_konfirmasi_admin'] = date("Y-m-d H:i:s");
        }
        $user->save();
        if($user){
            return redirect(route('superadmin.siswa.show', ['nomor_user'=> $user->nomor_user]))
            ->with(['alert'=> "'title':'Berhasil','text':'Data Berhasil Diupdate', 'icon':'success','buttons': false, 'timer': 1200"]);
        }else{
            return back()
            ->with(['alert'=> "'title':'Gagal Update','text':'Data gagal disimpan, periksa kembali data inputan', 'icon':'error'"]);
        }
    }
    public function edit($id)
    {
        $tahun = date("Y");
        $tampiltahun = [$tahun, $tahun-1, $tahun-2, $tahun-3, $tahun-5];
        $profil = ProfilSiswa::find($id);
        $ta = TahunAjaran::where('status', 'Show')->orderBy('id','DESC')->first();
        $jurusans = $ta->ruangKelas()->join('kelas', 'ruang_kelas.id_kelas','=','kelas.id')
                    ->where('kelas.jenis', 'Pertama')
                    ->select('jurusan')
                    ->groupBy('jurusan')
                    ->get();
        return view('superadmin.siswa-edit', compact('profil', 'tampiltahun', 'ta', 'jurusans'));
    }
    public function update(Request $request)
    {
        $images = new Images();
        $profil = ProfilSiswa::findOrFail($request->id);
        $profil->fill($request->all());
        $profil['nisn'] = $request->nisn;
        $profil['ttl->tempat'] = $request->tempatlahir;
        $profil['ttl->tgl'] = $request->tanggallahir;
        $profil['nama'] = $request->nama;
        $profil['alamat'] = $request->alamatsiswa;
        $profil['nomor_hp'] = $request->hpsiswa;
        $profil['ayah->nama'] = $request->namaayah;
        $profil['ayah->pekerjaan'] = $request->pekerjaanayah;
        $profil['ayah->pendidikan'] = $request->pendidikanayah;
        $profil['ayah->tempat_lahir'] = $request->tempatlahirayah;
        $profil['ayah->tgl_lahir'] = $request->tanggallahirayah;
        $profil['ayah->ket'] = $request->ketayah;
        $profil['ibu->nama'] = $request->namaibu;
        $profil['ibu->pekerjaan'] = $request->pekerjaanibu;
        $profil['ibu->pendidikan'] = $request->pendidikanibu;
        $profil['ibu->tempat_lahir'] = $request->tempatlahiribu;
        $profil['ibu->tgl_lahir'] = $request->tanggallahiribu;
        $profil['ibu->ket'] = $request->ketibu;
        $profil['sekolah_asal->nama'] = $request->sekolah_asal;
        $profil['sekolah_asal->alamat'] = $request->sekolah_alamat;
        $profil['sekolah_asal->angkatan'] = $request->sekolah_angkatan;
        $profil['ket_tambahan->tinggi'] = $request->tinggi;
        $profil['ket_tambahan->berat'] = $request->berat;
        $profil['ket_tambahan->transportasi'] = $request->transportasi;
        $profil['ket_tambahan->jaraktempu'] = $request->jaraktempu;
        $profil['ket_tambahan->waktutempu'] = $request->waktutempu;
        $profil['ket_tambahan->hobi'] = $request->hobi;
        $profil['pendaftaran->minat_jurusan'] = $request->minat;
        $profil['alamat'] = $request->alamat;
        $profil['keluarga->alamat'] = $request->alamatortu;
        $profil['keluarga->hportu'] = $request->hportu;

        if ($request->hasFile('fotosiswa')){
            $profil['foto->foto'] = $images->upload($request->file('fotosiswa'), 'siswa/foto');;
        }
        if ($request->hasFile('fotoijazah')){
            $profil['foto->ijazah'] = $images->upload($request->file('fotoijazah'), 'siswa/ijazah');;
        }
        if ($request->hasFile('fotokps')){
            $profil['foto->kps'] = $images->upload($request->file('fotokps'), 'siswa/kps');;
        }

        $profil->save();

        if($profil){
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
        $siswa = ProfilSiswa::findOrFail($id);
        if (!empty($siswa)) {
            $siswa->delete();
            return response()->json(['kode'=>'00'], 200);
        }else{
            return response()->json(['kode'=>'01'], 200);
        }
    }
}
