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
				<form class="form-horizontal" id="submit-form" method="post" action="{{route('superadmin.kurikulum.update')}}">
                    @method('PUT') @csrf
                    <input type="hidden" name="id" value="{{$kurikulum->id}}">

				  <div class="form-group row">
					<label class="control-label col-md-4" for="kurikulum">Nama Kurikulum</label>
					<div class="col-md-7">
						<input class="form-control {{ $errors->has('kurikulum') ? ' is-invalid' : '' }}" type="text" name="kurikulum" placeholder="Nama Kurikulum" value="{{$kurikulum->kurikulum}}" aria-describedby="kurikulum" id="kurikulum">
						@if ($errors->has('kurikulum'))
							<small class="form-text text-muted" id="kurikulum">{{ $errors->first('kurikulum') }}</small>
						@endif
					</div>
				  </div>

				  <div class="form-group row">
					<label class="control-label col-md-4" for="jurusan">Jurusan</label>
					<div class="col-md-7">
						<div id="jurusanRoom">
                            @foreach (json_decode($kurikulum->jurusan) as $jurusan)
                                <div class="input-group mb-3" id="add{{$jurusan}}">
                                <input class="form-control {{ $errors->has('jurusan') ? ' is-invalid' : '' }}" type="text" name="jurusan[]" placeholder="Nama Jurusan" value="{{$jurusan}}" aria-describedby="jurusan" id="jurusan{{$jurusan}}">

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary"  onclick="destroy('{{$jurusan}}')" type="button"><i class="fa fa-remove fa-fw"></i></button>
                                    </div>
                                </div>
                            @endforeach
						</div>
						@if ($errors->has('jurusan'))
							<small class="form-text text-muted" id="jurusan">{{ $errors->first('jurusan') }}</small>
						@endif
					</div>
					<div class="col-md-1">
							<button class="btn btn-primary" type="button" id="jurusanTambah">+</button>
					</div>
				  </div>

				  <div class="form-group row">
					<label class="control-label col-md-4" for="jurusan">Jenis Mapel</label>
					<div class="col-md-7">
						<div id="jenisRoom">
                            @foreach (json_decode($kurikulum->jenis_mapel) as $jenis_mapel)
                                <div class="input-group mb-3" id="add{{$jenis_mapel}}">
                                <input class="form-control {{ $errors->has('jenis_mapel') ? ' is-invalid' : '' }}" type="text" name="jenis_mapel[]" placeholder="Jenis Mapel" value="{{$jenis_mapel}}" aria-describedby="jenis_mapel" id="jenis_mapel{{$jenis_mapel}}">

                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" onclick="destroy('{{$jenis_mapel}}')" type="button"><i class="fa fa-remove fa-fw"></i></button>
                                        </div>
                                </div>
                            @endforeach
						</div>
						@if ($errors->has('jenis_mapel'))
							<small class="form-text text-muted" id="jenis_mapel">{{ $errors->first('jenis_mapel') }}</small>
						@endif
					</div>
					<div class="col-md-1">
							<button class="btn btn-primary" type="button" id="jenisTambah">+</button>
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
  $('#jurusanTambah').on('click', function(){
		// acak nomor jurusan
		var noJur = 200+Math.floor((Math.random() * 100) + 1);
			$('#jurusanRoom').append("<div class='input-group mb-3' id='add"+noJur+"'><input class='form-control' type='text' name='jurusan[]' placeholder='Nama Jurusan' aria-describedby='jurusan'><div class='input-group-append'><button class='btn btn-outline-primary' type='button' onclick='destroy("+noJur+")'><i class='fa fa-remove fa-fw'></i></button></div></div>");
  });
	$('#jenisTambah').on('click', function(){
		// acak nomor jurusan
		var noJen = 100+Math.floor((Math.random() * 100) + 1);
			$('#jenisRoom').append("<div class='input-group mb-3' id='add"+noJen+"'><input class='form-control' type='text' name='jenis_mapel[]' placeholder='Jenis Mapel' aria-describedby='jenis_mapel'><div class='input-group-append'><button class='btn btn-outline-primary' type='button' onclick='destroy("+noJen+")'><i class='fa fa-remove fa-fw'></i></button></div></div>");
  });
function remove(){
	$("#jurusan").val("");
}
function destroy(e){
	$("#add"+e).remove("");
}
</script>
@endsection
