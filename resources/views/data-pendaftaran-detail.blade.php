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
Detail Pendaftaran
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
            @foreach ($viewDataUser as $x)
                    @if (auth()->user()->email == $x->Email)
                        @if ($x->Id_user == $viewData->id_user)
                            <li><a href="../../registration/{{ $viewData->id_pendaftaran }}" aria-expanded="false">
                                    <i class="fa fa-database"></i>
                                    <span class="nav-text">Pendaftaran</span>
                                </a>
                            </li>
                        @else
                            <li><a href="../../form-registration" aria-expanded="false">
                                    <i class="fa fa-database"></i>
                                    <span class="nav-text">Pendaftaran</span>
                                </a>
                            </li>
                        @endif
                    @endif
                @endforeach
            @endif
        </ul>
    @endauth
@endsection

@section('content')
    <div class="row">
        {{ csrf_field() }}
        <div class="col-xl-12">
            <div class="custom-accordion">
                @if (auth()->user()->role == 'Administrator')
                <div class="row my-4">
                    <div class="col">
                        <div class="text-end mt-2 mt-sm-0">
                            <a href="../../data-registration"><button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Close </button></a>
                            @if ($viewData->status_pendaftaran=='Belum Terverifikasi')
                            <a href="../../verified-registration/{{$viewData->id_pendaftaran}}"><button type="button" class="btn btn-primary">Verified</button></a>
                            @endif
                            <a href="../../card-registration/{{$viewData->id_pendaftaran}}"><button type="button" class="btn btn-primary">View Card </button></a>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row-->
                @elseif(auth()->user()->role == 'Calon Mahasiswa')
                @if ($viewData->status_pendaftaran=="Belum Terverifikasi")
                <div class="alert alert-success alert-dismissible fade show">
                    <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
                    <strong>Sukses!</strong> Data pendaftaranmu terkirim. Sebelum melakukan pembayaran, tunggu administrator memverifikasi datamu ya.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
                @elseif ($viewData->status_pendaftaran=="Terverifikasi")
                <div class="alert alert-info alert-dismissible fade show">
                    <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                    <strong>Informasi!</strong> Segera lakukan pembayaran.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                </div>
                @endif
                @endif

                <div class="card card-body">
                    <div class="card-header">
                        <h4 class="card-title">Data Pendaftaran</h4>
                        <!-- center modal -->
                        <div>
                            @if ($viewData->status_pendaftaran == "Belum Terverifikasi")
                            <button class="btn btn-warning mb-4" style="margin-bottom: 1rem;" disabled>Belum Terverifikasi</button>
                            @elseif ($viewData->status_pendaftaran == "Terverifikasi")
                            @foreach ($viewDataPembayaran as $item)
                                @if ($item->status_pembayaran =="Gratis" && $item->status_pembayaran =="Dibayar")
                                <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".upload"
                                style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Upload Pembayaran</button>
                                    
                            @endif
                            @endforeach
                            
                            <button class="btn btn-success mb-4" style="margin-bottom: 1rem;" disabled>Terverifikasi</button>
                            @elseif ($viewData->status_pendaftaran == "Selesai")
                            <button class="btn btn-primary mb-4" style="margin-bottom: 1rem;" disabled>Selesai</button>
                            @else
                            <span class="badge badge-danger">Data Tidak Sah</span>
                            @endif
                        </div>
                    </div>
                    <div class="modal fade upload" tabindex="-1" role="dialog"
                        aria-labelledby="mySmallModalLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Kirim bukti pembayaran</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="../upload-payment" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="userid" value="{{ auth()->user()->id_user}}">
                                        <div class="form-group">
                                            <input type="hidden" name="id_pendaftaran" id="nama" class="form-control"
                                            value="{{ $viewData->id_pendaftaran }}">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <label for="iduser">Pilih Dokumen</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                        name="pem" >
                                                                    <input type="hidden" class="form-file-input form-control"
                                                                        name="pathnya">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 d-flex">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" name="add"
                                                class="btn btn-primary">Perbaharui
                                                Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="row mb-2">
                                    <div class="pt-4 border-bottom-1 pb-3">
                                        <h4 class="text-primary">PROFIL SISWA</h4>
                                    </div>
                                    <div class="col-sm-4 col-5">
                                        <h5 class="f-w-500">ID Pendaftaran</h5>
                                    </div>
                                    <div class="col-sm-8 col-7">
                                        {{ $viewData->id_pendaftaran }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">Nama</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->nama_siswa }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">Jenis Kelamin</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->jenis_kelamin }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">TTL</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->tempat_lahir }},
                                        {{ $viewData->tanggal_lahir }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">Agama</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->agama }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">NISN</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->nisn }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">NIK</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->nik }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">Alamat</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->alamat }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">Email</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->email }}
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-sm-4 col-6">
                                        <h5 class="f-w-500">Telepon/What'sApp</h5>
                                    </div>
                                    <div class="col-sm-8 col-6">
                                        {{ $viewData->nik }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="pt-4 border-bottom-1 pb-3">
                                    <img src="{{ asset($viewData->pas_foto) }}" width="250px" height="300" alt="">
                                </div>
                            </div>
                        </div>


                            
                            <div class="pt-4 border-bottom-1 pb-3">
                                <h4 class="text-primary">DATA ORANG TUA</h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row mb-2">
                                        <div class="col-sm-4 col-6">
                                            <h5 class="f-w-500">Nama Ayah</h5>
                                        </div>
                                        <div class="col-sm-8 col-6">
                                            {{ $viewData->nama_ayah }}
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">Pekerjaan Ayah</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            {{ $viewData->pekerjaan_ayah }}
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">No Handphone</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            {{ $viewData->nohp_ayah }}
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">Gaji</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            {{ $viewData->gaji }}
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">Dokumen</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            <a class="btn btn-light shadow btn-xs sharp me-1" title="Detail Registration"
                                            href="{{ asset($viewData->slip_gaji) }}"><i class="fa fa-file-alt"></i></a>
                                            <a class="btn btn-light shadow btn-xs sharp me-1" title="Detail Registration"
                                            href="{{ asset($viewData->kk) }}"><i class="fa fa-file-alt"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!--kiri-->
                                <div class="col-lg-6">
                                    <div class="row mb-2">
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">Nama Ibu</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            {{ $viewData->nama_ibu }}
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">Pekerjaan Ibu</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            {{ $viewData->pekerjaan_ibu }}
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">No Handphone</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            {{ $viewData->nohp_ibu }}
                                        </div>
                                        <div class="col-sm-3 col-6">
                                            <h5 class="f-w-500">Tanggungan</h5>
                                        </div>
                                        <div class="col-sm-9 col-6">
                                            {{ $viewData->tanggungan }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 border-bottom-1 pb-3">
                                <h4 class="text-primary">DATA REGISTRASI</h4>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Gelombang</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->gelombang }}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Tahun</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->tahun_masuk }}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Pilhan 1</h5>
                                    <div class="col-sm-9 col-7">
                                        @foreach ($viewProdi as $z)
                                            @if ($z->id_prodi == $viewData->pil1)
                                                {{ $z->nama_prodi }}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Pilhan 2</h5>
                                    <div class="col-sm-9 col-7">
                                        @foreach ($viewProdi as $z)
                                            @if ($z->id_prodi == $viewData->pil2)
                                                {{ $z->nama_prodi }}
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="pt-4 border-bottom-1 pb-3">
                                <h4 class="text-primary">DATA SEKOLAH DAN PENDIDIKAN SEBELUMNYA</h4>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Nama Sekolah</h5>
                                    <div class="col-sm-9 col-7">
                                        @foreach ($viewSekolah as $z)
                                                    @if ($z->NPSN == $viewData->id_Sekolah)
                                                        {{ $z->nama_sekolah }}
                                                    @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Jurusan</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->jurusan }}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Semester 1</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->smt1 }}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Semester 2</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->smt2 }}
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Semester 3</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->smt3 }}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Semester 4</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->smt4 }}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Semester 5</h5>
                                    <div class="col-sm-9 col-7">
                                        {{ $viewData->smt5 }}
                                    </div>
                                </div>
                                <div class="col-sm-3 col-3">
                                    <h5 class="f-w-500">Dokumen</h5>
                                    <div class="col-sm-9 col-7">
                                        <a class="btn btn-light shadow btn-xs sharp me-1" title="Detail Registration"
                                            href="{{ asset($viewData->slip_gaji) }}"><i class="fa fa-file-alt"></i></a>
                                        <a class="btn btn-light shadow btn-xs sharp me-1" title="Detail Registration"
                                            href="{{ asset($viewData->kk) }}"><i class="fa fa-file-alt"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- end row-->
            </div>
        </div>
        <!-- end row -->
    @endsection

    @section('footer')
    @endsection