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
				<form class="form-horizontal" id="submit-form" enctype="multipart/form-data" method="post" action="{{route('superadmin.ta.store')}}">
						{{ csrf_field() }}

				  <div class="form-group row">
					<label class="control-label col-md-4" for="tahun_ajaran">Nama Tahun Ajaran</label>
					<div class="col-md-7">
						<input class="form-control {{ $errors->has('tahun_ajaran') ? ' is-invalid' : '' }}" type="text" name="tahun_ajaran" placeholder="Nama Tahun Ajara" value="{{old('tahun_ajaran')}}" aria-describedby="tahun_ajaran" id="tahun_ajaran">
						@if ($errors->has('tahun_ajaran'))
							<small class="form-text text-muted" id="tahun_ajaran">{{ $errors->first('tahun_ajaran') }}</small>
						@endif
					</div>
					</div>
					
					<div class="form-group row">
						<label class="control-label col-md-4" for="tgl_pendaftaran">Tanggal Pendaftaran</label>
						<div class="col-md-7">
							<input class="form-control {{ $errors->has('tgl_pendaftaran') ? ' is-invalid' : '' }}" type="date" name="tgl_pendaftaran" placeholder="Tanggal Pembukaan Pendaftaran" value="{{old('tgl_pendaftaran')}}" aria-describedby="tgl_pendaftaran" id="tgl_pendaftaran">
							@if ($errors->has('tgl_pendaftaran'))
								<small class="form-text text-muted" id="tgl_pendaftaran">{{ $errors->first('tgl_pendaftaran') }}</small>
							@endif
							<small class="form-text text-muted" id="jadwalhelp">Tanggal pendaftaran adalah jatuh tempo awal pertama kali pendaftaran dibuka. Tanggal pendaftaran tidak berlaku jika tahun ajaran dalam status "Hidden"</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4" for="tgl_test">Tanggal Tes Masuk</label>
						<div class="col-md-7">
							<input class="form-control {{ $errors->has('tgl_test') ? ' is-invalid' : '' }}" type="date" name="tgl_test" placeholder="Tanggal Tes Masuk" value="{{old('tgl_test')}}" aria-describedby="tgl_test" id="tgl_test">
							@if ($errors->has('tgl_test'))
								<small class="form-text text-muted" id="tgl_test">{{ $errors->first('tgl_test') }}</small>
							@endif
							<small class="form-text text-muted" id="jadwalhelp">Tanggal tes masuk digunakan sebagai pengingat saja dan info bagi pendaftar baru</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4" for="tgl_pengumuman">Tanggal Pengumuman</label>
						<div class="col-md-7">
							<input class="form-control {{ $errors->has('tgl_pengumuman') ? ' is-invalid' : '' }}" type="date" name="tgl_pengumuman" placeholder="Tanggal Pengumuman Penerimaan" value="{{old('tgl_pengumuman')}}" aria-describedby="tgl_pengumuman" id="tgl_pengumuman">
							@if ($errors->has('tgl_pengumuman'))
								<small class="form-text text-muted" id="tgl_pengumuman">{{ $errors->first('tgl_pengumuman') }}</small>
							@endif
							<small class="form-text text-muted" id="jadwalhelp">Tanggal pengumuman ulang digunakan sebagai pengingat saja dan info bagi pendaftar baru</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4" for="tgl_daftar_ulang">Tanggal Daftar Ulang</label>
						<div class="col-md-7">
							<input class="form-control {{ $errors->has('tgl_daftar_ulang') ? ' is-invalid' : '' }}" type="date" name="tgl_daftar_ulang" placeholder="Tanggal Daftar Ulang" value="{{old('tgl_daftar_ulang')}}" aria-describedby="tgl_daftar_ulang" id="tgl_daftar_ulang">
							@if ($errors->has('tgl_daftar_ulang'))
								<small class="form-text text-muted" id="tgl_daftar_ulang">{{ $errors->first('tgl_daftar_ulang') }}</small>
							@endif
							<small class="form-text text-muted" id="jadwalhelp">Tanggal daftar ulang digunakan sebagai pengingat saja dan info bagi pendaftar baru</small>
						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4" for="brosur">Brosur</label>
						<div class="col-md-7">
							<input class="form-control-file  {{ $errors->has('brosur') ? ' is-invalid' : '' }}" name="brosur" id="brosur" type="file" aria-describedby="brosurhelp">
							@if ($errors->has('brosur'))
								<small class="form-text text-danger" id="brosur" style="border-top: 1px solid;"><b>{{ $errors->first('brosur') }}</b></small>
							@endif
							<small class="form-text text-muted" id="brosurhelp">Brosur dapat diinputkan setelah pembuatan tahun ajaran, brosur akan tampil jika tahun ajaran dalam status "show"</small>

						</div>
					</div>
					<div class="form-group row">
						<label class="control-label col-md-4" for="jadwal">Jadwal</label>
						<div class="col-md-7">
							<input class="form-control-file  {{ $errors->has('jadwal') ? ' is-invalid' : '' }}" name="jadwal" id="jadwal" type="file" aria-describedby="jadwalhelp">
							@if ($errors->has('jadwal'))
								<small class="form-text text-danger" id="jadwal" style="border-top: 1px solid;"><b>{{ $errors->first('jadwal') }}</b></small>
							@endif
							<small class="form-text text-muted" id="jadwalhelp">Jadwal dapat diinputkan setelah pembuatan tahun ajaran, brosur akan tampil jika tahun ajaran dalam status "show"</small>
						</div>
					</div>
				
				</form>

			  </div>
			  <div class="tile-footer">
				<div class="row">
				  <div class="col-md-8 col-md-offset-3">
					<button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('submit-form').submit();"><i class="fa fa-fw fa-lg fa-check-circle"></i>Tambah</button>
					<a class="btn btn-secondary" href="{{url()->previous()}}"><i class="fa fa-fw fa-lg fa-times-circle"></i>Batal</a>
					<small class="form-text text-muted" id="jadwalhelp">Ketika tahun ajaran dibuat secara default status ajaran akan dalam status "hidden" dan tidak akan terlihat secara umum (Hanya di Back Office)</small>
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
