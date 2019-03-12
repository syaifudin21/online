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
            <li class="breadcrumb-item"><a href="{{route('superadmin.kelas.home',['id_kelas'=>$mapel->kelas->kurikulum->id])}}">Kelas</a></li>
            <li class="breadcrumb-item"><a href="{{route('superadmin.mapel.home',['id_mapel'=>$mapel->kelas->id])}}">Mata
                    Pelajaran</a></li>
            <li class="breadcrumb-item"><a href="#">Bab</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <h3 class="tile-title">Bab {{$mapel->mapel}}

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a class="btn btn-primary mr-1 mb-1 btn-sm" href="{{route('superadmin.bab.create', ['id_mapel'=> $mapel->id])}}"><i
                                class="fa fa-plus"></i>Tambah</a>
                    </div>
                </h3>

                <div class="bs-component">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Bab</th>
                                <th>Topik</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($babs as $bab)
                            <tr>
                                <td><b>{{$bab->bab}}</b> <br><small>{{$bab->deskripsi}}</small>
                                    <br><br>
                                    <a class="btn btn-outline-secondary btn-sm" href="{{route('superadmin.bab.edit',['id_bab'=>$bab->id])}}"><i class="fa fa-pencil-square-o"></i> Edit</a>

                                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="hapus('{{route('superadmin.bab.delete', ['id'=>$bab->id])}}','Apakah anda yakin menghapus Bab {{$bab->bab}}')"><i class="fa fa-exclamation-triangle"></i>Hapus</button>
                                    <br><br>
                                </td>
                                <td>
                                    <ol type="1" style="padding-left:20px">
                                        @foreach (json_decode($bab->topik) as $topik)
                                        <li><b>{{$topik}}</b></li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td>

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
                <h3 class="tile-title">{{$mapel->mapel}}</h3>
                <hr>
                <div class="bs-component">
                    <p>{{$mapel->deskripsi}}</p><br>
                    <b>Jenis Matapelajran</b><br><br>
                    <ul class="list-group">
                        <li class="list-group-item">{{$mapel->jenis}}</li>
                    </ul>
                    <hr>
                    <a class="btn btn-outline-secondary btn-sm" href="{{route('superadmin.mapel.edit', ['id'=>$mapel->id])}}"><i  class="fa fa-pencil-square-o"></i>Edit</a>
                    <button type="button" class="btn btn-outline-danger btn-sm float-right" id="hapus" data-url="{{route('superadmin.mapel.delete', ['id'=>$mapel->id])}}" data-redirect="{{ route('superadmin.mapel.home', ['id_kelas'=>$mapel->id_kelas])}}" data-pesan="Apakah anda yakin ingin menghapus {{$mapel->mapel}}"><i class="fa fa-exclamation-triangle"></i>Hapus</button>
                </div>
            </div>

        </div>
    </div>
</main>

@endsection

@section('script')
<script src="{{asset('js/hapus.js')}}"></script>
<script src="{{asset('js/hapusfunc.js')}}"></script>
@endsection
