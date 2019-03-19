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
        <div class="col-md-8">
            <div class="tile">
                <h3 class="tile-title">Tahun Ajaran {{$ta->tahun_ajaran}}

                    <div class="btn-group float-right" role="group" aria-label="Basic example">
                        <a class="btn btn-primary mr-1 mb-1 btn-sm" href="{{route('superadmin.rk.create', ['id_ta'=> $ta->id])}}">
                            <i class="fa fa-plus"></i>Tambah</a> </div>
                </h3>
                <div class="bs-component">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Ruang Kelas</th>
                                <th class="text-center">Jurusan</th>
                                <th>Tingkat Kelas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ta->ruangKelas()->orderBy('id_kelas', 'ASC')->get() as $rk)
                            <tr>
                                <td><b>{{$rk->ruang_kelas}}</b></td>
                                <td class="text-center">{{$rk->jurusan}}</td>
                                <td>{{$rk->kelas->kelas}} <small>({{$rk->kelas->jenis}})</small></td>
                                <td>
                                    <a class="card-link" href="{{route('superadmin.rk.show', ['id'=> $rk->id])}}">Detail</a>
                                    <a class="card-link" href="{{route('superadmin.rk.edit', ['id'=>$rk->id])}}">Edit</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            <div class="tile">
                    <h3 class="tile-title">Calon Siswa</h3>
            <div class="tile-body">Daftar calon siswa, untuk konfirmasi pendaftaran silahkan masuk disini</div>
                    <div class="tile-footer">
                    <a class="btn btn-primary" href="{{route('superadmin.ta.siswa',['id'=>$ta->id])}}">Daftar Calon Siswa</a>
                    </div>
                  </div>
            <div class="tile">
                    <h3 class="tile-title">Test Masuk Calon Siswa</h3>
            <div class="tile-body">Test masuk siswa dilakukan pada {{hari_tanggal($ta->tgl_test, true)}}</div>
                    <div class="tile-footer">
                        <a class="btn btn-primary" href="{{route('superadmin.ta.tes.absen',['id'=>$ta->id])}}">Absen Calon Siswa</a>
                        <a class="btn btn-primary" href="{{route('superadmin.ta.tes.nilai',['id'=>$ta->id])}}">Input Nilai Siswa</a>
                    </div>
                  </div>
            <div class="tile">
                    <h3 class="tile-title">Daftar Ulang Siswa</h3>
                    <div class="tile-body">Test masuk siswa dilakukan pada {{hari_tanggal($ta->tgl_test, true)}}</div>
                    <div class="tile-footer">
                        <a class="btn btn-primary" href="{{route('superadmin.ta.daftarulang',['id'=>$ta->id])}}">Daftar Ulang</a>
                    </div>
                  </div>
        </a>
        </div>

        <div class="col-md-4">
            <div class="tile">
                <h3 class="tile-title">{{$ta->tahun_ajaran}}</h3>
                <hr>
                <div class="bs-component">

                    <table class="table">
                        <tr>
                            <td>Tanggal Pendaftaran</td>
                            <td>{{hari_tanggal($ta->tgl_pendaftaran, true)}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Test</td>
                            <td>{{hari_tanggal($ta->tgl_test, true)}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pengumuman</td>
                            <td>{{hari_tanggal($ta->tgl_pengumuman, true)}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Daftar Ulang</td>
                            <td>{{hari_tanggal($ta->tgl_daftar_ulang, true)}}</td>
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
                            <td>
                                <div class="toggle-flip">
                                <label>
                                    <input type="checkbox"  onchange="statusta('{{$ta->id}}')" {{($ta->status == 'Show')? 'checked' : '' }}  ><span class="flip-indecator" data-toggle-on="Show" data-toggle-off="Hidden"></span>
                                </label>
                                </div>    
                            </td>
                        </tr>
                    </table>
                    <a class="btn btn-outline-secondary btn-sm" href="{{route('superadmin.ta.edit', ['id'=>$ta->id])}}"><i
                            class="fa fa-pencil-square-o"></i>Edit</a>
                            
                    <button type="button" class="btn btn-outline-danger btn-sm float-right" id="hapus" data-url="{{route('superadmin.ta.delete', ['id'=>$ta->id])}}"
                        data-redirect="{{ route('superadmin.ta.home')}}" data-pesan="Apakah anda yakin ingin menghapus {{$ta->tahun_ajaran}}"><i class="fa fa-exclamation-triangle"></i>Hapus</button>
                </div>
            </div>

        </div>
    </div>
</main>

@endsection

@section('script')
<script src="{{asset('js/hapus.js')}}"></script>
<script>
    function statusta(no) {
        $.get('{{ route('data.ta.switch')}}?id='+no);
    }
</script>
@endsection
