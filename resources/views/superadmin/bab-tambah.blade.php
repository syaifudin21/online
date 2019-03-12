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
				<form class="form-horizontal" id="submit-form" method="post" action="{{route('superadmin.bab.store', ['id_mapel'=> $mapel->id])}}">
                    {{ csrf_field() }}

				  <div class="form-group row">
					<label class="control-label col-md-4" for="bab">Nama Bab</label>
					<div class="col-md-7">
						<input class="form-control {{ $errors->has('bab') ? ' is-invalid' : '' }}" type="text" name="bab" placeholder="Nama Bab" value="{{old('bab')}}" aria-describedby="bab" id="bab">
						@if ($errors->has('bab'))
							<small class="form-text text-muted" id="bab">{{ $errors->first('bab') }}</small>
						@endif
					</div>
                  </div>
                  
                  <div class="form-group row">
					<label class="control-label col-md-4" for="deskripsi">Deskripsi</label>
					<div class="col-md-7">
						<textarea class="form-control {{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" type="text" name="deskripsi" placeholder="Deskripsi" aria-describedby="deskripsi" id="deskripsi">{{old('deskripsi')}}</textarea>
						@if ($errors->has('deskripsi'))
							<small class="form-text text-muted" id="deskripsi">{{ $errors->first('deskripsi') }}</small>
						@endif
					</div>
                  </div>
                  
                  <div class="form-group row">
                        <label class="control-label col-md-4" for="topik">Nama Topik</label>
                        <div class="col-md-7">
                            <div id="topikRoom">
                            <div class="input-group mb-3">
                            <input class="form-control {{ $errors->has('topik') ? ' is-invalid' : '' }}" type="text" name="topik[]" placeholder="Nama Topik" value="{{old('topik')}}" aria-describedby="topik" id="topik">
    
                                <div class="input-group-append">
                                        <button class="btn btn-outline-primary"  onclick="remove()" type="button"><i class="fa fa-remove fa-fw"></i></button>
                                    </div>
                            </div>
                            </div>
                            @if ($errors->has('topik'))
                                <small class="form-text text-muted" id="topik">{{ $errors->first('topik') }}</small>
                            @endif
                        </div>
                        <div class="col-md-1">
                                <button class="btn btn-primary" type="button" id="topikTambah">+</button>
                        </div>
                      </div>
				</form>

			  </div>
			  <div class="tile-footer">
				<div class="row">
				  <div class="col-md-8 col-md-offset-3">
					<button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>
					<a class="btn btn-secondary" href="{{route('superadmin.bab.home',['id_mapel'=>$mapel->id])}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
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
  $('#topikTambah').on('click', function(){
		// acak nomor jurusan
		var noTopik = 200+Math.floor((Math.random() * 100) + 1);
			$('#topikRoom').append("<div class='input-group mb-3' id='add"+noTopik+"'><input class='form-control' type='text' name='topik[]' placeholder='Nama Topik' aria-describedby='topik'><div class='input-group-append'><button class='btn btn-outline-primary' type='button' onclick='destroy("+noTopik+")'><i class='fa fa-remove fa-fw'></i></button></div></div>");
  });
function remove(){
	$("#topik").val("");
}
function destroy(e){
	$("#add"+e).remove("");
}
</script>
@endsection
