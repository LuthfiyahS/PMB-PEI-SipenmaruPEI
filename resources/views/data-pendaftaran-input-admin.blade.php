@extends('master.master-admin')

@section('title')
    PMB PEI
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection

@section('menunya')
    Form Pendaftaran
@endsection

@section('menu')
@auth
<ul class="metismenu" id="menu">
    <li><a href="../../index">
            <i class="fas fa-home"></i>
            <span class="nav-text">Beranda</span>
        </a>
    </li>
    @if (auth()->user()->role == 'Administrator')
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-book"></i>
                <span class="nav-text">Data Master </span>
            </a>
            <ul aria-expanded="false">
                <li><a href="../../data-user">Pengguna</a></li>
                <li><a href="../../data-school">Sekolah</a></li>
                <li><a href="../../data-studyProgram">Program Studi</a></li>
            </ul>
        </li>
        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="fa fa-database"></i>
                <span class="nav-text">Data Transaksi</span>
            </a>
            <ul aria-expanded="false">
                <li><a href="../../data-registration">Pendaftaran</a></li>
                <li><a href="../../data-payment">Pembayaran</a></li>
            </ul>
        </li>
        
    <li><a href="../../data-announcement" aria-expanded="false">
        <i class="fa fa-file"></i>
        <span class="nav-text">Pengumuman</span>
    </a>
</li>
    @else
        @php
            $no = 1;
        @endphp
        @foreach ($viewDataUser as $x)
            @if ($no == 1)
                    <li><a href="../../data-registration" aria-expanded="false">
                            <i class="fa fa-database"></i>
                            <span class="nav-text">Pendaftaran</span>
                        </a>
                    </li>
            @endif
            @php
                $no++;
            @endphp
        @endforeach
    @endif
</ul>
@endauth
@endsection

@section('content')
    <div class="row">
        <form action="/save-registration" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input type="hidden" name="userid" value="{{ auth()->user()->id_user}}">
            @foreach ($viewDataUser as $x)
                @if (auth()->user()->email == $x->Email)
                    <div class="col-xl-12">
                        <div class="custom-accordion">
                            <div class="card">
                                <a href="#personal-data" class="text-dark" data-bs-toggle="collapse">
                                    <div class="p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3"> <i class="uil uil-receipt text-primary h2"></i>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Data Pribadi</h5>
                                                <p class="text-muted text-truncate mb-0">NISN, NIK, Nama, Jenis Kelamin, Pas
                                                    Photo, TTL, dsb</p>
                                            </div>
                                            <div class="flex-shrink-0"> <i
                                                    class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="personal-data" class="collapse show">
                                    <div class="p-4 border-top">
                                        <div class="row">
                                            <input type="hidden" name="id_user" value="{{ $x->Id_user }}">
                                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nisn">NISN</label>
                                                    <input type="number" class="form-control" id="personal-data-nisn"
                                                        name="nisn" placeholder="Masukkan NISN" value="{{ old('nisn') }}">
                                                    @error('nisn')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nik">NIK</label>
                                                    <input type="number" class="form-control" id="personal-data-nik"
                                                        name="nik" placeholder="Masukkan NIK" value="{{ old('nik') }}">
                                                    @error('nik')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-name">Nama</label>
                                                    
                                                        @if ($x->Nama != null)
                                                        <input type="text" class="form-control" id="basicpill"
                                                        name="nama" placeholder="Masukkan Nama Lengkap"
                                                        value="{{ $x->Nama }}">
                                                        @else
                                                        <input type="text" class="form-control" id="personal-data-name"
                                                        name="nama" placeholder="Masukkan Nama Lengkap"
                                                        value="{{ old('nama') }}">
                                                        @endif
                                                    @error('nama')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-gender">Jenis
                                                        Kelamin</label>
                                                    @if ($x->Gender != null)
                                                        @if ($x->Gender == 'Perempuan')
                                                            <select class="form-control wide" name="jk"
                                                                value="{{ old('jk') }}">
                                                                <option value="{{ $x->Gender }}" selected>
                                                                    {{ $x->Gender }}</option>
                                                                <option value="Laki-laki">Laki-laki</option>
                                                            </select>
                                                        @else
                                                            <select class="form-control wide" name="jk"
                                                                value="{{ old('jk') }}">
                                                                <option value="{{ $x->Gender }}" selected>
                                                                    {{ $x->Gender }}</option>
                                                                <option value="Perempuan">Perempuan</option>
                                                            </select>
                                                        @endif
                                                    @else
                                                        <select class="form-control wide" name="jk"
                                                            value="{{ old('jk') }}">
                                                            <option value="{{ old('jk') }}" disabled selected>Pilih
                                                                Jenis Kelamin </option>
                                                            <option value="Laki-laki">Laki-aki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                        </select>
                                                    @endif

                                                    @error('jk')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data">Agama</label>
                                                    <select class="form-control wide" name="agama"
                                                        value="{{ old('agama') }}">
                                                        <option value="{{ old('agama') }}" disabled selected>Pilih agama
                                                        </option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Kristen">Kristen</option>
                                                        <option value="Hindu">Hindu</option>
                                                        <option value="Budha">Budha</option>
                                                        <option value="Kong Hu Chu ">Kong Hu Chu</option>
                                                        <option value="Lainnya">Etc</option>
                                                    </select>
                                                    @error('agama')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-4 mb-lg-0">
                                                    <label class="form-label">Tempat lahir</label>
                                                    @if ($x->Tempat_lahir != null)
                                                    <input type="text" class="form-control" id="basicpill"
                                                    name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                    value="{{ $x->Tempat_lahir }}">
                                                    @else
                                                    <input type="text" class="form-control" id="basicpill"
                                                        name="tempatlahir" placeholder="Masukkan Tempat Lahir"
                                                        value="{{ old('tempatlahir') }}">
                                                    @endif
                                                    @error('tempatlahir')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-4 mb-lg-0">
                                                    <label class="form-label" for="billing-city">Tanggal lahir</label>
                                                    @if ($x->Tanggal_lahir != null)
                                                    <input type="date" class="form-control" id="basicpill"
                                                    name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                    value="{{ $x->Tanggal_lahir }}">
                                                    @else
                                                    <input type="date" class="form-control" id="basicpill"
                                                        name="tanggallahir" placeholder="Masukkan Tanggal Lahir"
                                                        value="{{ old('tanggallahir') }}">
                                                    @endif
                                                    @error('tanggallahir')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                    <!--<input name="tanggallahir" class="datepicker-default form-control" id="datepicker" >-->
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-0">
                                                    <label class="form-label" for="zip-code">Pas Photo</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                name="foto" value="{{ old('foto') }}">
                                                        </div>
                                                    </div>
                                                    @error('foto')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label" for="billing-address">Alamat</label>
                                            
                                                @if ($x->Alamat != null)
                                                <textarea class="form-control" id="billing-address" rows="3" name="alamat"
                                                placeholder="Masukkan alamat lengkap">{{ $x->Alamat }}</textarea>
                                                @else
                                                <textarea class="form-control" id="billing-address" rows="3" name="alamat"
                                                placeholder="Masukkan alamat lengkap">{{ old('alamat') }}</textarea>
                                                @endif
                                            @error('alamat')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nisn">Email</label>
                                                    <input type="email" class="form-control" id="personal-data-nisn"
                                                        name="email" placeholder="Masukkan email"
                                                        value="{{ auth()->user()->email }}" readonly>
                                                    @error('email')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nik">No
                                                        Hp/WhatsApp</label>
                                                        @if ($x->No_Hp != null)
                                                        <input type="number" class="form-control" id="basicpill"
                                                        name="nohp" placeholder="Masukkan Tanggal Lahir"
                                                        value="{{ $x->No_Hp }}">
                                                        @else
                                                        <input type="number" class="form-control" id="basicpill"
                                                        name="nohp" placeholder="Masukkan nomor telepon"
                                                        value="{{ old('nohp') }}">
                                                        @endif
                                                    @error('nohp')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <a href="#registration-data" class="collapsed text-dark" data-bs-toggle="collapse">
                                    <div class="p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Data Pendaftaran</h5>
                                                <p class="text-muted text-truncate mb-0">Pilihan program studi </p>
                                            </div>
                                            <div class="flex-shrink-0"> <i
                                                    class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="registration-data" class="collapse">
                                    <div class="p-4 border-top">
                                        <div class="mb-4">
                                            <label class="form-label" for="billing-address">Gelombang</label>
                                            <select class="form-control wide" name="gelombang">    
                                            @foreach ($viewDataJadwal as $x)
                                            <option value="{{$x->nama_kegiatan}}" selected>{{$x->nama_kegiatan}}</option>
                                            @endforeach
                                            </select>
                                            @error('gelombang')
                                                <div class="alert alert-warning" role="alert">
                                                    <strong>Peringatan!</strong>
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nisn">Pilihan
                                                        1</label>
                                                    <input class="form-control" list="datalistOptionsProdi"
                                                        id="exampleDataList" placeholder="Pilih program studi" name="pil1"
                                                        value="{{ old('pil1') }}">
                                                    <datalist id="datalistOptionsProdi">
                                                        @foreach ($viewProdi as $z)
                                                            <option value="{{ $z->id_prodi }}">{{ $z->nama_prodi }}
                                                            </option>
                                                        @endforeach
                                                    </datalist>
                                                    @error('pil1')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nik">Pilihan 2</label>
                                                    <input class="form-control" list="datalistOptionsProdi"
                                                        id="exampleDataList" placeholder="Pilih program studi" name="pil2"
                                                        value="{{ old('pil2') }}">
                                                    <datalist id="datalistOptionsProdi">
                                                        @foreach ($viewProdi as $z)
                                                            <option value="{{ $z->id_prodi }}">{{ $z->nama_prodi }}
                                                            </option>
                                                        @endforeach
                                                    </datalist>
                                                    @error('pil2')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <a href="#parental-data" class="collapsed text-dark" data-bs-toggle="collapse">
                                    <div class="p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3"> <i class="uil uil-bill text-primary h2"></i>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Data Orang Tua</h5>
                                                <p class="text-muted text-truncate mb-0">Data orang tua, keuangan dan data.
                                                </p>
                                            </div>
                                            <div class="flex-shrink-0"> <i
                                                    class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="parental-data" class="collapse">
                                    <div class="p-4 border-top">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-name">Nama
                                                        Ayah</label>
                                                    <input type="text" class="form-control" id="personal-data-name"
                                                        name="ayah" placeholder="Masukkan Nama Ayah"
                                                        value="{{ old('ayah') }}">
                                                    @error('ayah')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-gender">Pekerjaan
                                                        Ayah</label>
                                                    <input class="form-control" list="datalistOptionsOccupation"
                                                        id="exampleDataList" placeholder="Masukkan Jenis Pekerjaan..."
                                                        name="pekerjaanayah" value="{{ old('pekerjaanayah') }}">
                                                    <datalist id="datalistOptionsOccupation">
                                                        <option value="Karyawan Swasta"></option>
                                                        <option value="Karyawan BUMN"></option>
                                                        <option value="Karyawan BUMD"></option>
                                                        <option value="Karyawan Honorer"></option>
                                                        <option value="PNS"></option>
                                                        <option value="Wirausaha"></option>
                                                        <option value="PNS"></option>
                                                        <option value="Buruh"></option>
                                                        <option value="Asisten Rumah Tangga"></option>
                                                        <option value="Seniman"></option>
                                                        <option value="Dokter"></option>
                                                        <option value="Perawat"></option>
                                                        <option value="Bidan"></option>
                                                        <option value="Apoteker"></option>
                                                        <option value="Pengajar"></option>
                                                        <option value="Notaris"></option>
                                                    </datalist>
                                                    @error('pekerjaanayah')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nik">No HP
                                                        Ayah</label>
                                                    <input type="number" class="form-control" id="personal-data-no"
                                                        name="noayah" placeholder="Masukkan Telepon Ayah"
                                                        value="{{ old('noayah') }}">
                                                    @error('pekerjaanayah')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-name">Nama Ibu</label>
                                                    <input type="text" class="form-control" id="personal-data-name"
                                                        name="ibu" placeholder="Masukkan Nama Ibu"
                                                        value="{{ old('ibu') }}">
                                                    @error('ibu')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-gender">Pekerjaan
                                                        Ibu</label>
                                                    <input class="form-control" list="datalistOptionsOccupation"
                                                        id="exampleDataList" placeholder="Cari Pekerjaan Ibu.."
                                                        name="pekerjaanibu" value="{{ old('pekerjaanibu') }}">
                                                    <datalist id="datalistOptionsOccupation">
                                                        <option value="Karyawan Swasta"></option>
                                                        <option value="Karyawan BUMN"></option>
                                                        <option value="Karyawan BUMD"></option>
                                                        <option value="Karyawan Honorer"></option>
                                                        <option value="PNS"></option>
                                                        <option value="Wirausaha"></option>
                                                        <option value="PNS"></option>
                                                        <option value="Buruh"></option>
                                                        <option value="Asisten Rumah Tangga"></option>
                                                        <option value="Seniman"></option>
                                                        <option value="Dokter"></option>
                                                        <option value="Perawat"></option>
                                                        <option value="Bidan"></option>
                                                        <option value="Apoteker"></option>
                                                        <option value="Pengajar"></option>
                                                        <option value="Notaris"></option>
                                                    </datalist>
                                                    @error('pekerjaanibu')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nik">No Telepon
                                                        Ibu</label>
                                                    <input type="number" class="form-control" id="personal-data-no"
                                                        name="noibu" placeholder="Masukkan Telepon Ibu"
                                                        value="{{ old('noibu') }}">
                                                    @error('noibu')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nisn">Gaji</label>
                                                    <select class="form-control wide" title="Recipient" name="gaji">
                                                        <option value="{{ old('gaji') }}" disabled selected>Pilih gaji
                                                        </option>
                                                        <option value="< 1.0000.000">
                                                            < 1.000.000</option>
                                                        <option value="1.000.000 - 2.500.000">1.000.000 -
                                                            2.500.000
                                                        </option>
                                                        <option value="2.500.000 - 5.000.000">2.500.000 - 5.000.000</option>
                                                        <option value="5.000.000 - 7.500.000">5.000.000 - 7.500.000</option>
                                                        <option value="7.500.000 - 10.000.000">7.500.000 - 10.000.000
                                                        </option>
                                                        <option value="> 10.0000.000"> > 10.000.000</option>
                                                    </select>
                                                    @error('gaji')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nik">Tanggungan
                                                        Keluarga</label>
                                                    <input type="number" class="form-control" id="personal-data-nik"
                                                        name="tanggungan" placeholder="Masukkan jumlah tanggungan"
                                                        value="{{ old('tanggungan') }}">
                                                    @error('tanggungan')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nisn">Slip Gaji
                                                    </label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                name="ftgaji" value="{{ old('ftgaji') }}">
                                                        </div>
                                                    </div>
                                                    @error('ftgaji')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data-nik">Kartu
                                                        Keluarga</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                name="ftkk" value="{{ old('ftkk') }}">
                                                        </div>
                                                    </div>
                                                    @error('ftkk')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <a href="#school-data" class="collapsed text-dark" data-bs-toggle="collapse">
                                    <div class="p-4">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3"> <i class="uil uil-truck text-primary h2"></i>
                                            </div>
                                            <div class="flex-grow-1 overflow-hidden">
                                                <h5 class="font-size-16 mb-1">Data sekolah asal dan nilai</h5>
                                                <p class="text-muted text-truncate mb-0">Sekolah asal, jurusan, nilai
                                                    raport dan ijazah</p>
                                            </div>
                                            <div class="flex-shrink-0"> <i
                                                    class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                        </div>
                                    </div>
                                </a>
                                <div id="school-data" class="collapse">
                                    <div class="p-4 border-top">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="billing-address">Nama
                                                        Sekolah</label>
                                                    <input class="form-control" list="datalistOptionsSekolah"
                                                        id="exampleDataList" placeholder="Cari NPSN Sekolah...."
                                                        name="id_sekolah" value="{{ old('id_sekolah') }}">
                                                    <datalist id="datalistOptionsSekolah">
                                                        @foreach ($viewSekolah as $z)
                                                            <option value="{{ $z->NPSN }}">
                                                                {{ $z->nama_sekolah }}</option>
                                                        @endforeach
                                                    </datalist>
                                                    @error('id_sekolah')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data">Jurusan</label>
                                                    <input class="form-control" list="datalistOptionsJurusan"
                                                        id="exampleDataList" placeholder="Cari Jurusan..." name="jurusan"
                                                        value="{{ old('jurusan') }}">
                                                    <datalist id="datalistOptionsJurusan">
                                                        <option value="IPA"></option>
                                                        <option value="IPS"></option>
                                                        <option value="Bahasa"></option>
                                                        <option value="Agama"></option>
                                                        <option value="Teknik"></option>
                                                        <option value="Tata Boga"></option>
                                                        <option value="Tata Busana"></option>
                                                        <option value="Administrasi Perkantoran"></option>
                                                    </datalist>
                                                    @error('jurusan')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-2">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label">Semester 1</label>
                                                    <input type="number" class="form-control" name="smt1"
                                                        placeholder="Masukkan Rata Nilai Semester"
                                                        value="{{ old('smt1') }}">
                                                    @error('smt1')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label">Semester 2</label>
                                                    <input type="number" class="form-control" name="smt2"
                                                        placeholder="Masukkan Rata Nilai Semester"
                                                        value="{{ old('smt2') }}">
                                                    @error('smt2')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label">Semester 3</label>
                                                    <input type="number" class="form-control" name="smt3"
                                                        placeholder="Masukkan Rata Nilai Semester"
                                                        value="{{ old('smt3') }}">
                                                    @error('smt3')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label">Semester 4</label>
                                                    <input type="number" class="form-control" name="smt4"
                                                        placeholder="Masukkan Rata Nilai Semester"
                                                        value="{{ old('smt4') }}">
                                                    @error('smt4')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label">Semester 5</label>
                                                    <input type="number" class="form-control" name="smt5"
                                                        placeholder="Masukkan Rata Nilai Semester"
                                                        value="{{ old('smt5') }}">
                                                    @error('smt5')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="billing-address">Raport</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                name="ftraport" value="{{ old('ftraport') }}">
                                                        </div>
                                                    </div>
                                                    @error('ftraport')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="billing-address">Prestasi <small>(jika ada)</small></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                name="ftprestasi" value="{{ old('ftprestasi') }}">
                                                        </div>
                                                    </div>
                                                    @error('ftprestasi')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="mb-3 mb-4">
                                                    <label class="form-label" for="personal-data">Ijazah <small>(jika ada)</small></label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                name="ftijazah" value="{{ old('ftijazah') }}">
                                                        </div>
                                                    </div>
                                                    @error('ftijazah')
                                                        <div class="alert alert-warning" role="alert">
                                                            <strong>Peringatan!</strong>
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col">
                                    <div class="text-end mt-2 mt-sm-0">
                                        <button type="submit" name="add" class="btn btn-primary">Buat Pendaftaran</button>
                                    </div>
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row-->
                        </div>
                @endif
            @endforeach

        </form>
    </div>
    <!-- end row -->
@endsection

@section('footer')
@endsection
