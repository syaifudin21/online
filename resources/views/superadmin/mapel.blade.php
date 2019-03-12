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
            <li class="breadcrumb-item"><a href="{{route('superadmin.kelas.home',['id_kelas'=>$kelas->kurikulum->id])}}">Kelas</a></li>
            <li class="breadcrumb-item"><a href="#">Mata Pelajaran</a></li>
        </ul>
    </div>

    <div class="row">
            <div class="col-md-8">
                <div class="tile">
                    <h3 class="tile-title">Daftar Mata Pelajaran {{$kelas->kelas}}
    
                        <div class="btn-group float-right" role="group" aria-label="Basic example">
                            <a class="btn btn-primary mr-1 mb-1 btn-sm" href="{{route('superadmin.mapel.create', ['id_kelas'=> $kelas->id])}}"><i
                                    class="fa fa-plus"></i>Tambah</a>
                        </div>
                    </h3>
    
                    <div class="bs-component">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Mapel</th>
                                    <th>Bab</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mapels as $mapel)
                                <tr>
                                    <td><b>{{$mapel->mapel}}</b> <br><small>{{$mapel->deskripsi}}</small>
                                        <br><br>
                                        <a class="btn btn-outline-primary btn-sm" href="{{route('superadmin.bab.home', ['id_mapel'=> $mapel->id])}}"><i class="fa fa-arrow-right" aria-hidden="true"></i> Detail</a>
                                        <a class="btn btn-outline-secondary btn-sm" href="{{route('superadmin.mapel.edit', ['id_mapel'=>$mapel->id])}}"><i class="fa fa-pencil-square-o"></i> Edit</a>
                                        <br><br>
                                    </td>
                                    <td>
                                        <ol type="1" style="padding-left:20px">
                                            @foreach ($mapel->bab()->get() as $bab)
                                            <li><b>{{$bab->bab}}</b></li>
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
                    <h3 class="tile-title">{{$kelas->kelas}}</h3>
                    <hr>
                    <div class="bs-component">
                        <b>Jenis Kelas</b><br><br>
                        <ul class="list-group">
                            <li class="list-group-item">{{$kelas->jenis}}</li>
                        </ul>
                        <hr>
                        <a class="btn btn-outline-secondary btn-sm" href="{{route('superadmin.kelas.edit', ['id'=>$kelas->id])}}"><i class="fa fa-pencil-square-o"></i>Edit</a>
                        <button type="button" class="btn btn-outline-danger btn-sm float-right" id="hapus" data-url="{{route('superadmin.kelas.delete', ['id'=>$kelas->id])}}"  data-redirect="{{ route('superadmin.kelas.home',['id_kelas'=> $kelas->id_kurikulum])}}" data-pesan="Apakah anda yakin ingin menghapus {{$kelas->kelas}}"><i class="fa fa-exclamation-triangle"></i>Hapus</button>
                    </div>
                </div>
    
            </div>
        </div>
    
</main>

@endsection

@section('script')
<script src="{{asset('js/hapus.js')}}"></script>
@endsection
