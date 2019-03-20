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
                        <div class="btn-group float-right">
                            <a class="btn btn-primary btn-sm" href="{{route('superadmin.ta.show', ['id_ta'=> $rk->id_ta])}}"><i class="fa fa-lg fa-plus"></i> Kembali</a>
                            <a class="btn btn-success btn-sm" href="{{route('superadmin.ta.show', ['id'=> $rk->id_ta])}}"><i class="fa fa-lg fa-edit"></i>Tambah</a>
                        </div>


                </h3>
                <div class="bs-component">
                        <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nomor User</th>
                                        <th>Nama</th>
                                        <th class="text-center">Jabatan</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rk->struktur()->get() as $struktur)
                                    <tr>
                                        <td><b>{{$struktur->nomor_user}}</b></td>
                                        <td><b>{{$struktur->profilsiswa->nama}}</b></td>
                                        <td class="text-center">{{$struktur->jabatan}}</td>
                                        <td>{{$struktur->status}}</td>
                                        <td>
                                            {{-- <a class="card-link" href="{{route('superadmin.rk.show', ['id'=> $rk->id])}}">Detail</a>
                                            <a class="card-link" href="{{route('superadmin.rk.edit', ['id'=>$rk->id])}}">Edit</a> --}}
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
