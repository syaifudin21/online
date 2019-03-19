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
            <li class="breadcrumb-item"><a href="#">Tahun Ajaran</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tahun Ajaran

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a href="{{route('superadmin.ta.create')}}" class="btn btn-outline-info btn-sm">Tambah</a>
                    </div>

                </h3>

                <div class="bs-component">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-columns">
                                @foreach ($tas as $ta)
                                <div class="card {{($ta->status == 'Show')? ' bg-primary' : ''}}">
                                    @if ($ta->brosur)
                                    {{-- <img src="{{env('FTP_BASE').$ta->brosur}}" class="card-img-top" alt="...">
                                    --}}
                                    @endif
                                    <div class="card-body">
                                        <h5 class="card-title">{{$ta->tahun_ajaran}}</h5>

                                        <table class="table">
                                            <tr>
                                                <td>Tanggal Pendaftaran</td>
                                                <td>{{$ta->tgl_pendaftaran}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Test</td>
                                                <td>{{$ta->tgl_test}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Pengumuman</td>
                                                <td>{{$ta->tgl_pengumuman}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Daftar Ulang</td>
                                                <td>{{$ta->tgl_daftar_ulang}}</td>
                                            </tr>
                                            <tr>
                                                <td>Jadwal</td>
                                                <td><a href="{{env('FTP_BASE').$ta->jadwal}}">Jadwal</a></td>
                                            </tr>
                                            <tr>
                                                <td>Brosuer</td>
                                                <td><a href="{{env('FTP_BASE').$ta->brosur}}">Brosur</a></td>
                                            </tr>
                                            <tr>
                                                <td>Status</td>
                                                <td>{{$ta->status}}</td>
                                            </tr>
                                        </table>
                                        <a href="{{route('superadmin.ta.show',['id'=>$ta->id])}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-arrow-right" aria-hidden="true"></i> Lihat Selengkapnya</a>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    {{$tas->links('pagination.default')}}


                </div>

            </div>
        </div>

    </div>
</main>

@endsection

@section('script')

@endsection
