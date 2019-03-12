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
            <li class="breadcrumb-item"><a href="#">Kurikulum</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Kurikulum

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a href="{{route('superadmin.kurikulum.create')}}" class="btn btn-outline-info btn-sm">Tambah</a>
                    </div>

                </h3>

                <div class="bs-component">
                    <div class="row">
                        @foreach ($kurikulums as $kurikulum)
                        <div class="col-md-4">
                            <div class="card mb-3 border-primary">
                                <div class="card-body">
                                    <h3>{{$kurikulum->kurikulum}}</h3>
                                    Jurusan 
                                    @foreach (json_decode($kurikulum->jurusan) as $jurusan)
                                        <b>{{$jurusan}}</b>
                                    @endforeach
                                    <br>
                                    Jenis Mata Pelajaran  
                                    @foreach (json_decode($kurikulum->jenis_mapel) as $jenis)
                                        <b>{{$jenis}}</b>
                                    @endforeach
                                    <br>
                                    <ol type="1">
                                    @foreach ($kurikulum->kelas()->get() as $kelas)
                                        <li>{{$kelas->kelas}} <small>({{$kelas->jenis}})</small></li>
                                    @endforeach
                                    </ol>
                                    <a class="card-link" href="{{route('superadmin.kelas.home', ['id'=>$kurikulum->id])}}">Lihat Sleengkapnya</a>
                                    <a class="card-link" href="{{route('superadmin.kurikulum.edit', ['id'=>$kurikulum->id])}}">Edit</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>


                </div>

            </div>
        </div>

    </div>
</main>

@endsection

@section('script')

@endsection
