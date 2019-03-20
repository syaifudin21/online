@extends('superadmin.super-template')
@section('css')

@endsection
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Tahun Ajaran ({{$ta->tahun_ajaran}})</h1>
            <p>Informasi jumlah siswa dalam satu periode pembelajaran</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.ta.home')}}">Tahun Ajaran</a></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.ta.show',['id' => $ta->id])}}">{{$ta->tahun_ajaran}}</a></li>
            <li class="breadcrumb-item"><a href="#">Penempatan Siswa pada Kelas</a></li>
        </ul>
    </div>

    <div class="row">
        @foreach ($kelass as $kelas)
        <div class="col-md-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
            <a href="{{route('superadmin.rk.show',['id'=> $kelas->id])}}"><h4 style="color: black; text-decoration: none">{{$kelas->jurusan}} - {{$kelas->ruang_kelas}}</h4></a>
            <p><b id="jumlahkelas{{$kelas->id}}">{{$kelas->struktur()->count()}}</b></p>
            </div>
        </div>
        </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Menempatkan pada kelas
                 <div class="btn-group float-right" role="group" aria-label="Basic example">
                                <a class="btn btn-primary mr-1 mb-1 btn-sm" href="{{route('superadmin.ta.show', ['id_ta'=> $ta->id])}}">
                                    <i class="fa fa-arrow-left "></i>Kembali</a> </div>
                </h3>
                <div class="bs-component">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pendaftar</th>
                                <th>Nama</th>
                                <th class="text-center">Pilihan Jurusan</th>
                                <th class="text-center">Nilai Test</th>
                                <th class="text-center">L/P</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $nomor => $siswa)
                            <?php
                                $ttl = json_decode($siswa->ttl);
                                $sekolah = json_decode($siswa->sekolah_asal);
                                $pendaftaran = json_decode($siswa->pendaftaran);
                                $ruangkelas = $siswa->struktur()->where('status', 'Daftar')->select('id_rk')->first();
                            ?>
                            <tr>
                                <td class="text-center">{{isset($_GET['page'])? ($nomor+1)+($_GET['page']*10)-10:$nomor+1}}</td>
                                <td>{{$siswa->nomor_user}}</td>
                                <td><b>{{$siswa->nama}}</b></td>
                                <td class="text-center">{{!empty($pendaftaran->minat_jurusan)? implode(', ',$pendaftaran->minat_jurusan): ''}}</td>
                                <td class="text-center">{{!empty($pendaftaran->nilai_test)? $pendaftaran->nilai_test: ''}}</td>
                                <td class="text-center">{{$siswa->jk}}</td>
                                <td>
                                <select onchange="penempatan({{$siswa->nomor_user}})" id="penempatan{{$siswa->nomor_user}}" class="form-control">
                                        <option disabled selected>Pilih Kelas</option>
                                        @foreach ($kelass as $kelas)
                                            <option value="{{$kelas->id}}" {{$siswa->struktur()->where('id_rk', $kelas->id)->count() >0 ? 'selected' : ''}}>{{$kelas->jurusan}} - {{$kelas->ruang_kelas}}</option>
                                        @endforeach
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- {{$siswas->links('pagination.default')}} --}}
                </div>

            </div>
        </div>

    </div>
</main>

@endsection

@section('script')
<script>
function penempatan(e) {
    var x = document.getElementById("penempatan"+e).value;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: '{{route('superadmin.ta.tempatkan.store')}}',
        type: 'POST',
        dataType: "JSON",
        data: {
            'nomor_user' : e,
            'kelassek' : x
        },
        success: function (response) {
            if (response.kode = '00') {
                swal({
                    title: "Berhasil",
                    text: "Berhasil Konfirmas Daftar Ulang",
                    icon: "success",
                    timer : 1200,
                    buttons: false
                });
                $.each(response.jml, function(index, jml){
                    document.getElementById("jumlahkelas"+jml.id_rk).innerHTML= jml.jumlah;
                });

            } else {
                swal("Kesalahan Jaringan, Coba beberapa saat lagi", {
                    icon: "error",
                });
                console.log(response.message);
            }
        },
        error: function (xhr) {
            console.log(xhr.responseText);
        }
    });
};
</script>
@endsection
