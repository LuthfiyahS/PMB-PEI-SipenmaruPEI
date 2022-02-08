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
    <li><a href="data-announcement" aria-expanded="false">
            <i class="fa fa-file"></i>
            <span class="nav-text">Pengumuman</span>
        </a>
    </li>
    <li><a href="#" aria-expanded="false">
            <i class="fa fa-download"></i>
            <span class="nav-text">Pusat Unduhan</span>
        </a>
    </li>
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
                                                <span>Terus pantau kegiatan penerimaan mahasiswa baru politeknik enjinering indorama</span>
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
                                        <div class="card-header border-0 flex-wrap">
                                            <h4 class="fs-20 font-w700 mb-2">Project Statistics</h4>
                                            <div class="d-flex align-items-center project-tab mb-2">
                                                <div class="card-tabs mt-3 mt-sm-0 mb-3 ">
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-bs-toggle="tab" href="#monthly"
                                                                role="tab">Monthly</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Weekly"
                                                                role="tab">Weekly</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-bs-toggle="tab" href="#Today"
                                                                role="tab">Today</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="dropdown ms-2">
                                                    <div class="btn-link" data-bs-toggle="dropdown">
                                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="12.4999" cy="3.5" r="2.5" fill="#A5A5A5">
                                                            </circle>
                                                            <circle cx="12.4999" cy="11.5" r="2.5" fill="#A5A5A5">
                                                            </circle>
                                                            <circle cx="12.4999" cy="19.5" r="2.5" fill="#A5A5A5">
                                                            </circle>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                                <div class="d-flex">
                                                    <div class="d-inline-block position-relative donut-chart-sale mb-3">
                                                        <span class="donut1"
                                                            data-peity='{ "fill": ["rgba(136,108,192,1)", "rgba(241, 234, 255, 1)"],   "innerRadius": 20, "radius": 15}'>5/8</span>
                                                    </div>
                                                    @foreach ($viewTotal as $x)
                                                        <div class="ms-3">
                                                            <h4 class="fs-24 font-w700 ">{{ $x->jmlpendaftarkeseluruhan }}
                                                            </h4>
                                                            <span class="fs-16 font-w400 d-block">Total Pendaftar</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="d-flex">
                                                    <div class="d-flex me-5">
                                                        <div class="mt-2">
                                                            <svg width="13" height="13" viewbox="0 0 13 13" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="6.5" cy="6.5" r="6.5" fill="#FFCF6D">
                                                                </circle>
                                                            </svg>
                                                        </div>
                                                        <div class="ms-3">
                                                            <h4 class="fs-24 font-w700 ">246</h4>
                                                            <span class="fs-16 font-w400 d-block">On Going</span>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex">
                                                        <div class="mt-2">
                                                            <svg width="13" height="13" viewbox="0 0 13 13" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <circle cx="6.5" cy="6.5" r="6.5" fill="#FFA7D7">
                                                                </circle>
                                                            </svg>

                                                        </div>
                                                        <div class="ms-3">
                                                            <h4 class="fs-24 font-w700 ">28</h4>
                                                            <span class="fs-16 font-w400 d-block">Unfinished</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-content">
                                                <div class="tab-pane fade active show" id="monthly">
                                                    <div id="chartBar" class="chartBar"></div>
                                                </div>
                                                <div class="tab-pane fade" id="Weekly">
                                                    <div id="chartBar1" class="chartBar"></div>
                                                </div>
                                                <div class="tab-pane fade" id="Today">
                                                    <div id="chartBar2" class="chartBar"></div>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <label class="form-check-label font-w400 fs-16 mb-0"
                                                    for="flexSwitchCheckChecked1">Number</label>
                                                <div class="form-check form-switch toggle-switch">
                                                    <input class="form-check-input custome" type="checkbox"
                                                        id="flexSwitchCheckChecked1" checked="">

                                                </div>
                                                <label class="form-check-label font-w400 fs-16 mb-0 ms-3"
                                                    for="flexSwitchCheckChecked2">Analytics</label>
                                                <div class="form-check form-switch toggle-switch">
                                                    <input class="form-check-input custome" type="checkbox"
                                                        id="flexSwitchCheckChecked2" checked="">
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
                                                            <h2 class="fs-32 font-w700 mb-0">{{$jmlpendaftar}}</h2>
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
                                                        $no=1;
                                                    @endphp
                                                    <div id="columnChart">
                                                        @foreach ($jmlpendaftarprodi as $x)
                                                            <span id="prodi{{$no}}" style="color:transparent" aria-disabled>{{$x->jmldaftarprodi}}</span>
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
                                                            @if ($x->hasil_seleksi=="LULUS")
                                                                @php
                                                                $a=$x->jumlah
                                                                @endphp
                                                            @elseif ($x->hasil_seleksi=="TIDAK LULUS")
                                                                @php
                                                                $b=$x->jumlah
                                                                @endphp
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            $hasil=$a+$b;
                                                            $hasilpersenan=$hasil*100/$jmlpendaftar
                                                        @endphp
                                                                <div class="progress-bar bg-gradient1 progress-animated"
                                                                    style="width: {{ $hasilpersenan }}%; height:10px;"
                                                                    role="progressbar">
                                                                </div>

                                                    </div>
                                                    @foreach ($viewTotal as $x)
                                                        <div class="d-flex align-items-end mt-2 pb-3 justify-content-between">
                                                            <span>{{ $hasil }} yang telah diberi <br> pengumuman, dari</span>
                                                            <h4 class="mb-0">{{ $jmlpendaftar }}</h4>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card">
                                                <div class="card-body d-flex px-4  justify-content-between">
                                                    <div>
                                                        <div class="">
                                                            <h2 class="fs-32 font-w700">{{$jmluser}}</h2>
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
                                                            <h2 class="fs-32 font-w700">892</h2>
                                                            <span class="fs-18 font-w500 d-block">New
                                                                Projects</span>
                                                            <span class="d-block fs-16 font-w400"><small
                                                                    class="text-success">-2%</small> than last
                                                                month</span>
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
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6 col-sm-6">
                                                    <div class=" owl-carousel card-slider">
                                                        <div class="items">
                                                            <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile
                                                                Website Project</h4>
                                                            <span class="fs-14 font-w400">Sed ut perspiciatis unde
                                                                omnis iste natus error sit voluptatem accusantium
                                                                doloremque </span>
                                                        </div>
                                                        <div class="items">
                                                            <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile
                                                                Website Project</h4>
                                                            <span class="fs-14 font-w400">Sed ut perspiciatis unde
                                                                omnis iste natus error sit voluptatem accusantium
                                                                doloremque </span>
                                                        </div>
                                                        <div class="items">
                                                            <h4 class="fs-20 font-w700 mb-4">Fillow Company Profile
                                                                Website Project</h4>
                                                            <span class="fs-14 font-w400">Sed ut perspiciatis unde
                                                                omnis iste natus error sit voluptatem accusantium
                                                                doloremque </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 redial col-sm-6">
                                                    <div id="redial"></div>
                                                    <span class="text-center d-block fs-18 font-w600">On Progress
                                                        <small class="text-success"><span id="progressnya">20</span>
                                                            %</small></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-header border-0 pb-0">
                                            <h4 class="card-title">Timeline 2</h4>
                                        </div>
                                        <div class="card-body">
                                            <div id="DZ_W_TimeLine11" class="widget-timeline dlab-scroll style-1 height370">
                                                <ul class="timeline">
                                                    <li>
                                                        <div class="timeline-badge primary"></div>
                                                        <a class="timeline-panel text-muted" href="#">
                                                            <span>10 minutes ago</span>
                                                            <h6 class="mb-0">Youtube, a video-sharing website, goes
                                                                live <strong class="text-primary">$500</strong>.
                                                            </h6>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge info">
                                                        </div>
                                                        <a class="timeline-panel text-muted" href="#">
                                                            <span>20 minutes ago</span>
                                                            <h6 class="mb-0">New order placed <strong
                                                                    class="text-info">#XF-2356.</strong></h6>
                                                            <p class="mb-0">Quisque a consequat ante Sit amet magna
                                                                at volutapt...</p>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge danger">
                                                        </div>
                                                        <a class="timeline-panel text-muted" href="#">
                                                            <span>30 minutes ago</span>
                                                            <h6 class="mb-0">john just buy your product <strong
                                                                    class="text-warning">Sell $250</strong></h6>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge success">
                                                        </div>
                                                        <a class="timeline-panel text-muted" href="#">
                                                            <span>15 minutes ago</span>
                                                            <h6 class="mb-0">StumbleUpon is acquired by eBay. </h6>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge warning">
                                                        </div>
                                                        <a class="timeline-panel text-muted" href="#">
                                                            <span>20 minutes ago</span>
                                                            <h6 class="mb-0">Mashable, a news website and blog, goes
                                                                live.</h6>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <div class="timeline-badge dark">
                                                        </div>
                                                        <a class="timeline-panel text-muted" href="#">
                                                            <span>20 minutes ago</span>
                                                            <h6 class="mb-0">Mashable, a news website and blog, goes
                                                                live.</h6>
                                                        </a>
                                                    </li>
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

                            <!-- center modal -->
                            <a href="form-registration"><button type="button" class="btn btn-primary mb-4"
                                    style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Add Registration</button></a>
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
            <div class="row">
                    <div class="col-lg-3">
                        <div class="card card-body bg-primary">
                            <h4 class="fs-20 font-w700" style="color: whitesmoke">Teknologi <br> Mesin</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body" style="background-color: rgb(165, 66, 0)">
                            <h4 class="fs-20 font-w700" style="color: whitesmoke">Teknologi <br> Mekatronika</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body"  style="background-color: rgb(207, 142, 0)">
                            <h4 class="fs-20 font-w700" style="color: whitesmoke">Teknologi <br> Listrik</h4>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card card-body"  style="background-color: rgb(104, 64, 38)">
                            <h4 class="fs-20 font-w700" style="color: whitesmoke">Teknologi Rekayasa Perangkat Lunak</h4>
                        </div>
                    </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-4 col-sm-4">
                                    <div class="card-body owl-carousel card-slider">
                                        <div class="items">
                                            <h3 class="fs-20 font-w700 mb-4">Sistem Perkuliahan</h3>
                                            <span class="fs-18 font-w400">
                                                Keterampilan lebih terasah dengan 60 – 70% perkuliahan secara praktik. </span>
                                        </div>
                                        <div class="items">
                                            <h3 class="fs-20 font-w700 mb-4">Penempatan Kerja</h3>
                                            <span class="fs-18 font-w400">Bantuan penempatan kerja dengan jaringan yang luas
                                                baik
                                                dalam dan luar negeri. </span>
                                        </div>
                                        <div class="items">
                                            <h3 class="fs-20 font-w700 mb-4">Biaya Perkuliahan</h3>
                                            <span class="fs-18 font-w400">Biaya perkuliahan yang dapat diangsur dan berbagai
                                                program beasiswa. </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-8 col-sm-8">
                                    <div style="text-align: center;">
                                        <img src="{{ asset('sipenmaru/images/banner1.png') }}" alt="" height="250px">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="card transparent-card">
                    <div class="card-header d-block">
                        <h4 class="card-title">Informasi Umum</h4>
                    </div>
                    <div class="card-body">
                        <div class="accordion accordion-header-shadow accordion-rounded" id="accordion-ten">
                            <div class="accordion-item">
                                <div class="accordion-header  rounded-lg" id="accord-10One" data-bs-toggle="collapse"
                                    data-bs-target="#collapse10One" aria-controls="collapse10One" aria-expanded="true"
                                    role="button">
                                    <span class="accordion-header-icon"></span>
                                    <span class="accordion-header-text">Sudah kenal dengan Politeknik Enjinering Indorama?</span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="collapse10One" class="collapse accordion__body show" aria-labelledby="accord-10One"
                                    data-bs-parent="#accordion-ten">
                                    <div class="accordion-body-text">
                                        <span class="fs-16 font-w400">
                                        <h5 style="text-indent: 0.5in;text-align: justify;">PEI adalah kampus luas yang dirancang dengan fasilitas yang menyeluruh untuk pendidikan teknik yang berkualitas. PEI menghasilkan sumber daya manusia bidang teknik berkualitas tinggi untuk industri. PEI memiliki visi untuk menjadi lembaga pendidikan vokasi kelas dunia.</h5>
                                        <h5 style="text-indent: 0.5in;text-align: justify;">PT Indo-Rama Synthetic Tbk, sebagai organisasi manufaktur, sangat merasakan perlunya turut serta dalam memajukan pendidikan vokasi di negara ini demi manfaat bersama bagi para calon mahasiswa pada khususnya dan industri pada umumnya. Untuk memenuhi tujuan ini, sebagai bagian dari program Corporate Social Responsibility, kampus hijau Politeknik Enjinering Indorama didirikan di Purwakarta pada tahun 2013 di atas tanah subur seluas 6 hektar dengan investasi sebesar 6 juta dolar. Politeknik Enjinering Indorama akan mengantarkan para mahasiswa-mahasiswinya meraih gelar Ahli Madya dan Sarjana Terapan di bidang vokasi. Politeknik Enjinering Indorama (PEI) merupakan lembaga nirlaba. Kelebihan kas dialokasikan kembali untuk pembangunan infrastruktur. PEI juga didukung oleh Pemerintah Daerah dan perusahaan melalui program beasiswa bagi siswa berprestasi untuk melanjutkan studi. PEI juga bekerja sama dengan berbagai universitas lokal dan internasional dalam menyediakan pendidikan vokasi berkualitas tinggi.</h5>
                                        <h5 style="text-indent: 0.5in;text-align: justify;">PEI berdiri dengan ditandai diterbitkannya Surat Keputusan Menteri Pendidikan dan Kebudayaan Nomor 273/E/O/2013 tanggal 18 Juli 2013 yang diikuti dengan peresmian kampus PEI pada tanggal 23 September 2013 oleh Menteri Pendidikan & Kebudayaan dan Menteri Perindustrian & Perdagangan. Sejak diresmikan, beberapa pejabat senior seperti para Menteri, Duta Besar, CEO, pejabat tinggi, Ahli, dan perwakilan organisasi telah berkunjung ke PEI. Dari kunjungan-kunjungan tersebut, terciptalah upaya-upaya bersama dalam penyetaraan dengan institusi terkemuka lainnya, sehingga terwujud perkembangan yang berkelanjutan.</h5>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header collapsed rounded-lg" id="accord-10Two" data-bs-toggle="collapse"
                                    data-bs-target="#collapse10Two" aria-controls="collapse10Two" aria-expanded="true"
                                    role="button">
                                    <span class="accordion-header-icon"></span>
                                    <span class="accordion-header-text">Accordion Header Two</span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="collapse10Two" class="collapse accordion__body" aria-labelledby="accord-10Two"
                                    data-bs-parent="#accordion-ten">
                                    <div class="accordion-body-text">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                        squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa
                                        nesciunt laborum eiusmod.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header collapsed rounded-lg" id="accord-10Three"
                                    data-bs-toggle="collapse" data-bs-target="#collapse10Three" aria-controls="collapse9Three"
                                    aria-expanded="true" role="button">
                                    <span class="accordion-header-icon"></span>
                                    <span class="accordion-header-text">Accordion Header Three</span>
                                    <span class="accordion-header-indicator"></span>
                                </div>
                                <div id="collapse10Three" class="collapse accordion__body" aria-labelledby="accord-10Three"
                                    data-bs-parent="#accordion-ten">
                                    <div class="accordion-body-text">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                        squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck
                                        quinoa
                                        nesciunt laborum eiusmod.
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
