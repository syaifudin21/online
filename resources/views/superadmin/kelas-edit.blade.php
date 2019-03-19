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
    </div>

    <div class="row">
        <div class="col-md-8">
			<div class="tile">
			  <div class="tile-body">
				<form class="form-horizontal" id="submit-form" method="post" action="{{route('superadmin.kelas.update')}}">
                    @csrf @method('put')
                    <input type="hidden" name="id" value="{{$kelas->id}}">

				  <div class="form-group row">
					<label class="control-label col-md-4" for="kelas">Nama kelas</label>
					<div class="col-md-7">
						<input class="form-control {{ $errors->has('kelas') ? ' is-invalid' : '' }}" type="text" name="kelas" placeholder="Nama Kelas" value="{{$kelas->kelas}}" aria-describedby="kelas" id="kelas">
						@if ($errors->has('kelas'))
							<small class="form-text text-muted" id="kelas">{{ $errors->first('kelas') }}</small>
						@endif
					</div>
				  </div>

				  <div class="form-group row">
					<label class="control-label col-md-4" for="Jenis Kelas">Jenis Kelas</label>
					<div class="col-md-7">
                        <select name="jenis" class="form-control {{ $errors->has('jenis') ? ' is-invalid' : '' }}">
                            <option disabled>Jenis Kelas</option>
                            <option value="Pertama" {{($kelas->jenis=='Pertama')? 'selected': ''}}>Pertama (Kelas Pendaftaran)</option>
                            <option value="Menengah" {{($kelas->jenis=='Menengah')? 'selected': ''}}>Menengah</option>
                            <option value="Akhir" {{($kelas->jenis=='Akhir')? 'selected': ''}}>Akhir (Kelas Akhir)</option>
                        </select>
						@if ($errors->has('jenis'))
							<small class="form-text text-muted" id="jenis">{{ $errors->first('jenis') }}</small>
						@endif
					</div>
				  </div>

				  <input type="hidden" name="redirect" value="{{url()->previous()}}">
				</form>

			  </div>
			  <div class="tile-footer">
				<div class="row">
				  <div class="col-md-8 col-md-offset-3">
					<button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>
					<a class="btn btn-secondary" href="{{url()->previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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
