@extends('superadmin.super-template')
@section('css')

@endsection
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Kurikulum Sekolah</h1>
            <p>Kurikulum standar pendidikan yang dijadikan acuan kelas</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Form Notifications</a></li>
        </ul>
    </div>

    <div class="row">
        <div class="col-md-8">
			<div class="tile">
			  <div class="tile-body">
				<form class="form-horizontal" id="submit-form" method="post" action="{{route('superadmin.kelas.store', ['id_kurikulum'=> $kurikulum->id])}}">
						{{ csrf_field() }}

				  <div class="form-group row">
					<label class="control-label col-md-4" for="kelas">Nama kelas</label>
					<div class="col-md-7">
						<input class="form-control {{ $errors->has('kelas') ? ' is-invalid' : '' }}" type="text" name="kelas" placeholder="Nama Kelas" value="{{old('kelas')}}" aria-describedby="kelas" id="kelas">
						@if ($errors->has('kelas'))
							<small class="form-text text-muted" id="kelas">{{ $errors->first('kelas') }}</small>
						@endif
					</div>
				  </div>

				  <div class="form-group row">
					<label class="control-label col-md-4" for="Jenis Kelas">Jenis Kelas</label>
					<div class="col-md-7">
                        <select name="jenis" class="form-control {{ $errors->has('jenis') ? ' is-invalid' : '' }}">
                            <option disabled selected>Pilih Kelas</option>
                            <option value="Pertama">Pertama (Kelas Pendaftaran)</option>
                            <option value="Menengah">Menengah</option>
                            <option value="Akhir">Akhir (Kelas Akhir)</option>
                        </select>
						@if ($errors->has('jenis'))
							<small class="form-text text-muted" id="jenis">{{ $errors->first('jenis') }}</small>
						@endif
					</div>
				  </div>

				  
				</form>

			  </div>
			  <div class="tile-footer">
				<div class="row">
				  <div class="col-md-8 col-md-offset-3">
					<button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>
					<a class="btn btn-secondary" href="{{route('superadmin.kelas.home',['id_kurikulum'=>$kurikulum->id])}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
				  </div>
				</div>
			  </div>
			</div>
		  </div>

    </div>
</main>

@endsection

@section('script')
<script>
</script>
@endsection
