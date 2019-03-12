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
        <h1>Login Admin</h1>
        <hr>
        <form action="{{route('admin.login')}}" method="post">
            @csrf
            <div class="form-group row">
                <label for="username" class="col-sm-4 col-form-label text-md-right">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="nomor" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" required autofocus>

                    @if ($errors->has('username'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('username') }}</strong>
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
        <a href="{{url('admin')}}" class="btn btn-light btn-sm">Login Sebagai Admin</a>
        <a href="{{url('lgoin')}}" class="btn btn-light btn-sm">Login Siswa / Guru</a>
        </form>
        
        </center>
    </div>
</div>
@endsection

@section('script')

@endsection