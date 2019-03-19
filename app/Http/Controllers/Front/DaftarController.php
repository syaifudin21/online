<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAjaran;
use App\Models\ProfilSiswa;
use Illuminate\Support\Facades\Storage;
use App\Models\Images;
use Validator;
use Session;

class DaftarController extends Controller
{
    public function daftar()
    {
        $tahun = date("Y");
        $tampiltahun = [$tahun, $tahun-1, $tahun-2, $tahun-3, $tahun-5];
        $ta = TahunAjaran::where('status', 'Show')->orderBy('id','DESC')->first();
        $jurusans = $ta->ruangKelas()->join('kelas', 'ruang_kelas.id_kelas','=','kelas.id')
                    ->where('kelas.jenis', 'Pertama')
                    ->select('jurusan')
                    ->groupBy('jurusan')
                    ->get();
        return view('front.siswa-daftar', compact('tampiltahun', 'jurusans'));
    }
    public function storedaftar(Request $request)
    {
        $messages = [
            'fotosiswa.max' => 'Kapasitas Foto melebihi batas maksimal, Kapasitas maksimal 2mb',
            'fotosiswa.mimes' => 'Format Foto Harus Jpg/Jpeg/Gif',
            'fotoijazah.max' => 'Kapasitas Ijazah/Bukti Lulus melebihi batas maksimal, Kapasitas maksimal 2mb',
            'fotoijazah.mimes' => 'Format Ijazah/Bukti Lulus Harus Jpg/Jpeg/Gif',
        ];
        

        $validator = Validator::make($request->all(), [
            'fotosiswa' => 'image|mimes:jpg,png,jpeg|max:2048',
            'fotoijazah' => 'image|mimes:jpg,png,jpeg|max:2048'
        ], $messages);

        if ($validator->fails()) {
            return redirect('daftar')
                        ->withErrors($validator)
                        ->with(['alert'=> "'title':'Gagal Mendaftar','text':'Periksa kembali data inputan anda', 'icon':'error'"])
                        ->withInput();
        }

        $images = new Images();

        $ta = TahunAjaran::where('status', 'Show')->orderBy('id','DESC')->select('id')->first();
        $profil = new ProfilSiswa();
        $profil['id_ta'] = $ta->id;
        $profil['nisn'] = $request->nisn;
        $profil['ttl'] = json_encode(['tempat' => $request->tempatlahir, 'tgl'=> $request->tanggallahir]);
        $profil['nama'] = $request->nama;
        $profil['alamat'] = $request->alamatsiswa;
        $profil['nomor_hp'] = $request->hpsiswa;
        $ayah = [
            'nama' => $request->namaayah,
            'pekerjaan' => $request->pekerjaanayah,
            'pendidikan' => $request->pendidikanayah,
            'tempat_lahir' => $request->tempatlahirayah,
            'tgl_lahir' => $request->tanggallahirayah,
            'ket' => $request->ketayah
        ];
        $ibu= [
            'nama' => $request->namaibu,
            'pekerjaan' => $request->pekerjaanibu,
            'pendidikan' => $request->pendidikanibu,
            'tempat_lahir' => $request->tempatlahiribu,
            'tgl_lahir' => $request->tanggallahiribu,
            'ket' => $request->ketibu
        ];
        $sekolah =[
            'nama' => $request->sekolah_asal,
            'alamat' => $request->sekolah_alamat,
            'angkatan' => $request->sekolah_angkatan
        ];
        $kettambah = [
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'transportasi' => $request->transportasi,
            'jaraktempu' => $request->jaraktempu,
            'waktutempu' => $request->waktutempu,
        ];
        $pendaftaran = [
            'waktu_daftar' =>  date("Y-m-d H:i:s"),
            'minat_jurusan' => $request->minat
        ];
        $profil['alamat'] = $request->alamat;
        $profil['ayah'] = json_encode($ayah);
        $profil['ibu'] = json_encode($ibu);
        $profil['keluarga'] = json_encode(['alamat' => $request->alamatortu, 'hportu'=> $request->hportu]);
        $profil['foto'] = json_encode(['foto' => $request->fotosiswa, 'ijazah'=>  $request->ijazah]);
        $profil['sekolah_asal'] = json_encode($sekolah);
        $profil['ket_tambahan'] = json_encode($kettambah);
        $profil['pendaftaran'] = json_encode($pendaftaran);

        $foto = [];
        if ($request->hasFile('fotosiswa')){
            $foto['foto'] = $images->upload($request->file('fotosiswa'), 'siswa/foto');;
        }
        if ($request->hasFile('fotoijazah')){
            $foto['ijazah'] = $images->upload($request->file('fotoijazah'), 'siswa/ijazah');;
        }
        $profil['foto'] = json_encode($foto);

        $profil->save();
        $profil->update(['nomor_user'=>$profil->createNoUser($profil->id)]);
        Session::put('nomor_user', $profil->nomor_user);

        return redirect('/cek?nomor='.$profil->nomor_user)
        ->with(['alert'=> "'title':'Selamat','text':'Pendaftaran anda telah kami terima, silahkan melakukan mengkonfirmasi data anda ke sekertariat', 'icon':'success'"]);

    }
    public function cekdaftar()
    {
        $nomor = (!empty($_GET['nomor']))? trim($_GET['nomor']) : '00';
        $profil = ProfilSiswa::where('nomor_user', $nomor)
                    ->where('status','!=','Diterima')
                    ->first();
        return view('front.cek', compact('profil'));
    }
}
