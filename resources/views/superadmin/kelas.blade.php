@extends('superadmin.super-template')
@section('css')

@endsection
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Kurikulum Sekolah</h1>
            <p>Kurikulum standar pendidikan yang dijadikan acuan kelas</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.kurikulum.home')}}">Kurikulum</a></li>
            <li class="breadcrumb-item"><a href="#">Kelas</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <h3 class="tile-title">Daftar Kelas {{$kurikulum->kurikulum}}

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a class="btn btn-primary mr-1 mb-1 btn-sm" href="{{route('superadmin.kelas.create', ['id_kurikulum'=> $kurikulum->id])}}"><i
                                class="fa fa-plus"></i>Tambah</a>
                    </div>
                </h3>

                <div class="bs-component">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Kelas</th>
                                <th>Mata Pelajaran</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelass as $kelas)
                            <tr>
                                <td><b>{{$kelas->kelas}}</b> <br><small>{{$kelas->jenis}}</small></td>
                                <td>
                                    <ol type="1" style="padding-left:20px">
                                        @foreach ($kelas->mapel()->get() as $mapel)
                                        <li><b>{{$mapel->mapel}}</b> <small>({{$mapel->jenis}})</small></li>
                                        {{-- <ul style="padding-left:20px">
                                            @foreach ($mapel->bab()->get() as $bab)
                                            <li>{{$bab->bab}}</li> --}}
                                            {{-- <ul type="disc" style="padding-left:20px">
                                                @foreach (json_decode($bab->topik) as $topik)
                                                <li>{{$topik}}</li>
                                                @endforeach
                                            </ul> --}}
                                            {{-- @endforeach
                                        </ul> --}}
                                        @endforeach
                                    </ol>
                                </td>
                                <td>
                                    <a class="card-link" href="{{route('superadmin.mapel.home', ['id_kelas'=> $kelas->id])}}">Detail</a>
                                    <a class="card-link" href="{{route('superadmin.kelas.edit', ['id_kelas'=>$kelas->id])}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="tile">
                <h3 class="tile-title">{{$kurikulum->kurikulum}}</h3>
                <hr>
                <div class="bs-component">
                    <b>Jurusan</b><br><br>
                    <ul class="list-group">
                        @foreach (json_decode($kurikulum->jurusan) as $jurusan)
                        <li class="list-group-item">{{$jurusan}}</li>
                        @endforeach
                    </ul>
                    <hr>
                    <b>Jenis Mata Pelajaran </b><br><br>
                    <ul class="list-group">
                        @foreach (json_decode($kurikulum->jenis_mapel) as $jenis)
                        <li class="list-group-item">{{$jenis}}</li>
                        @endforeach
                    </ul>

                    <hr>
                    <a class="btn btn-outline-secondary btn-sm" href="{{route('superadmin.kurikulum.edit', ['id'=>$kurikulum->id])}}"><i class="fa fa-pencil-square-o"></i>Edit</a>
                    <button type="button" class="btn btn-outline-danger btn-sm float-right" id="hapus" data-url="{{route('superadmin.kurikulum.delete', ['id'=>$kurikulum->id])}}" data-redirect="{{ route('superadmin.kurikulum.home')}}" data-pesan="Apakah anda yakin ingin menghapus {{$kurikulum->kurikulum}}"><i class="fa fa-exclamation-triangle"></i>Hapus</button>
                </div>
            </div>

        </div>
    </div>
</main>

@endsection

@section('script')
<script src="{{asset('js/hapus.js')}}"></script>
@endsection
