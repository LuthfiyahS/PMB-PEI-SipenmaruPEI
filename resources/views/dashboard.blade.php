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
    Beranda
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
            <!--<li><a href="#" aria-expanded="false">
                    <i class="fa fa-download"></i>
                    <span class="nav-text">Pusat Unduhan</span>
                </a>
            </li>-->
        </ul>
    @endauth
@endsection

@section('content')
    <!--Buat Admin-->
    @auth
        @if (auth()->user()->role == 'Administrator')
            <div class="row">
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card tryal-gradient">
                                        <div class="card-body tryal row">
                                            <div class="col-xl-7 col-sm-6">
                                                <h2>Selamat Datang, @auth
                                                        {{ auth()->user()->name }}
                                                    @endauth</h2>
                                                <span>Terus pantau kegiatan penerimaan mahasiswa baru politeknik enjinering
                                                    indorama</span>
                                                <a href="data-registration" class="btn btn-rounded  fs-18 font-w500">Lihat
                                                    pendaftar</a>
                                            </div>
                                            <div class="col-xl-5 col-sm-6">
                                                <img src="{{ asset('sipenmaru/images/chart.png') }}" alt=""
                                                    class="sd-shape">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-6">
                                                    <div class="items">
                                                        <h4 class="fs-20 font-w700 mb-4">Data Progress <br> Penerimaan Mahasiswa
                                                            Baru</h4>
                                                        <span class="fs-14 font-w400">Data yang baru masuk dan telah
                                                            diverifikasi oleh admin akan dapat melanjutkan kegiatan
                                                            penerimaan</span>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 redial col-sm-6">
                                                    @php
                                                        $aa = 0;
                                                        $bb = 0;
                                                    @endphp
                                                    @foreach ($viewTotal as $x)
                                                        @if ($x->status_pendaftaran == 'Belum Terverifikasi')
                                                            @php
                                                                $aa = $x->jumlah;
                                                            @endphp
                                                        @elseif ($x->status_pendaftaran == 'Terverifikasi')
                                                            @php
                                                                $bb = $x->jumlah;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    @php
                                                        $hsl = $aa + $bb;
                                                        $hslpersenanbaru = ($hsl * 100) / $jmlpendaftar;
                                                    @endphp

                                                    <div id="redial"></div>
                                                    <span class="text-center d-block fs-18 font-w600">Sedang berlangsung
                                                        <small class="text-success"><span
                                                                id="progressnya">{{ $hslpersenanbaru }}</span>
                                                            %</small></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body d-flex px-4 pb-0 justify-content-between">
                                                    <div>
                                                        <h4 class="fs-18 font-w600 mb-4 text-nowrap">Pendaftar
                                                        </h4>
                                                        <div class="d-flex align-items-center">
                                                            <h2 class="fs-32 font-w700 mb-0">{{ $jmlpendaftar }}</h2>
                                                            <!--<span class="d-block ms-4">
                                                                        <svg width="21" height="11" viewbox="0 0 21 11" fill="none"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="M1.49217 11C0.590508 11 0.149368 9.9006 0.800944 9.27736L9.80878 0.66117C10.1954 0.29136 10.8046 0.291359 11.1912 0.661169L20.1991 9.27736C20.8506 9.9006 20.4095 11 19.5078 11H1.49217Z"
                                                                                fill="#09BD3C"></path>
                                                                        </svg>
                                                                        <small
                                                                            class="d-block fs-16 font-w400 text-success">+0,5%</small>
                                                                    </span>-->
                                                        </div>

                                                        <span class="fs-16 font-w400">Pendaftar saat ini </span>
                                                    </div>
                                                    @php
                                                        $no = 1;
                                                    @endphp
                                                    <div id="columnChart">
                                                        @foreach ($jmlpendaftarprodi as $x)
                                                            <span id="prodi{{ $no }}" style="color:transparent"
                                                                aria-disabled>{{ $x->jmldaftarprodi }}</span>
                                                            @php
                                                                $no++;
                                                            @endphp
                                                        @endforeach


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body px-4 pb-0">
                                                    <h4 class="fs-18 font-w600 mb-5 text-nowrap">Hasil Seleksi Pendaftar</h4>
                                                    <div class="progress default-progress">


                                                        @foreach ($jmlpengumuman as $x)
                                                            @if ($x->hasil_seleksi == 'LULUS')
                                                                @php
                                                                    $a = $x->jumlah;
                                                                @endphp
                                                            @elseif ($x->hasil_seleksi == 'TIDAK LULUS')
                                                                @php
                                                                    $b = $x->jumlah;
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            $hasil = $a + $b;
                                                            $hasilpersenan = ($hasil * 100) / $jmlpendaftar;
                                                        @endphp
                                                        <div class="progress-bar bg-gradient1 progress-animated"
                                                            style="width: {{ $hasilpersenan }}%; height:10px;"
                                                            role="progressbar">
                                                        </div>

                                                    </div>
                                                    <div class="d-flex align-items-end mt-2 pb-3 justify-content-between">
                                                        <span>{{ $hasil }} yang telah diberi <br> pengumuman, dari</span>
                                                        <h4 class="mb-0">{{ $jmlpendaftar }}</h4>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body d-flex px-4  justify-content-between">
                                                    <div>
                                                        <div class="">
                                                            <h4 class="fs-32 font-w700">{{ $jmluser }}</h4>
                                                            <span class="fs-18 font-w500 d-block">Total
                                                                Pengguna</span></span>
                                                        </div>
                                                    </div>
                                                    <div id="NewCustomers"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body d-flex px-4  justify-content-between">
                                                    <div>
                                                        <div class="">
                                                            <h4 class="fs-32 font-w700">{{ $jmlbayar * 150000 }}</h4>
                                                            <span class="fs-18 font-w500 d-block">Jumlah Pembayaran</span>
                                                        </div>
                                                    </div>
                                                    <div id="NewCustomers1"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <h4 class="card-title">Linimasa </h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="DZ_W_TimeLine11" class="widget-timeline dlab-scroll style-1 height150">
                                                <ul class="timeline">
                                                    @foreach ($timeline as $item)
                                                        <li> @php
                                                            $no = 1;
                                                        @endphp
                                                            @foreach ($viewDataUser as $x)
                                                                @if ($x->Id_user == $item->id_user && $no == 1)
                                                                    <div class="timeline-badge primary"></div>
                                                                    <a class="timeline-panel text-muted" href="#">
                                                                        <span>{{ $item->tgl_update }}</span>
                                                                        <h6 class="mb-0"><strong
                                                                                class="text-primary">
                                                                                {{ $x->Nama }}
                                                                            </strong>,{{ $item->status }}.
                                                                        </h6>
                                                                    </a>
                                                                @elseif ($x->Id_user != $item->id_user && $no == 1)
                                                                    <div class="timeline-badge warning">
                                                                    </div>
                                                                    <a class="timeline-panel text-muted" href="#">
                                                                        <span>{{ $item->tgl_update }}</span>
                                                                        <h6 class="mb-0">{{ $item->id_user }},
                                                                            {{ $item->status }}.</h6>
                                                                    </a>
                                                                @endif
                                                                @php
                                                                    $no++;
                                                                @endphp
                                                            @endforeach
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Data Pendaftaran</h4>
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
                                        @foreach ($pendaftar as $x)
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
                                                                    <span class="badge badge-warning">Belum Terverifikasi<span
                                                                            class="ms-1 fas fa-stream"></span>
                                                                    @elseif($x->status_pendaftaran == 'Tidak Sah')
                                                                        <span class="badge badge-info">Tidak Sesuai<span
                                                                                class="ms-1 fa fa-ban"></span>
                                                                        @else
                                                                            <span class="badge badge-danger">Not Found<span
                                                                                    class="ms-1 fa fa-search"></span>
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
                                                        <a class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash" data-bs-toggle="modal"
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
                                                                        menghapus data ini?{{ $x->id_pendaftaran }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger light"
                                                                            data-bs-dismiss="modal">Tidak</button>
                                                                        <a
                                                                            href="delete-registration/{{ $x->id_pendaftaran }}">
                                                                            <button type="submit"
                                                                                class="btn btn-danger shadow">
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
            <!--Buat Camaba-->
            <div class="row page-titles" style="border-radius: 0%">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active" style="color: var(--primary)"><a href="index"
                            style="color: var(--primary)">Beranda</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0)">PMB PEI</a></li>
                </ol>
            </div>
            <div class="row">
                <div class="col-xl-7">
                    <div class="card transparent-card">
                        <div class="bootstrap-carousel">
                            <div id="carouselExampleIndicators2" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="0"
                                        class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators2" data-bs-slide-to="1"
                                        aria-label="Slide 2"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img class="d-block w-100" src="{{ asset('sipenmaru/images/banner (1).png') }}"
                                            alt="First slide">
                                    </div>
                                    <div class="carousel-item">
                                        <img class="d-block w-100" src="{{ asset('sipenmaru/images/banner (2).png') }}"
                                            alt="Second slide">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleIndicators2" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleIndicators2" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5">
                    <div class="row">
                        <div class="card transparent-card">
                            <div class="widget-stat card bg-primary" style="border-radius: 0%">
                                <div class="card-body  p-4">
                                    <div class="media">
                                        <span class="me-3">
                                            <i class="la la-users"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">Total Students</p>
                                            <h3 class="text-white">3280</h3>
                                            <div class="progress mb-2 bg-secondary">
                                                <div class="progress-bar progress-animated bg-light" style="width: 80%"></div>
                                            </div>
                                            <small>80% Increase in 20 Days</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: -2.7rem">
                        <div class="card transparent-card">
                            <div class="widget-stat card bg-warning" style="border-radius: 0%">
                                <div class="card-body p-4">
                                    <div class="media">
                                        <span class="me-3">
                                            <i class="la la-user"></i>
                                        </span>
                                        <div class="media-body text-white">
                                            <p class="mb-1">New Students</p>
                                            <h3 class="text-white">245</h3>
                                            <div class="progress mb-2 bg-primary">
                                                <div class="progress-bar progress-animated bg-light" style="width: 50%"></div>
                                            </div>
                                            <small>50% Increase in 25 Days</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col-xl-3 col-lg-6 col-sm-6" style="padding: 0px">
                    <div class="card" style="border-radius: 0%;">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent">
                                    <img class="img-fluid" src="{{ asset('sipenmaru/images/mesin.jpg') }}" alt="">
                                    <div class="carousel-caption d-none d-md-block">
                                        <a href="ecom-product-detail.html"><h4 style="color: whitesmoke">Teknologi Mesin</h4></a>
                                        <p>Diploma 3</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6" style="padding: 0px">
                    <div class="card" style="border-radius: 0%">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent">
                                    <img class="img-fluid" src="{{ asset('sipenmaru/images/mekatronika.jpeg') }}"
                                        alt="">
                                        <div class="carousel-caption d-none d-md-block">
                                            <a href="ecom-product-detail.html"><h4 style="color: whitesmoke">Teknologi Mekatronika</h4></a>
                                            <p>Diploma 3</p>
                                        </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6" style="padding: 0px">
                    <div class="card" style="border-radius: 0%">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent">
                                    <img class="img-fluid" src="{{ asset('sipenmaru/images/listrik.jpg') }}" alt="">
                                    <div class="carousel-caption d-none d-md-block">
                                        <a href="ecom-product-detail.html"><h4 style="color: whitesmoke">Teknologi Listrik</h4></a>
                                        <p>Diploma 3</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-sm-6" style="padding: 0px">
                    <div class="card" style="border-radius: 0%">
                            <div class="new-arrival-product">
                                <div class="new-arrivals-img-contnent">
                                    <img class="img-fluid" src="{{ asset('sipenmaru/images/trpl.jpg') }}" alt="">
                                    <div class="carousel-caption d-none d-md-block" >
                                        <a href="ecom-product-detail.html"><h4  style="color: whitesmoke">Teknologi Rekayasa Perangkat Lunak</h4></a>
                                        <p>Diploma 4</p>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="card transparent-card">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-xl-3 col-lg-6  col-md-6 col-xxl-5 ">
                                            <!-- Tab panes -->
                                            <div class="tab-content">
                                                <div role="tabpanel" class="tab-pane fade show active" id="first">
                                                    <img class="img-fluid" src="{{ asset('sipenmaru/images/brosur1.jpeg') }}" alt="">
                                                </div>
                                                <div role="tabpanel" class="tab-pane fade" id="second">
                                                    <img class="img-fluid" src="{{ asset('sipenmaru/images/brosur2.jpeg') }}" alt="">
                                                </div>
                                            </div>
                                            <div class="tab-slide-content new-arrival-product mb-4 mb-xl-0">
                                                <!-- Nav tabs -->
                                                <ul class="nav slide-item-list mt-3" role="tablist">
                                                    <li role="presentation" class="show">
                                                        <a href="#first" role="tab" data-bs-toggle="tab">
                                                            <img class="img-fluid" src="{{ asset('sipenmaru/images/brosur1.jpeg') }}" alt="" width="50">
                                                        </a>
                                                    </li>
                                                    <li role="presentation">
                                                        <a href="#second" role="tab" data-bs-toggle="tab"><img class="img-fluid" src="{{ asset('sipenmaru/images/brosur2.jp3g') }}" alt="" width="50"></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <!--Tab slider End-->
                                        <div class="col-xl-9 col-lg-6  col-md-6 col-xxl-7 col-sm-12">
                                            <div class="product-detail-content">
                                                <!--Product details-->
                                                <div class="new-arrival-content pr">
                                                    <h3>Ketentuan Umum</h3>
                                                    <p>Availability: <span class="item"> In stock <i class="fa fa-shopping-basket"></i></span>
                                                    </p>
                                                    <p>Product code: <span class="item">0405689</span> </p>
                                                    <p>Brand: <span class="item">Lee</span></p>
                                                    <p>Product tags:&nbsp;&nbsp;
                                                        <span class="badge badge-success light">bags</span>
                                                        <span class="badge badge-success light">clothes</span>
                                                        <span class="badge badge-success light">shoes</span>
                                                        <span class="badge badge-success light">dresses</span>
                                                    </p>
                                                    <p class="text-content">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.
                                                        If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing.</p>
                                                    


                                                        <div class="custom-tab-1">
                                                        <ul class="nav nav-tabs">
                                                            <li class="nav-item"><a href="#jpk" data-bs-toggle="tab"
                                                                    class="nav-link active show">Jalur Prestasi Khusus</a>
                                                            </li>
                                                            <li class="nav-item"><a href="#profile-settings" data-bs-toggle="tab"
                                                                    class="nav-link">Jalur Reguler</a>
                                                            </li>
                                                        </li>
                                                        </ul>
                                                        <div class="profile-tab">
                                                        <div class="tab-content">
                                                            <div id="jpk" class="tab-pane fade active show">
                                                                <div class="profile-personal-info">
                                                                    yaaaa
                                                                </div>
                                                                <div class="profile-about-me">
                                                                    <div class="pt-4 border-bottom-1 pb-3">
                                                                        <h4 class="text-primary">JPK</h4>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-6 col-6">
                                                                            <h5 class="f-w-500"><i class="fas fa-envelope"></i>
                                                                                {{ auth()->user()->email }}
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-about-me">
                                                                    <div class="pt-4 border-bottom-1 pb-3">
                                                                        <h4 class="text-primary">Sosial Media</h4>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-3 col-5">
                                                                            <h2>
                                                                                sa
                                                                            </h2>
                                                                        </div>
                                                                        <div class="col-sm-9 col-7"><span>
                            
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-content">
                                                            <div id="jpk" class="tab-pane fade active show">
                                                                <div class="profile-about-me">
                                                                    <div class="pt-4 border-bottom-1 pb-3">
                                                                        <h4 class="text-primary">Jalur Reguler</h4>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-6 col-6">
                                                                            <h5 class="f-w-500"><i class="fas fa-envelope"></i>
                                                                                {{ auth()->user()->email }}
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="profile-about-me">
                                                                    <div class="pt-4 border-bottom-1 pb-3">
                                                                        <h4 class="text-primary">Sosial Media</h4>
                                                                    </div>
                                                                    <div class="row mb-2">
                                                                        <div class="col-sm-3 col-5">
                                                                            <h2>
                                                                                sa
                                                                            </h2>
                                                                        </div>
                                                                        <div class="col-sm-9 col-7"><span>
                            
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="d-flex align-items-end flex-wrap mt-4">
                                                        <div class="filtaring-area me-3">
                                                            <div class="size-filter">
                                                                <h4 class="m-b-15">Select size</h4>
                                                                
                                                                
                                                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                                                  <input type="radio" class="btn-check" name="btnradio" id="btnradio1" checked="">
                                                                  <label class="btn btn-outline-primary" for="btnradio1">XS</label>
        
                                                                  <input type="radio" class="btn-check" name="btnradio" id="btnradio2">
                                                                  <label class="btn btn-outline-primary" for="btnradio2">SM</label>
        
                                                                  <input type="radio" class="btn-check" name="btnradio" id="btnradio3">
                                                                  <label class="btn btn-outline-primary" for="btnradio3">MD</label>
                                                                  
                                                                  <input type="radio" class="btn-check" name="btnradio" id="btnradio4">
                                                                  <label class="btn btn-outline-primary" for="btnradio4">LG</label>
                                                                  
                                                                  <input type="radio" class="btn-check" name="btnradio" id="btnradio5">
                                                                  <label class="btn btn-outline-primary" for="btnradio5">XL</label>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <!--Quantity start-->
                                                        <div class="col-2 px-0  mb-2 me-3">
                                                            <input type="number" name="num" class="form-control input-btn input-number" value="1">
                                                        </div>
                                                        <!--Quanatity End-->
                                                        <div class="shopping-cart  mb-2 me-3">
                                                            <a class="btn btn-primary" href="javascript:void();"><i class="fa fa-shopping-basket me-2"></i>Add
                                                                to cart</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- review -->
                        <div class="modal fade" id="reviewModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Review</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="text-center mb-4">
                                                <img class="img-fluid rounded" width="78" src="images/avatar/1.jpg" alt="DexignZone">
                                            </div>
                                            <div class="mb-3">
                                                <div class="rating-widget mb-4 text-center">
                                                    <!-- Rating Stars Box -->
                                                    <div class="rating-stars">
                                                        <ul id="stars">
                                                            <li class="star" title="Poor" data-value="1">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="Fair" data-value="2">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="Good" data-value="3">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="Excellent" data-value="4">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                            <li class="star" title="WOW!!!" data-value="5">
                                                                <i class="fa fa-star fa-fw"></i>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <textarea class="form-control" placeholder="Comment" rows="5"></textarea>
                                            </div>
                                            <button class="btn btn-success btn-block">RATE</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth



@endsection

@section('footer')
@endsection
