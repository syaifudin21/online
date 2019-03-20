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
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.ta.home')}}">Tahun Ajaran</a></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.ta.show',['id' => $profil->id_ta])}}">{{$profil->ta->tahun_ajaran}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.ta.siswa',['id_ta' => $profil->id_ta])}}">Siswa</a></li>
            <li class="breadcrumb-item"><a href="#">Siswa Edit</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Profil Siswa

                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                                <a class="btn btn-primary mr-1 mb-1 btn-sm" href="{{route('superadmin.ta.siswa', ['id_ta'=> $profil->id_ta])}}">
                                    <i class="fa fa-arrow-left "></i>Kembali</a> </div>
                </h3>
                <div class="bs-component">
                        <?php
                        if ($profil->status == 'Daftar') {
                            $progres = 40;
                        }elseif ($profil->status == 'Verifikasi Admin') {
                            $progres = 70;
                        }else{
                            $progres = 100;
                        }
                    ?>
                    Progress Pendaftaran Siswa
                        <div class="progress">
                        <div class="progress-bar" role="progressbar" style="width: {{$progres}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">{{$progres}}%</div>
                        </div>
                        <small>Status </small> <strong>{{$profil->status}}</strong>
                    <br><br>
                   
                    <?php 
                                $ttl = json_decode($profil->ttl);
                                $ayah = json_decode($profil->ayah);
                                $ibu = json_decode($profil->ibu);
                                $sekolah_asal = json_decode($profil->sekolah_asal);
                                $pendaftaran = json_decode($profil->pendaftaran);
                                $keluarga = json_decode($profil->keluarga);
                                $ket_tambahan = json_decode($profil->ket_tambahan);
                                ?>
                    <table class="table table-sm">
                        <tr>
                            <td>Nomor Pendaftaran</td>
                            <td>{{$profil->nomor_user}}</td>
                        </tr>
                        <tr>
                            <td>NISN</td>
                            <td>{{$profil->nisn}}</td>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>{{$profil->nama}}</td>
                        </tr>
                        <tr>
                            <td>TTL</td>
                            <td>{{$ttl->tempat}}, {{hari_tanggal($ttl->tgl)}}</td>
                        </tr>
                        <tr>
                            <td>L/P</td>
                            <td>{{$profil->jk}}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td>{{$profil->agama}}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>{{$profil->alamat}}</td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>{{$profil->nomor_hp}}</td>
                        </tr>
                        <tr>
                            <td>Ayah</td>
                            <td>
                                {{$ayah->nama}} {{empty($ayah->tgl_lahir)?'': '('.$profil->umur($ayah->tgl_lahir).')'}} -
                                {{$ayah->ket}}
                                {!!empty($ayah->tempat_lahir)?'': ' <br>'.$ayah->tempat_lahir!!}
                                {!!empty($ayah->tgl_lahir)?'': ', '.hari_tanggal($ayah->tgl_lahir)!!}
                                {!!empty($ayah->pekerjaan)?'': ' <br> Pekerjaan '.$ayah->pekerjaan!!}
                                {!!empty($ayah->pendidikan)?'': ' <br> Pendidikan Terakhir '.$ayah->pendidikan!!}
                                {!!empty($ayah->penghasilan)?'': ', <br>Penghasilan '.$ayah->penghasilan!!}
                            </td>
                        </tr>
                        <tr>
                            <td>Ibu</td>
                            <td>
                                {{$ibu->nama}} {{empty($ibu->tgl_lahir)?'': '('.$profil->umur($ibu->tgl_lahir).')'}} -
                                {{$ibu->ket}}
                                {!!empty($ibu->tempat_lahir)?'': ' <br>'.$ibu->tempat_lahir!!}
                                {!!empty($ibu->tgl_lahir)?'': ', '.hari_tanggal($ibu->tgl_lahir)!!}
                                {!!empty($ibu->pekerjaan)?'': ' <br> Pekerjaan '.$ibu->pekerjaan!!}
                                {!!empty($ibu->pendidikan)?'': ' <br> Pendidikan Terakhir '.$ibu->pendidikan!!}
                                {!!empty($ibu->penghasilan)?'': ', <br>Penghasilan '.$ibu->penghasilan!!}
                            </td>
                        </tr>
                        <tr>
                            <td>Keluarga</td>
                            <td>
                                {{empty($keluarga->alamat)?'': $keluarga->alamat}}
                                {{empty($keluarga->hportu)?'': ' - tlp. '.$keluarga->hportu}}
                            </td>
                        </tr>
                        <tr>
                            <td>Sekolah Asal</td>
                            <td>
                                {{empty($sekolah_asal->nama)?'': $sekolah_asal->nama}}
                                {{empty($sekolah_asal->alamat)?'': ' - '. $sekolah_asal->alamat}}
                                {{empty($sekolah_asal->angkatan)?'': ' - '. $sekolah_asal->angkatan}}
                            </td>
                        </tr>
                        <tr>
                            <td>Ket Tambahan</td>
                            <td>
                                {!!empty($ket_tambahan->tinggi)?'': 'Tinggi '.$ket_tambahan->tinggi!!}
                                {!!empty($ket_tambahan->berat)?'': ' Berat Badan '.$ket_tambahan->berat!!}
                                {!!empty($ket_tambahan->transportasi)?'': ' Transportasi '.$ket_tambahan->transportasi!!}
                                {!!empty($ket_tambahan->jaraktempu)?'': ' Jarak Tempu Sekolah
                                '.$ket_tambahan->jaraktempu!!}
                                {!!empty($ket_tambahan->waktutempu)?'': ' Waktu Tempu Sekolah
                                '.$ket_tambahan->waktutempu!!}
                            </td>
                        </tr>
                        <tr>
                            <td>Waktu Pendaftaran</td>
                            <td>{{empty($pendaftaran->waktu_daftar)?'': hari_tanggal_waktu($pendaftaran->waktu_daftar, true)}}</td>
                        </tr>
                        <tr>
                            <td>Minat Jurusan</td>
                            <td>{{empty($pendaftaran->minat_jurusan)? 'Tidak ada jurusan yang dipilih' :implode(', ',$pendaftaran->minat_jurusan)}}</td>
                        </tr>
                      
                    </table>

                </div>

                <div class="col-md-12">
                <a href="{{route('superadmin.siswa.status', ['id'=>$profil->id,'status'=>'Verifikasi Admin'])}}" class="btn btn-primary btn-sm">Konfirmasi Pendaftaran</a>
                <a href="{{route('superadmin.siswa.edit', ['id'=>$profil->id])}}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-pencil-square-o"></i> Edit</a>
                </div>
            </div>
        </div>

    </div>
</main>

@endsection

@section('script')
@endsection
