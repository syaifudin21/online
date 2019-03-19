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
        <li class="breadcrumb-item"><a href="{{route('superadmin.ta.show',['id' => $rk->id_ta])}}">{{$rk->ta->tahun_ajaran}}</a></li>
            <li class="breadcrumb-item"><a href="#">{{$rk->ruang_kelas}}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <h3 class="tile-title">Tahun Ajaran {{$rk->ruang_kelas}}

                    {{-- <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a class="btn btn-primary mr-1 mb-1 btn-sm" href="{{route('superadmin.rk.create', ['id_ta'=> $ta->id])}}">
                            <i class="fa fa-plus"></i>Tambah</a> </div> --}}
                </h3>
                <div class="bs-component">


                </div>

            </div>
        </div>

        <div class="col-md-4">
            <div class="tile">
                <h3 class="tile-title">{{$rk->ruang_kelas}}</h3>
                <hr>
                <div class="bs-component">
                    <a class="btn btn-outline-secondary btn-sm" href="{{route('superadmin.rk.edit', ['id'=>$rk->id])}}"><i
                            class="fa fa-pencil-square-o"></i>Edit</a>
                    <button type="button" class="btn btn-outline-danger btn-sm float-right" id="hapus" data-url="{{route('superadmin.rk.delete', ['id'=>$rk->id])}}"
                        data-redirect="{{ route('superadmin.ta.show',['id_ta'=> $rk->id_ta])}}" data-pesan="Apakah anda yakin ingin menghapus {{$rk->ruang_kelas}}"><i
                            class="fa fa-exclamation-triangle"></i>Hapus</button>
                </div>
            </div>

        </div>
    </div>
</main>

@endsection

@section('script')
<script src="{{asset('js/hapus.js')}}"></script>
@endsection
