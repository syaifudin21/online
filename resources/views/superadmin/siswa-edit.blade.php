@extends('superadmin.super-template')
@section('css')

@endsection
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Tahun Ajaran</h1>
            <p>Informasi jumlah siswa dalam satu periode pembelajaran</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
			<div class="tile">
			  <div class="tile-body">
				<form class="form-horizontal"  enctype="multipart/form-data" id="submit-form" method="post" action="{{route('superadmin.siswa.update')}}">
                    @csrf @method('put')
                    <input type="hidden" name="id" value="{{$profil->id}}">
                    <?php 
                        $ttl = json_decode($profil->ttl);
                        $ayah = json_decode($profil->ayah);
                        $ibu = json_decode($profil->ibu);
                        $sekolah_asal = json_decode($profil->sekolah_asal);
                        $pendaftaran = json_decode($profil->pendaftaran);
                        $keluarga = json_decode($profil->keluarga);
                        $ket_tambahan = json_decode($profil->ket_tambahan);
                        $foto = json_decode($profil->foto);
                    ?>
                    <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="nisn">NISN *</label>
                                <input type="number" min="1" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional"
                                    data-error="Harap tidak dikosongkan pada kolom ini" required value="{{( empty(old('nisn')))? $profil->nisn: old('nisn')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama">Nama *</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama"
                                    data-error="Harap tidak dikosongkan pada kolom ini" required value="{{( empty(old('nama')))? $profil->nama: old('nama')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="jk">Gender *</label>
                                <select class="form-control" id="jk" name="jk" data-error="Harap tidak dikosongkan pada kolom ini"
                                    required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki" {{ !empty( old('jk'))? old('jk') == 'Laki-laki' ? 'selected' : '' : $profil->jk == 'Laki-laki' ? 'selected' : ''}}>Laki-Laki</option>
                                    <option value="Perempuan"  {{ !empty( old('jk'))? old('jk') == 'Perempuan' ? 'selected' : '' : $profil->jk == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                                <div class="help-block with-errors text-danger"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tempatlahir">Tempat Lahir *</label>
                                <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" data-error="Harap tidak dikosongkan pada kolom ini"
                                    value="{{( empty(old('tempatlahir')))? $ttl->tempat: old('tempatlahir')}}" placeholder="Tempat Lahir"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggallahir">Tanggal Lahir *</label>
                                <input type="date" class="form-control" id="tanggallahir" placeholder="Tanggal Lahir"
                                    data-error="Harap tidak dikosongkan pada kolom ini" name="tanggallahir" value="{{( empty(old('tanggallahir')))? $ttl->tgl : old('tanggallahir')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="agama">Agama *</label>
                                <select class="form-control" id="agama" name="agama" data-error="Harap tidak dikosongkan pada kolom ini"
                                    required>
                                    <option value="" disabled selected>Pilih Agama </option>
                                    <option value="Islam" {{ !empty( old('agama'))? old('agama') == 'Islam' ? 'selected' : '' : $profil->agama == 'Islam' ? 'selected' : ''}}>Islam</option>
                                    <option value="Protestan" {{ !empty( old('agama'))? old('agama') == 'Protestan' ? 'selected' : '' : $profil->agama == 'Protestan' ? 'selected' : ''}}>Protestan</option>
                                    <option value="Katolik" {{ !empty( old('agama'))? old('agama') == 'Katolik' ? 'selected' : '' : $profil->agama == 'Katolik' ? 'selected' : ''}}>Katolik</option>
                                    <option value="Hindu" {{ !empty( old('agama'))? old('agama') == 'Hindu' ? 'selected' : '' : $profil->agama == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                                    <option value="Budha" {{ !empty( old('agama'))? old('agama') == 'Budha' ? 'selected' : '' : $profil->agama == 'Budha' ? 'selected' : ''}}>Budha</option>
                                    <option value="Kong Hu Cu" {{ !empty( old('agama'))? old('agama') == 'Kong Hu Cu' ? 'selected' : '' : $profil->agama == 'Kong Hu Cu' ? 'selected' : ''}}>Kong Hu Cu</option>
                                </select>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="alamat">Alamat Tempat Tinggal Sekarang *</label>
                                <input type="text" class="form-control" id="alamat" data-error="Harap tidak dikosongkan pada kolom ini"
                                    value="{{( empty(old('alamat')))? $profil->alamat: old('alamat')}}"
                                    name="alamat" placeholder="Alamat (RT RW Dusun Desa Kecamatan Kabupaten)"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hpsiswa">Nomor Hp *</label>
                                <input type="number" class="form-control" id="hpsiswa" name="hpsiswa" placeholder="Nomor HP"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{( empty(old('hpsiswa')))? $profil->nomor_hp: old('hpsiswa')}}"
                                    min="10" required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sekolah_asal">Sekolah Asal *</label>
                                <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" placeholder="Nama Sekolah Asal"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{( empty(old('sekolah_asal')))? empty($sekolah_asal->nama) ? '': $sekolah_asal->nama : old('sekolah_asal')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sekolah_alamat">Alamat Sekolah Asal *</label>
                                <input type="text" class="form-control" id="sekolah_alamat" name="sekolah_alamat" placeholder="Desa Kecamatan Kabupatan"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{( empty(old('sekolah_alamat')))?  empty($sekolah_asal->alamat) ? '': $sekolah_asal->alamat: old('sekolah_alamat')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-2">
                                    <label for="sekolah_angkatan">Tahun Lulus *</label>
                                    <select class="form-control" id="sekolah_angkatan" name="sekolah_angkatan" data-error="Harap tidak dikosongkan pada kolom ini"
                                        required>
                                        <option disable>Tahun Lulus</option>
                                        @foreach($tampiltahun as $th)
                                        <option value="{{$th}}" {{ !empty( old('sekolah_angkatan'))? old('sekolah_angkatan') == 'Islam' ? 'selected' : '' : empty($sekolah_asal->angkatan)? '':$sekolah_asal->angkatan == $th ? 'selected' : ''}}>{{$th}}</option>
                                        @endforeach
                                    </select>
                                    <div class="help-block with-errors text-danger"></div>
                                </div>
                            <div class="form-group col-md-4">
                                <label for="fotosiswa">Foto Siswa *</label>
                                <input type="file" class="form-control" onchange="fotoURl(this)" id="fotosiswa" name="fotosiswa" accept="image/jpeg, image/png" data-error="Harap tidak dikosongkan pada kolom ini" required>
                                <div class="help-block with-errors text-danger"></div>
                                <br>
                                <img class="img-thumbnails" width="80%" id="foto" {!! !empty($foto->foto)? 'src="'.env('FTP_BASE').$foto->foto.'"': '' !!}>

                            </div>
                            <div class="form-group col-md-4">
                                <label for="fotoijazah">Foto Ijazah/Raport *</label>
                                <input type="file" class="form-control" onchange="fileijazah(this)" id="fotoijazah" name="fotoijazah"  accept="image/jpeg, image/png" data-error="Harap tidak dikosongkan pada kolom ini" required>
                                <div class="help-block with-errors text-danger"></div>
                                <br>
                                <img class="img-thumbnails" width="80%" id="ijazah" {!! !empty($foto->ijazah)? 'src="'.env('FTP_BASE').$foto->ijazah.'"': '' !!}>

                            </div>
                            <div class="form-group col-md-4">
                                    <label for="fotokps">Kps</label>
                                    <input type="file" class="form-control" onchange="filekps(this)" id="fotokps" name="fotokps"  accept="image/jpeg, image/png" data-error="Harap tidak dikosongkan pada kolom ini" required>
                                    <div class="help-block with-errors text-danger"></div>
                                    <br>
                                    <img class="img-thumbnails" width="80%" id="kps" {!! !empty($foto->kps)? 'src="'.env('FTP_BASE').$foto->kps.'"': '' !!}>
    
                                </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="namaayah">Nama Ayah *</label>
                                <input type="text" min="1" class="form-control" id="namaayah" name="namaayah"
                                    placeholder="Nama Ayah" data-error="Harap tidak dikosongkan pada kolom ini" value="{{empty(old('namaayah'))? $ayah->nama: old('namaayah')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pekerjaanayah">Pekerjaan Ayah</label>
                                <input type="text" class="form-control" id="pekerjaanayah" placeholder="Pekerjaan Ayah"
                                    name="pekerjaanayah" value="{{empty(old('pekerjaanayah'))? empty($ayah->pekerjaan)? '': $ayah->pekerjaan : old('pekerjaanayah')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pendidikanayah">Pendidikan Terakhir Ayah</label>
                                <input type="text" class="form-control" id="pendidikanayah" placeholder="Pendidikan Terakhir Ayah"
                                    name="pendidikanayah" value="{{empty(old('pendidikanayah'))? empty($ayah->pendidikan)? '': $ayah->pendidikan : old('pendidikanayah')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tempatlahirayah">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatlahirayah" name="tempatlahirayah"
                                    value="{{empty(old('tempatlahirayah'))? empty($ayah->tempat_lahir)? '': $ayah->tempat_lahir : old('tempatlahirayah')}}" placeholder="Tempat Lahir Ayah">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggallahirayah">Tanggal Lahir Ayah</label>
                                <input type="date" class="form-control" id="tanggallahirayah" placeholder="Tanggal Lahir Ayah"
                                    name="tanggallahirayah" value="{{empty(old('tanggallahirayah'))? empty($ayah->tgl_lahir)? '': $ayah->tgl_lahir : old('tanggallahirayah')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="ketayah">Keterangan Ayah</label>
                                <select class="form-control" id="ketayah" name="ketayah">
                                    <option value="Masih Hidup" {{$ayah->ket == 'Masih Hidup'? 'selected' : ''}}>Masih Hidup</option>
                                    <option value="Meninggal" {{$ayah->ket == 'Meninggal'? 'selected' : ''}}>Meninggal</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="namaibu">Nama Ibu *</label>
                                <input type="text" min="1" class="form-control" id="namaibu" name="namaibu" placeholder="Nama Ibu"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{empty(old('namaibu'))? empty($ibu->nama)? '': $ibu->nama : old('namaibu')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pekerjaanibu">Pekerjaan Ibu</label>
                                <input type="text" class="form-control" id="pekerjaanibu" placeholder="Pekerjaan ibu"
                                    name="pekerjaanibu" value="{{empty(old('pekerjaanibu'))? empty($ibu->pekerjaan)? '': $ibu->pekerjaan : old('pekerjaanibu')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pendidikanibu">Pendidikan Terakhir Ibu</label>
                                <input type="text" class="form-control" id="pendidikanibu" placeholder="Pendidikan Terakhir Ibu"
                                    name="pendidikanibu" value="{{empty(old('pendidikanibu'))? empty($ibu->pendidikan)? '': $ibu->pendidikan : old('pendidikanibu')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tempatlahiribu">Tempat Lahir Ibu</label>
                                <input type="text" class="form-control" id="tempatlahiribu" name="tempatlahiribu" value="{{empty(old('tempatlahiribu'))? empty($ibu->tempat_lahir)? '': $ibu->tempat_lahir : old('tempatlahiribu')}}"
                                    placeholder="Tempat Lahir Ibu">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggallahiribu">Tanggal Lahir Ibu</label>
                                <input type="date" class="form-control" id="tanggallahiribu" placeholder="Tanggal Lahir Ibu"
                                    name="tanggallahiribu" value="{{empty(old('tanggallahiribu'))? empty($ibu->tgl_lahir)? '': $ibu->tgl_lahir : old('tanggallahiribu')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="ketibu">Keterangan Ibu</label>
                                <select class="form-control" id="ketibu" name="ketibu">
                                    <option value="Masih Hidup" {{$ibu->ket == 'Masih Hidup' ? 'selected': ''}}>Masih Hidup</option>
                                    <option value="Meninggal" {{$ibu->ket == 'Meninggal' ? 'selected' : ''}}>Meninggal</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="alamatortu">Alamat Tempat Tinggal Orang Tua Sekarang *</label>
                                <input type="text" class="form-control" id="alamatortu" data-error="Harap tidak dikosongkan pada kolom ini"
                                    value="{{empty(old('alamatortu'))? empty($keluarga->alamat)? '': $keluarga->alamat : old('alamatortu')}}"
                                    name="alamatortu" placeholder="Alamat (RT RW Dusun Desa Kecamatan Kabupaten)"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hportu">Nomor Hp Orang Tua *</label>
                                <input type="number" class="form-control" id="hportu" name="hportu" placeholder="Nomor HP Orang Tua"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{empty(old('hportu'))? empty($keluarga->hportu)? '': $keluarga->hportu : old('hportu')}}"
                                    min="10" required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tinggi">Tinggi Badan (cm)</label>
                                <input type="number" min="1" class="form-control" id="tinggi" name="tinggi" placeholder="Tinggi badan" value="{{empty(old('tinggi'))? empty($ket_tambahan->tinggi)? '': $ket_tambahan->tinggi : old('tinggi')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="berat">Berat Badan (kg)</label>
                                <input type="number" min="1" class="form-control" id="berat" name="berat" placeholder="Berat Badan" value="{{empty(old('berat'))? empty($ket_tambahan->berat)? '': $ket_tambahan->berat : old('berat')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hobi">Hobi</label>
                                <input type="text" min="1" class="form-control" id="hobi" name="hobi" placeholder="Hobi"
                                     value="{{empty(old('hobi'))? empty($ket_tambahan->hobi)? '': $ket_tambahan->hobi : old('hobi')}}">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="transportasi">Kendaraan ke Sekolah</label>
                                <select class="form-control" id="transportasi" name="transportasi">
                                    <option value="" selected>Pilih Kendaraan</option>
                                    <option   {{ !empty( old('transportasi'))? old('transportasi') == 'Sepeda Motor' ? 'selected' : '' : $profil->transportasi == 'Sepeda Motor' ? 'selected' : ''}}>Sepeda Motor</option>
                                    <option {{ !empty( old('transportasi'))? old('transportasi') == 'Jalan Kaki' ? 'selected' : '' : $profil->transportasi == 'Jalan Kaki' ? 'selected' : ''}}>Jalan Kaki</option>
                                    <option {{ !empty( old('transportasi'))? old('transportasi') == 'Transportasi Umum' ? 'selected' : '' : $profil->transportasi == 'Transportasi Umum' ? 'selected' : ''}}>Transportasi Umum</option>
                                    <option {{ !empty( old('transportasi'))? old('transportasi') == 'Lainnya' ? 'selected' : '' : $profil->transportasi == 'Lainnya' ? 'selected' : ''}}>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jaraktempu">Jarak Tempu ke Sekolah (Meter)</label>
                                <input type="number" min="1" class="form-control" id="jaraktempu" name="jaraktempu"
                                    placeholder="Jarak Tempu ke Sekolah" value="{{empty(old('jaraktempu'))? empty($ket_tambahan->jaraktempu)? '': $ket_tambahan->jaraktempu : old('jaraktempu')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="waktutempu">Waktu Tempu ke Sekolah (Menit)</label>
                                <input type="number" min="1" class="form-control" id="waktutempu" name="waktutempu"
                                    placeholder="Waktu tempu ke Sekolah" value="{{empty(old('waktutempu'))? empty($ket_tambahan->waktutempu)? '': $ket_tambahan->waktutempu : old('waktutempu')}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12">
                                Jurusan yang dipilih
                                @foreach ($jurusans as $jurusan)
                                <?php
                                    if (!empty(old('minat'))) {
                                        if (array_search($jurusan->jurusan, old('minat')) !== false) {
                                            $stt = 'checked';
                                        }else {
                                            $stt = '';
                                        }
                                    }else{
                                        if (!empty($pendaftaran->minat_jurusan)) {
                                            if (array_search($jurusan->jurusan, $pendaftaran->minat_jurusan) !== false) {
                                                $stt = 'checked';
                                            }else {
                                                $stt = '';
                                            }
                                        }
                                    }
                                ?>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="minat[]" id="{{$jurusan->jurusan}}" class="custom-control-input" value="{{$jurusan->jurusan}}"
                                    {{empty($stt)? '': $stt}}>
                                    <label for="{{$jurusan->jurusan}}" class="custom-control-label">{{$jurusan->jurusan}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
				  <input type="hidden" name="redirect" value="{{url()->previous()}}">
				</form>

			  </div>
			  <div class="tile-footer">
				<div class="row">
				  <div class="col-md-8 col-md-offset-3">
					<button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
					<a class="btn btn-secondary" href="{{url()->previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
				  </div>
				</div>
			  </div>
			</div>
		  </div>

    </div>
</main>

@endsection

@section('script')
<script>
      function fotoURl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#foto').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function fileijazah(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#ijazah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        function filekps(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#kps').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

</script>
@endsection
