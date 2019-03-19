<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="{{asset(env('APP_LOGO'))}}">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style type="text/css">
        .material-icons {
            align-items: center;
            display: flex;
            justify-content: center;
        }

    </style>
</head>

<body style="background-color: white">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <b>{{env('SEKOLAH_NAMA')}}</b>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->

                <form action="{{url('/cek')}}" class="form-inline my-2 my-lg-0">
                    <div class="input-group" style="width: 600px">
                        <input type="text" name="nomor" class="form-control" placeholder="Masukkan nomor Pendaftaran anda disini" aria-label="Input group example"
                            aria-describedby="btnGroupAddon2" value="{{(empty($_GET['nisn']))? '': $_GET['nisn']}}">
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <br>
    <div class="container">

        <div class="row">
            <div class="col-md-9">
                @if(empty($_GET['nomor']))
                Silahkan masukkan Nomor Pendaftaran pada form diatas
                @elseif(!empty($profil))
                <?php
                    if ($profil->status == 'Daftar') {
                        $progres = 40;
                    }elseif ($profil->status == 'Verifikasi Admin') {
                        $progres = 70;
                    }else{
                        $progres = 100;
                    }
                ?>
                Progress pendaftaran anda
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
                            <td>{{empty($pendaftaran->waktu_daftar)?'': hari_tanggal($pendaftaran->waktu_daftar, true)}}</td>
                        </tr>
                        <tr>
                            <td>Minat Jurusan</td>
                            <td>{{empty($pendaftaran->minat_jurusan)? 'Tidak ada jurusan yang dipilih' :implode(', ',$pendaftaran->minat_jurusan)}}</td>
                        </tr>
                      
                    </table>
                @else
                Nomor Pendaftaran tidak terdaftar, Silahkan Menghubungi Admin jika merasa sudah mendaftar
                @endif
            </div>
            <div class="col-md-3">
                @if(!empty($_GET['nomor']) && !empty($profil))
                <div class="{{empty($pendaftaran->waktu_daftar)?'text-black-50': ''}}" style="margin-bottom: 20px">
                        <strong class="mr-auto">1. Pendaftaran Online</strong>
                        {!!empty($pendaftaran->waktu_daftar)?'': '<small class="text-muted">Sudah dilakukan</small>'!!}
                        <br>
                        Memasukkan / menginputkan biodata siswa lewat online. 
                    </div>
                    <div class="{{empty($pendaftaran->waktu_konfirmasi_admin)?'text-black-50': ''}}">
                            <strong class="mr-auto">2. Konfirmasi Pendaftaran</strong>
                        {!!empty($pendaftaran->waktu_konfirmasi_admin)?'': '<small class="text-muted">Sudah dilakukan</small>'!!}
                        <br>
                        Mengkonfirmasi pendaftaran dengan datang ke sekertariat penerimaann siswa baru. Anda akan menerima kartu pendataran yang digunakan untuk tes masuk.
                    </div>
                    <div class="{{empty($pendaftaran->waktu_test_masuk)?'text-black-50': ''}}" style="margin-bottom: 20px">
                            <strong class="mr-auto">3. Tes Masuk</strong>
                        {!!empty($pendaftaran->waktu_test_masuk)?'': '<small class="text-muted">Sudah dilakukan</small>'!!}
                        <br>
                        Tes uji kemampuan siswa, dilaksanakan ditempat khusus ujian. Dilakukan secara serentak pada <b>{{hari_tanggal($profil->ta->tgl_test, true)}}</b>
                    </div>
                    <div style="margin-bottom: 20px">
                            <strong class="mr-auto">4. Pengumuman </strong>
                        <br>
                    Informasi Hasil tes masuk calon siswa. Dipost pada <b>{{hari_tanggal($profil->ta->tgl_pengumuman, true)}}</b> Pengumuman Bagi calon siswa yang lolos seleksi bisa melakukan daftar ulang. 
                    </div>
                    <div class="{{empty($pendaftaran->waktu_daftar_ulang)?'text-black-50': ''}}" style="margin-bottom: 20px">
                            <strong class="mr-auto">5. Daftar Ulang</strong>
                        {!!empty($pendaftaran->waktu_daftar_ulang)?'': '<small class="text-muted">Sudah dilakukan</small>'!!}
                        <br>
                        Bagi calon siswa yang berahasil lolos dapat melakukan konfirmasi kepada sekertariat sekolah. 
                        <br><br>
                    <div class="{{empty($pendaftaran->waktu_diterima)?'text-black-50': ''}}" style="margin-bottom: 20px">
                        <strong class="mr-auto">6. Selesai</strong>
                    </div>
                </div>
                @endif
        </div>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @if(Session::has('alert'))
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script>
        swal({
          {!!Session::get('alert')!!}
        });
    </script>
    @endif
</body>
</html>
