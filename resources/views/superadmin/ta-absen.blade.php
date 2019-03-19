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
            <li class="breadcrumb-item"><a href="#">{{$ta->tahun_ajaran}}</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Tahun Ajaran {{$ta->tahun_ajaran}}
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
