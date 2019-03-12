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
                <form class="form-horizontal" id="submit-form" method="post" action="{{route('superadmin.bab.update')}}">
                    @csrf @method('put')
                    <input type="hidden" name="id" value="{{$bab->id}}">

				  <div class="form-group row">
					<label class="control-label col-md-4" for="bab">Nama Bab</label>
					<div class="col-md-7">
						<input class="form-control {{ $errors->has('bab') ? ' is-invalid' : '' }}" type="text" name="bab" placeholder="Nama Bab" value="{{$bab->bab}}" aria-describedby="bab" id="bab">
						@if ($errors->has('bab'))
							<small class="form-text text-muted" id="bab">{{ $errors->first('bab') }}</small>
						@endif
					</div>
                  </div>
                  
                  <div class="form-group row">
					<label class="control-label col-md-4" for="deskripsi">Deskripsi</label>
					<div class="col-md-7">
						<textarea class="form-control {{ $errors->has('deskripsi') ? ' is-invalid' : '' }}" type="text" name="deskripsi" placeholder="Deskripsi" aria-describedby="deskripsi" id="deskripsi">{{$bab->deskripsi}}</textarea>
						@if ($errors->has('deskripsi'))
							<small class="form-text text-muted" id="deskripsi">{{ $errors->first('deskripsi') }}</small>
						@endif
					</div>
                  </div>
                  
                  <div class="form-group row">
                        <label class="control-label col-md-4" for="topik">Topik Bab</label>
                        <div class="col-md-7">
                            <div id="topikRoom">
                            @foreach (json_decode($bab->topik) as $topik)
                            <div class="input-group mb-3" id="add{{$topik}}">
                                <input class="form-control {{ $errors->has('topik') ? ' is-invalid' : '' }}" type="text" name="topik[]" placeholder="Nama Topik" value="{{$topik}}" aria-describedby="topik" id="topik">
    
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary"  onclick="destroy('{{$topik}}')" type="button"><i class="fa fa-remove fa-fw"></i></button>
                                </div>
                            </div>
                            @endforeach
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
