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
        <h1>Login</h1>
        <hr>
        <form action="{{url('cari')}}" method="get">
            <div class="form-group row">
                <label for="nomor" class="col-sm-4 col-form-label text-md-right">{{ __('Login User') }}</label>

                <div class="col-md-6">
                    <select id="type"class="form-control{{ $errors->has('type') ? ' is-invalid' : '' }}" name="type" value="{{ old('type') }}" required autofocus>
                        <option> Siswa</option>
                        <option> Guru</option>
                    </select>

                    @if ($errors->has('type'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('type') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="nomor" class="col-sm-4 col-form-label text-md-right">{{ __('Nomor User') }}</label>

                <div class="col-md-6">
                    <input id="nomor" type="text" class="form-control{{ $errors->has('nomor') ? ' is-invalid' : '' }}" name="nomor" value="{{ old('nomor') }}" required autofocus>

                    @if ($errors->has('nomor'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('nomor') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="password" class="col-sm-4 col-form-label text-md-right">{{ __('password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autofocus>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Login</button>
                    </div>
                </div>

        <br>
        <a href="{{url('daftar/siswa')}}" class="btn btn-light btn-sm">Siswa Daftar</a>
        <a href="{{url('daftar/siswa')}}" class="btn btn-light btn-sm">Pusat Bantuan</a>
        <button type="submit" class="btn btn-light btn-sm">Lihat Absensi Saya</button>
        </form>
        
        </center>
    </div>
</div>
@endsection

@section('script')

@endsection