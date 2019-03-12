@extends('front.front-template')
@section('css')
    <style>
        .full-height {
            height: 80vh;
        }
        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }
    </style>
@endsection
@section('content')

<div class="flex-center full-height">
    

    <div class="content">
        <center>
        <h1>PortalSiswa</h1>
        <form action="{{url('cari')}}" method="get">
            <div class="input-group" style="width: 400px"> 
                <div class="input-group-prepend">
                  <div class="input-group-text" id="btnGroupAddon2">@nisn</div>
                </div>
                <input type="text" name="nisn" class="form-control" placeholder="Cek Absen disini" aria-label="Input group example" aria-describedby="btnGroupAddon2">
            </div>

        <br>
        <a href="{{url('daftar')}}" class="btn btn-light btn-sm">Tarik Data dan Sinkron</a>
        <a href="{{url('upload/izin')}}" class="btn btn-light btn-sm">Buat Surat Izin</a>
        <button type="submit" class="btn btn-light btn-sm">Lihat Absensi Saya</button>
        </form>
        
        </center>
    </div>
</div>
@endsection

@section('script')

@endsection