@extends('front.search-template')
@section('css')
@endsection
@section('content')

<div class="row">
    <div class="col-md-9">
        @if(empty($_GET['nisn']))
        Silahkan masukkan NISN pada form diatas
        @elseif(!empty($hadirs) && count($hadirs)!= 0)
        <table class="table table-sm">
         <thead>
            <tr>
                <th>Tanggal</th>
                <th>Masuk 1</th>
                <th>Keluar 1</th>
                <th>Masuk 2</th>
                <th>Keluar 2</th>
                <th>Keterangan</th>
                <th>Status</th>
            </tr>
        </thead>
          <tbody>
            @foreach($hadirs as $hadir)
            <tr>
                <td>{{$hadir->tanggal}}</td>
                <td>{{$hadir->masuk_1}}</td>
                <td>{{$hadir->keluar_1}}</td>
                <td>{{$hadir->masuk_2}}</td>
                <td>{{$hadir->keluar_2}}</td>
                <td>{{(empty($hadir->event))? $hadir->keterangan: $hadir->event}}</td>
                <td>{{(!empty($hadir->id_absen))? 'Terkirim': 'Belum Terkirim'}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        Silahkan masukkan nisn
        @else
        Nomor NISN tidak terdaftar, Silahkan Menghubungi Admin 
        @endif
    </div>
    <div class="col-md-3">
        @if(!empty($user))
        <h3>{{$user->nama}} </h3>
        <p>Keterangan Kehadiran Anda </p>
        <table class="table table-bordered table-sm">
            <tr>
                <td>Hadir</td>
                <td>{{count($hadirs)}}</td>
            </tr>
            <tr>
                <td>Izin</td>
                <td>{{count($hadirs)}}</td>
            </tr>
            <tr>
                <td>Sakit</td>
                <td>{{count($hadirs)}}</td>
            </tr>
            <tr>
                <td>Tanpa Keterangan</td>
                <td>{{(!empty($totalhari))?$totalhari->count($hadirs): ''}}</td>
            </tr>
        </table>
        <table class="table">
            @foreach($izins as $izin) 
            <tr>
                <td>{{$izin->izin}}</td>
                <td>{{$izin->mulai}}</td>
                <td>{{$izin->selesai}}</td>
            </tr>
            @endforeach
        </table>
        @endif
    </div>
</div>
    

@endsection
