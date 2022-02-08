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
    Pendaftaran
@endsection

@section('menu')
    @auth
        <ul class="metismenu" id="menu">
            <li><a href="index">
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
                        <li><a href="data-user">Pengguna</a></li>
                        <li><a href="data-school">Sekolah</a></li>
                        <li><a href="data-studyProgram">Program Studi</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-database"></i>
                        <span class="nav-text">Data Transaksi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="data-registration">Pendaftaran</a></li>
                        <li><a href="data-payment">Pembayaran</a></li>
                    </ul>
                </li>

                <li><a href="data-announcement" aria-expanded="false">
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
                        <li><a href="data-registration" aria-expanded="false">
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
    <!--ADMIn-->
    @auth


        @if (auth()->user()->role == 'Administrator')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pendaftar</h4>

                            <!-- center modal -->
                            <div>
                                <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i
                                        class="fa fa-print"> </i></button>
                                <a href="form-registration"><button type="button" class="btn btn-primary mb-4"
                                        style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Tambah
                                        Pendaftaran</button></a>
                            </div>
                        </div>
                        <div class="card-body" id="cetak">
                            <div class="table-responsive">
                                {{ csrf_field() }}

                                <table id="example" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No Peserta</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Tanggal Daftar</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $no = 1; @endphp
                                        @foreach ($viewData as $x)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $x->id_pendaftaran }}</td>
                                                <td>{{ $x->nama_siswa }}</td>
                                                <td>{{ $x->jenis_kelamin }}</td>
                                                <td><strong>{{ $x->tgl_pendaftaran }}</strong></a></td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            @if ($x->status_pendaftaran == 'Terverifikasi')
                                                                <span class="badge badge-success">Terverifikasi<span
                                                                        class="ms-1 fa fa-check"></span>
                                                                @elseif($x->status_pendaftaran == 'Belum Terverifikasi')
                                                                    <span class="badge badge-warning">Belum <br> Terverifikasi
                                                                        <br><span class="ms-1 fas fa-stream"></span>
                                                                    @elseif($x->status_pendaftaran == 'Selesai')
                                                                        <span class="badge badge-primary">Selesai<span
                                                                                class="ms-1 fa fa-check"></span>
                                                                        @else
                                                                            <span class="badge badge-danger">Not Found<span
                                                                                    class="ms-1 fa fa-ban"></span>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="dropdown text-sans-serif"><button
                                                                    class="btn btn-primary tp-btn-light sharp" type="button"
                                                                    id="order-dropdown-7" data-bs-toggle="dropdown"
                                                                    data-boundary="viewport" aria-haspopup="true"
                                                                    aria-expanded="false"><span><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="18px" height="18px" viewbox="0 0 24 24"
                                                                            version="1.1">
                                                                            <g stroke="none" stroke-width="1" fill="none"
                                                                                fill-rule="evenodd">
                                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                                <circle fill="#000000" cx="5" cy="12" r="2">
                                                                                </circle>
                                                                                <circle fill="#000000" cx="12" cy="12" r="2">
                                                                                </circle>
                                                                                <circle fill="#000000" cx="19" cy="12" r="2">
                                                                                </circle>
                                                                            </g>
                                                                        </svg></span></button>
                                                                <div class="dropdown-menu dropdown-menu-end border py-0"
                                                                    aria-labelledby="order-dropdown-7">
                                                                    <div class="py-2"><a class="dropdown-item"
                                                                            href="/verified-registration/{{ $x->id_pendaftaran }}">Terverifikasi</a><a
                                                                            class="dropdown-item"
                                                                            href="/notverified-registration/{{ $x->id_pendaftaran }}">Belum
                                                                            Terverifikasi</a>
                                                                        <div class="dropdown-divider"></div><a
                                                                            class="dropdown-item text-danger"
                                                                            href="/invalid-registration/{{ $x->id_pendaftaran }}">Tidak
                                                                            Sah</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a class="btn btn-light shadow btn-xs sharp me-1"
                                                            title="Detail Registration"
                                                            href="detail-registration/{{ $x->id_pendaftaran }}"><i
                                                                class="fa fa-file-alt"></i></a>
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit"
                                                            href="edit-registration/{{ $x->id_pendaftaran }}"><i
                                                                class="fa fa-pencil-alt"></i></a>
                                                        <a class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".delete{{ $x->id_pendaftaran }}"></i></a>
                                                        <div class="modal fade delete{{ $x->id_pendaftaran }}" tabindex="-1"
                                                            role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-sm">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Hapus Data</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal">
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center"><i
                                                                            class="fa fa-trash"></i><br> Anda yakin ingin
                                                                        menghapus data ini?<br>{{ $x->id_pendaftaran }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light"
                                                                            data-bs-dismiss="modal">Batalkan</button>
                                                                        <a
                                                                            href="delete-registration/{{ $x->id_pendaftaran }}">
                                                                            <button type="submit" class="btn btn-danger shadow">
                                                                                Ya, Hapus Data!
                                                                            </button></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif(auth()->user()->role == 'Calon Mahasiswa')

            <div class="project-page d-flex justify-content-between align-items-center flex-wrap">
                <div class="project mb-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#AllStatus" role="tab">Semua Pendaftaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#OnProgress" role="tab">Sedang Berjalan</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Finish" role="tab">Selesai/Lihat
                                Pengumuman</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#Closed" role="tab">Dibatalkan</a>
                        </li>
                    </ul>
                </div>
                <div class="mb-4">
                    @php
                        $no = 0;
                    @endphp
                    @foreach ($viewData as $x)
                        @if (auth()->user()->email == $x->email)
                            @php
                                $no = $no + 1;
                            @endphp
                        @endif
                    @endforeach
                    @if ($no == 0)
                        <a href="form-registration" class="btn btn-primary btn-rounded fs-18">+ Daftar Seleksi</a>
                    @endif
                </div>
            </div>
            @php
                $no = 0;
            @endphp
            @foreach ($viewData as $x)
                @if (auth()->user()->email == $x->email)
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="tab-content">
                                <div class="tab-pane fade active show" id="AllStatus">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center">
                                                <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                                    <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                        style="margin-top: -1.5rem"><strong>{{ $x->id_pendaftaran }}</strong>
                                                    </span>
                                                    <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                            class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                        {{ $x->tgl_pendaftaran }}</span>
                                                </div>
                                                <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                    <div class="d-flex project-image">
                                                        <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                        <div>
                                                            <small class="d-block fs-16 font-w400"
                                                                style="margin-top: -1rem">Pendaftar</small>
                                                            <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-xl-3  col-lg-6 col-sm-6 mb-sm-4 mb-0">
                                                    <div class="d-flex project-image">
                                                        <svg class="me-3" width="55" height="55" viewbox="0 0 55 55"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="27.5" cy="27.5" r="27.5" fill="#886CC0"></circle>
                                                            <g clip-path="url(#clip0)">
                                                                <path
                                                                    d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                    fill="white"></path>
                                                            </g>
                                                            <defs>
                                                                <clippath>
                                                                    <rect width="24" height="24" fill="white"
                                                                        transform="translate(16 15)"></rect>
                                                                </clippath>
                                                            </defs>
                                                        </svg>
                                                        <div>
                                                            <small
                                                                class="d-block fs-16 font-w400">{{ $x->gelombang }}</small>
                                                            <span class="fs-18 font-w500">{{ $x->pil1 }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                    <div class="d-flex justify-content-end project-btn">
                                                        @if ($x->status_pendaftaran == 'Belum Terverifikasi')
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-warning fs-16 font-w600">Belum <br>
                                                                Terverifikasi</a>
                                                        @elseif ($x->status_pendaftaran == 'Terverifikasi')
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-success fs-16 font-w600">Terverifikasi</a>
                                                        @elseif ($x->status_pendaftaran == 'Selesai')
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-success fs-16 font-w600">Selesai</a>
                                                        @else
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-danger fs-16 font-w600">Tidak
                                                                Sah</a>
                                                        @endif
                                                        <div class="dropdown ms-4  mt-auto mb-auto">
                                                            <div class="btn-link" data-bs-toggle="dropdown">
                                                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                        stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                        stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                    <path
                                                                        d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                        stroke="#737B8B" stroke-width="2" stroke-linecap="round"
                                                                        stroke-linejoin="round"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                <a class="dropdown-item"
                                                                    href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                    Selengkapnya</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="OnProgress">
                                    @if ($x->status_pendaftaran == 'Belum Terverifikasi' || $x->status_pendaftaran == 'Terverifikasi')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                                        <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                            style="margin-top: -1.5rem">{{ $x->id_pendaftaran }}</span>
                                                        <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                                class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                            {{ $x->tgl_pendaftaran }}</span>
                                                    </div>
                                                    <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                        <div class="d-flex project-image">
                                                            <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                            <div>
                                                                <small class="d-block fs-16 font-w400"
                                                                    style="margin-top: -1rem">Pendaftar</small>
                                                                <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3  col-lg-6 col-sm-6 mb-sm-4 mb-0">
                                                        <div class="d-flex project-image">
                                                            <svg class="me-3" width="55" height="55"
                                                                viewbox="0 0 55 55" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="27.5" cy="27.5" r="27.5" fill="#886CC0"></circle>
                                                                <g clip-path="url(#clip0)">
                                                                    <path
                                                                        d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clippath>
                                                                        <rect width="24" height="24" fill="white"
                                                                            transform="translate(16 15)"></rect>
                                                                    </clippath>
                                                                </defs>
                                                            </svg>
                                                            <div>
                                                                <small
                                                                    class="d-block fs-16 font-w400">{{ $x->gelombang }}</small>
                                                                <span class="fs-18 font-w500">{{ $x->pil1 }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                        <div class="d-flex justify-content-end project-btn">
                                                            @if ($x->status_pendaftaran == 'Belum Terverifikasi')
                                                                <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                    class=" btn bgl-warning text-warning fs-16 font-w600">Belum
                                                                    <br> Terverifikasi</a>
                                                            @elseif ($x->status_pendaftaran == 'Terverifikasi')
                                                                <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                    class=" btn bgl-warning text-success fs-16 font-w600">Terverifikasi</a>
                                                            @endif
                                                            <div class="dropdown ms-4  mt-auto mb-auto">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                        Selengkapnya</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    @endif

                                </div>
                                <div class="tab-pane fade" id="Finish">
                                    @if ($x->status_pendaftaran == 'Selesai')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                                        <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                            style="margin-top: -1.5rem">{{ $x->id_pendaftaran }}</span>
                                                        <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                                class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                            {{ $x->tgl_pendaftaran }}</span>
                                                    </div>
                                                    <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                        <div class="d-flex project-image">
                                                            <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                            <div>
                                                                <small class="d-block fs-16 font-w400"
                                                                    style="margin-top: -1rem">Pendaftar</small>
                                                                <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3  col-lg-6 col-sm-6 mb-sm-4 mb-0">
                                                        <div class="d-flex project-image">
                                                            <svg class="me-3" width="55" height="55"
                                                                viewbox="0 0 55 55" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="27.5" cy="27.5" r="27.5" fill="#886CC0"></circle>
                                                                <g clip-path="url(#clip0)">
                                                                    <path
                                                                        d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clippath>
                                                                        <rect width="24" height="24" fill="white"
                                                                            transform="translate(16 15)"></rect>
                                                                    </clippath>
                                                                </defs>
                                                            </svg>
                                                            <div>
                                                                <small
                                                                    class="d-block fs-16 font-w400">{{ $x->gelombang }}</small>
                                                                <span class="fs-18 font-w500">{{ $x->pil1 }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                        <div class="d-flex justify-content-end project-btn">
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-success fs-16 font-w600">Selesai</a>
                                                            <div class="dropdown ms-4  mt-auto mb-auto">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                        Selengkapnya</a>
                                                                    <a class="dropdown-item"
                                                                        href="view-announcement/{{ $x->id_pendaftaran }}">Lihat
                                                                        Hasil Seleksi</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="Closed">
                                    @if ($x->status_pendaftaran == 'Tidak Sah')
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row align-items-center">
                                                    <div class="col-xl-4  col-lg-6 col-sm-12 align-items-center customers">
                                                        <span class="text-primary d-block fs-18 font-w500 mb-1"
                                                            style="margin-top: -1.5rem">{{ $x->id_pendaftaran }}</span>
                                                        <span class="d-block mb-lg-0 mb-0 fs-16"><i
                                                                class="fas fa-calendar me-3"></i>Didaftarkan tanggal
                                                            {{ $x->tgl_pendaftaran }}</span>
                                                    </div>
                                                    <div class="col-xl-3  col-lg-3 col-sm-4  col-6 mb-3">
                                                        <div class="d-flex project-image">
                                                            <img src="{{ url('/' . $x->pas_foto) }}" alt="">
                                                            <div>
                                                                <small class="d-block fs-16 font-w400"
                                                                    style="margin-top: -1rem">Pendaftar</small>
                                                                <span class="fs-18 font-w500">{{ $x->nama_siswa }}</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-3  col-lg-6 col-sm-6 mb-sm-4 mb-0">
                                                        <div class="d-flex project-image">
                                                            <svg class="me-3" width="55" height="55"
                                                                viewbox="0 0 55 55" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="27.5" cy="27.5" r="27.5" fill="#886CC0"></circle>
                                                                <g clip-path="url(#clip0)">
                                                                    <path
                                                                        d="M37.2961 23.6858C37.1797 23.4406 36.9325 23.2843 36.661 23.2843H29.6088L33.8773 16.0608C34.0057 15.8435 34.0077 15.5738 33.8826 15.3546C33.7574 15.1354 33.5244 14.9999 33.2719 15L27.2468 15.0007C26.9968 15.0008 26.7656 15.1335 26.6396 15.3495L18.7318 28.905C18.6049 29.1224 18.604 29.3911 18.7294 29.6094C18.8548 29.8277 19.0873 29.9624 19.3391 29.9624H26.3464L24.3054 38.1263C24.2255 38.4457 24.3781 38.7779 24.6725 38.9255C24.7729 38.9757 24.8806 39 24.9872 39C25.1933 39 25.3952 38.9094 25.5324 38.7413L37.2058 24.4319C37.3774 24.2215 37.4126 23.931 37.2961 23.6858Z"
                                                                        fill="white"></path>
                                                                </g>
                                                                <defs>
                                                                    <clippath>
                                                                        <rect width="24" height="24" fill="white"
                                                                            transform="translate(16 15)"></rect>
                                                                    </clippath>
                                                                </defs>
                                                            </svg>
                                                            <div>
                                                                <small
                                                                    class="d-block fs-16 font-w400">{{ $x->gelombang }}</small>
                                                                <span class="fs-18 font-w500">{{ $x->pil1 }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-2  col-lg-6 col-sm-4 mb-sm-3 mb-3 text-end">
                                                        <div class="d-flex justify-content-end project-btn">
                                                            <a href="detail-registration/{{ $x->id_pendaftaran }}"
                                                                class=" btn bgl-warning text-danger fs-16 font-w600">Tidak
                                                                Sah</a>
                                                            <div class="dropdown ms-4  mt-auto mb-auto">
                                                                <div class="btn-link" data-bs-toggle="dropdown">
                                                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11 12C11 12.5523 11.4477 13 12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M18 12C18 12.5523 18.4477 13 19 13C19.5523 13 20 12.5523 20 12C20 11.4477 19.5523 11 19 11C18.4477 11 18 11.4477 18 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                        <path
                                                                            d="M4 12C4 12.5523 4.44772 13 5 13C5.55228 13 6 12.5523 6 12C6 11.4477 5.55228 11 5 11C4.44772 11 4 11.4477 4 12Z"
                                                                            stroke="#737B8B" stroke-width="2"
                                                                            stroke-linecap="round" stroke-linejoin="round">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <a class="dropdown-item"
                                                                        href="detail-registration/{{ $x->id_pendaftaran }}">Lihat
                                                                        Selengkapnya</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @php
                                    $no = $no + 1;
                                @endphp
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
            @if ($no == 0)
                <div class="alert alert-primary alert-dismissible alert-alt fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
                    </button>
                    <strong>Haii!</strong> Kamu belum melakukan pendaftaran silahkan daftar dan ikuti proses kegiatannya ya.
                </div>
            @endif
        @endif
    @endauth
@endsection

@section('footer')
@endsection
