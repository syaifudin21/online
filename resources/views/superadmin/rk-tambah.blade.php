@extends('superadmin.super-template')
@section('css')

@endsection
@section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1>Tahun Ajaran</h1>
            <p>Informasi jumlah siswa dalam satu periode pembelajaran</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <div class="tile-body">
                    <form class="form-horizontal" id="submit-form" method="post" action="{{route('superadmin.rk.store')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_ta" value="{{$id_ta}}">
                        <div class="form-group row">
                            <label class="control-label col-md-4" for="ruang_kelas">Nama Ruang Kelas</label>
                            <div class="col-md-7">
                                <input class="form-control {{ $errors->has('ruang_kelas') ? ' is-invalid' : '' }}" type="text"
                                    name="ruang_kelas" placeholder="Nama Ruang Kelas" value="{{old('ruang_kelas')}}"
                                    aria-describedby="ruang_kelas" id="tahun_ajaran">
                                @if ($errors->has('ruang_kelas'))
                                <small class="form-text text-muted" id="tahun_ajaran">{{ $errors->first('tahun_ajaran')
                                    }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4" for="ruang_kelas">Kurikulum</label>
                            <div class="col-md-7">
                                <select id="kurikulum" class="form-control">
                                    <option selected disabled>Pilih Kurikulum</option>
                                    @foreach ($kurikulums as $kurikulum)
                                        <option value="{{$kurikulum->id}}">{{$kurikulum->kurikulum}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4" for="ruang_kelas">Jurusan</label>
                            <div class="col-md-7">
                                <select id="jurusan" name="jurusan" class="form-control">
                                    <option selected disabled>Pilih Kurikulum Terlebih Dahulu</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-4" for="ruang_kelas">Kelas</label>
                            <div class="col-md-7">
                                <select id="kelas" name="id_kelas" class="form-control">
                                    <option selected disabled>Pilih Kurikulum Terlebih Dahulu</option>
                                </select>
                            </div>
                        </div>
                        
                        <input type="hidden" name="redirect" value="{{url()->previous()}}">
                    </form>

                </div>
                <div class="tile-footer">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-3">
                            <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i
                                    class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>
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
$('#kurikulum').on('change', function(e){
      var kurikulum = e.target.value;
      $.get('{{ route('data.kurikulum.kelas')}}?id_kurikulum='+kurikulum, function(data){
        $('#jurusan').empty();
        $('#kelas').empty();
        $('#jurusan').append('<option selected disabled>Pilih Jurusan</option>');
        $('#kelas').append('<option selected disabled>Pilih Kelas</option>');
        $.each(data.data.jurusan, function(index, jurusan){
            console.log(jurusan)
          $('#jurusan').append("<option>"+jurusan+"</option>")
        });
        $.each(data.data.kelas, function(index, kelas){
          $('#kelas').append("<option value='"+kelas.id+"'>"+kelas.kelas+" ("+kelas.jenis+")</option>")
        });
      });
  });
</script>
@endsection
