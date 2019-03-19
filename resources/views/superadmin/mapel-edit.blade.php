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
                <form class="form-horizontal" id="submit-form" method="post" action="{{route('superadmin.mapel.update')}}">
                    @csrf @method('put')
                    <input type="hidden" name="id" value="{{$mapel->id}}">

				  <div class="form-group row">
					<label class="control-label col-md-4" for="mapel">Nama Mata Pelajaran</label>
					<div class="col-md-7">
						<input class="form-control {{ $errors->has('mapel') ? ' is-invalid' : '' }}" type="text" name="mapel" placeholder="Nama Mata Pelajaran" value="{{$mapel->mapel}}" aria-describedby="mapel" id="mapel">
						@if ($errors->has('mapel'))
							<small class="form-text text-muted" id="mapel">{{ $errors->first('mapel') }}</small>
						@endif
					</div>
                  </div>
                  
                  <div class="form-group row">
					<label class="control-label col-md-4" for="deskripsi">Deskripsi</label>
					<div class="col-md-7">
						<textarea class="form-control {{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" type="text" name="deskripsi" placeholder="Deskripsi" aria-describedby="deskripsi" id="deskripsi">{{$mapel->deskripsi}}</textarea>
						@if ($errors->has('deskripsi'))
							<small class="form-text text-muted" id="deskripsi">{{ $errors->first('deskripsi') }}</small>
						@endif
					</div>
				  </div>
				  <div class="form-group row">
					<label class="control-label col-md-4" for="jenismapel">Jenis Mapel</label>
					<div class="col-md-7">
                        <select name="jenis" class="form-control {{ $errors->has('jenis') ? ' is-invalid' : '' }}" id="jenismapel">
                            <option disabled selected>Pilih Jenis Mapel</option>
                            @foreach ($jenismapels as $jenis)
                                <option {{($mapel->jenis==$jenis)? 'selected' : ''}}>{{$jenis}}</option>
                            @endforeach
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
