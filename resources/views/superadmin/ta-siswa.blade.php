@extends('superadmin.super-template')
@section('css')

@endsection
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Tahun Ajaran  ({{$ta->tahun_ajaran}})</h1>
            <p>Informasi jumlah siswa dalam satu periode pembelajaran</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.ta.home')}}">Tahun Ajaran</a></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.ta.show',['id' => $ta->id])}}">{{$ta->tahun_ajaran}}</a></li>
            <li class="breadcrumb-item"><a href="#">Calon Siswa</a></li>
        </ul>
    </div>

    <div class="row">
            <div class="col-md-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                <h4>Pendaftar</h4>
                <p><b>{{$ta->siswaDaftar()->count()}}</b></p>
                </div>
            </div>
            </div>
            <div class="col-md-3">
                    <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                        <div class="info">
                        <h4>Laki-laki</h4>
                        <p><b>{{$ta->siswaDaftar()->where('jk','Laki-laki')->count()}}</b></p>
                        </div>
                    </div>
                    </div>
                    <div class="col-md-3">
                            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                                <div class="info">
                                <h4>Perempuan</h4>
                                <p><b>{{$ta->siswaDaftar()->where('jk','Perempuan')->count()}}</b></p>
                                </div>
                            </div>
                            </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Pendaftar / Calon Siswa
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
                                <th>Ttl</th>
                                <th>Sekolah Asal</th>
                                <th class="text-center">L/P</th>
                                <th class="text-center">Status</th>
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
                                <td>{{empty($sekolah->nama)?'': $sekolah->nama}}</td>
                                <td class="text-center">{{$siswa->jk}}</td>
                                <td class="text-center">{{$siswa->status}}</td>
                                <td>
                                    <a class="card-link" href="{{route('superadmin.siswa.show', ['nomor_user'=> $siswa->nomor_user])}}">Detail</a>
                                    @if (env('APP_ENV')== 'development')
                                    <a href="{{route('superadmin.siswa.status', ['id'=>$siswa->id,'status'=>'Verifikasi Admin'])}}" class="card-link">Konfirmasi</a>
                                    @endif
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
@endsection
