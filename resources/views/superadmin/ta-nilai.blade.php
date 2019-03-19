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
                    <form id="submit-form" method="post" action="{{route('superadmin.ta.tes.store')}}">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Pendaftar</th>
                                <th>Nama</th>
                                <th>Ttl</th>
                                <th>Sekolah Asal</th>
                                <th class="text-center">L/P</th>
                                <th>Nilai</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        @csrf
                            @foreach ($siswas as $nomor => $siswa)
                            <?php
                                $ttl = json_decode($siswa->ttl);
                                $sekolah = json_decode($siswa->sekolah_asal);
                                $pendaftaran = json_decode($siswa->pendaftaran);
                            ?>
                            <tr>
                                <td class="text-center">{{isset($_GET['page'])? ($nomor+1)+($_GET['page']*10)-10:$nomor+1}}</td>
                                <td>{{$siswa->nomor_user}}</td>
                                <td><b>{{$siswa->nama}}</b></td>
                                <td>{{$ttl->tempat}}, {{$ttl->tgl}}</td>
                                <td>{{!empty($sekolah)? $sekolah->nama: ''}}</td>
                                <td class="text-center">{{$siswa->jk}}</td>
                                <td>
                                    <input type="hidden" name="idsiswa[]" value="{{$siswa->id}}">
                                <input class="form-control form-control-sm" name="nilai[{{$siswa->id}}]" type="number"  min="40" max="100" style="width: 60px" value="{{empty($pendaftaran->nilai_test)? '': $pendaftaran->nilai_test}}">
                                </td>
                                <td class="text-center">{{empty($pendaftaran->hasil_test)? '': $pendaftaran->hasil_test}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-3">
                                <div class="form-group row">
                                <label class="control-label col-md-8">Nilai Min Kelulusan</label>
                                <div class="col-md-4">
                                    <input class="form-control form-control-sm" id="kkm" name="kkm" type="number" min="40" max="80" placeholder="Nilai" value="{{Session::get('kkm')}}">
                                </div>
                                </div>
                        </div>
                    </div>
                    </form>
                          
                    
					<button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>Store Nilai</button>
                    
                    <a href="" onclick="event.preventDefault();" id="lock" class="btn btn-danger">Lok Nilai dan diumumkan ke siswa</a>
                    {{$siswas->links('pagination.default')}}

                </div>

            </div>
        </div>

    </div>
</main>

@endsection

@section('script')
<script>
$(document).ready(function(){
    $('#lock').click(function(){
      var kkm = $("#kkm").val();
      window.location.href="{{route('superadmin.ta.lock.nilai', ['id'=> $ta->id])}}?kkm="+kkm;
    });   
  });
</script>
@endsection
