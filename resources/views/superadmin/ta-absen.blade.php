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
            <li class="breadcrumb-item"><a href="#">Daftar Hadir Tes Masuk</a></li>
        </ul>
    </div>

    <div class="row">
            <div class="col-md-3">
                <div class="widget-small warning coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                <a href="{{route('superadmin.ta.belumabsen',['id'=>$ta->id])}}" class="text-dark"><h4>Belum Absen</h4></a>
                    <p><b>{{$ta->siswaDaftar()->Where('status', 'Verifikasi Admin')->count()}}</b></p>
                </div>
            </div>
            </div>
            <div class="col-md-3">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                <a href="{{route('superadmin.ta.testtidakhadir',['id'=>$ta->id])}}" class="text-dark"><h4>Tidak Hadir</h4></a>
                <p><b>{{$ta->siswaDaftar()->whereRaw('JSON_EXTRACT(pendaftaran, "$.hadir_test") is null')->count()}}</b></p>
                </div>
            </div>
            </div>
            <div class="col-md-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                <a href="{{route('superadmin.ta.testhadir',['id'=>$ta->id])}}" class="text-dark"><h4>Hadir</h4></a>
                <p><b>{{$ta->siswaDaftar()->whereRaw('JSON_EXTRACT(pendaftaran, "$.hadir_test") is not null')->count()}}</b></p>
                </div>
            </div>
            </div>
            <div class="col-md-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                <a href="{{route('superadmin.ta.tes.absen',['id'=>$ta->id])}}" class="text-dark"><h4>Total Pendaftar</h4></a>
                <p><b>{{$ta->siswaDaftar()->count()}}</b></p>
                </div>
            </div>
            </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Daftar Hadir Test Siswa
                    <div class="btn-group float-right">
                        <a class="btn btn-primary btn-sm" href="{{route('superadmin.ta.show', ['id_ta'=> $ta->id])}}"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </h3>
                <div class="bs-component">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pendaftar</th>
                                <th>Nama</th>
                                <th>Ttl</th>
                                <th>Sekolah Asal</th>
                                <th class="text-center">L/P</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswas as $nomor => $siswa)
                            <?php
                                $ttl = json_decode($siswa->ttl);
                                $sekolah = json_decode($siswa->sekolah_asal);
                            ?>
                            <tr>
                                <td class="text-center">{{isset($_GET['page'])? ($nomor+1)+($_GET['page']*10)-10:$nomor+1}}</td>
                                <td>{{$siswa->nomor_user}}</td>
                                <td><b>{{$siswa->nama}}</b></td>
                                <td>{{$ttl->tempat}}, {{$ttl->tgl}}</td>
                                <td>{{!empty($sekolah)? $sekolah->nama: ''}}</td>
                                <td class="text-center">{{$siswa->jk}}</td>
                                <td>
                                    <div class="toggle-flip">
                                    <label style="display: block; margin-bottom:0px;">
                                        <input type="checkbox"  onchange="absen('{{$siswa->id}}')" {{($siswa->status == 'Hadir Test')? 'checked' : '' }}  ><span class="flip-indecator" data-toggle-on="Hadir" data-toggle-off="?"></span>
                                    </label>
                                    </div>    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$siswas->links('pagination.default')}}

                </div>

            </div>
        </div>

    </div>
</main>

@endsection

@section('script')
<script>
function absen(no) {
    $.get('{{ route('data.ta.absen')}}?id='+no);
}
</script>
@endsection
