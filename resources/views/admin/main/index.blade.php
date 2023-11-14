@extends('layouts.admin.main.t_main')

@section('title')
    <title>Admin - Dashboard</title>
@endsection

@section('sidebar')
    <div id="sidebar">
        <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <a href="{{ route('adminDashboard') }}"><img src="{{ asset('data/app/img/' . $dataApp['logo']) }}"
                                alt="Logo" srcset=""></a>
                    </div>
                    <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                            height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                            <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                    opacity=".3"></path>
                                <g transform="translate(-210 -1)">
                                    <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                    <circle cx="220.5" cy="11.5" r="4"></circle>
                                    <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                    </path>
                                </g>
                            </g>
                        </svg>
                        <div class="form-check form-switch fs-6">
                            <input class="form-check-input  me-0" type="checkbox" id="toggle-dark" style="cursor: pointer">
                            <label class="form-check-label"></label>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                            preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                            </path>
                        </svg>
                    </div>
                    <div class="sidebar-toggler  x">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
            <div class="sidebar-menu">
                <ul class="menu">
                    <li class="sidebar-title">Menu</li>

                    <li class="sidebar-item active ">
                        <a href="{{ route('adminDashboard') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>


                    </li>

                    <li class="sidebar-title">Transaksi</li>


                    <li class="sidebar-item  has-sub ">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-currency-dollar"></i>
                            <span>Data Transaksi</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item ">
                                <a href="{{ route('allDataTransactions') }}" class="submenu-link">Semua Transaksi</a>

                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('allTransactionProcess') }}" class="submenu-link">Transaksi Proses</a>
                            </li>

                            <li class="submenu-item   ">
                                <a href="{{ route('allTransactionProcessFinance') }}" class="submenu-link">Transaksi Proses
                                    Finance</a>
                            </li>


                            <li class="submenu-item ">
                                <a href="{{ route('allTransactionSuccess') }}" class="submenu-link">Transaksi Selesai</a>
                            </li>

                            <li class="submenu-item">
                                <a href="{{ route('allTransactionFailed') }}" class="submenu-link">Transaksi Tidak Valid</a>
                            </li>



                        </ul>
                    </li>


                    <li class="sidebar-title">Data Master</li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-car-front"></i>
                            <span>Data Mobil</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="{{ route('tambahMobilBaru') }}" class="submenu-link">Tambah Mobil Baru</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('seluruhMobil') }}" class="submenu-link">Seluruh Mobil</a>
                            </li>

                            <li class="submenu-item  ">
                                <a href="{{ route('mobilDiPesan') }}" class="submenu-link">Mobil Telah di pesan</a>

                            </li>

                            <li class="submenu-item  ">
                                <a href="{{ route('MobilTerjual') }}" class="submenu-link">Mobil Terjual</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('mobilTersedia') }}" class="submenu-link">Mobil Tersedia</a>
                            </li>

                        </ul>


                    </li>

                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-puzzle"></i>
                            <span>Komponen Mobil</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="{{ route('bahanBakar') }}" class="submenu-link">Bahan bakar</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('body') }}" class="submenu-link">Body</a>
                            </li>

                            <li class="submenu-item  ">
                                <a href="{{ route('kapasitasMesin') }}" class="submenu-link">Kapasitas mesin</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('kapasitasPenumpang') }}" class="submenu-link">Kapasitas penumpang</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('merk') }}" class="submenu-link">Merk</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('tangki') }}" class="submenu-link">Kapasitas Tangki</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('transmisi') }}" class="submenu-link">Transmisi</a>

                            </li>

                            <li class="submenu-item  ">
                                <a href="{{ route('warna') }}" class="submenu-link">Warna</a>

                            </li>
                        </ul>


                    </li>

                    <li class="sidebar-item ">
                        <a href="{{ route('finance') }}" class='sidebar-link'>
                            <i class="bi bi-wallet2"></i>
                            <span>Finance</span>
                        </a>
                    </li>



                    <li class="sidebar-title">Data Pengguna</li>
                    <li class="sidebar-item  has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-people"></i>
                            <span>Pengguna</span>
                        </a>

                        <ul class="submenu ">
                            <li class="submenu-item  ">
                                <a href="{{ route('dataPelanggan') }}" class="submenu-link">Pelanggan</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('dataPengguna') }}" class="submenu-link">Pengguna</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('dataPemilik') }}" class="submenu-link">Pemilik</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('dataKaryawan') }}" class="submenu-link">Karyawan</a>
                            </li>
                        </ul>

                    </li>

                    </li>



                    <li class="sidebar-title">Profil Saya</li>
                    <li class="sidebar-item ">
                        <a href="{{ route('adminProfile') }}" class='sidebar-link'>
                            <i class="bi bi-person"></i>
                            <span>Profil</span>
                        </a>
                    </li>




                </ul>
            </div>
        </div>
    </div>
@endsection

@section('navbar')
    <header>
        <nav class="navbar navbar-expand navbar-light navbar-top">
            <div class="container-fluid">
                <a href="#" class="burger-btn d-block">
                    <i class="bi bi-justify fs-3"></i>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-lg-0">


                    </ul>
                    <div class="dropdown">
                        <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="user-menu d-flex">
                                <div class="user-name text-end me-3">
                                    <h6 class="mb-0 text-gray-600">{{ $dataAdmin['name'] }}</h6>
                                    <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                </div>
                                <div class="user-img d-flex align-items-center">
                                    <div class="avatar avatar-md">
                                        <img src="{{ asset('data/profile_photo/' . $dataAdmin['photo_profile']) }}">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                            style="min-width: 11rem;">

                            <li><a class="dropdown-item" href="{{ route('adminProfile') }}"><i
                                        class="icon-mid bi bi-person me-2"></i>Profil
                                    Saya</a></li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ route('logOutAdmin') }}"><i
                                        class="icon-mid bi bi-box-arrow-left me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
@endsection


@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3 id="greeting"></h3>

            </div>


        </div>
    </div>
    <section class="section">

        <div class="section-body">
            <div class="row mt-sm-4">

                <div class="row">
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('dataPengguna') }}">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon purple mb-2">
                                                <i class="iconly-boldShow"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total Pengguna</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalUser }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('dataPelanggan') }}">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon blue mb-2">
                                                <i class="iconly-boldProfile"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total Pelanggan</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalPelanggan }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('mobilTersedia') }}">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon green mb-2">
                                                <i class="iconly-boldAdd-User"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total Mobil Tersedia</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalMobilTersedia }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-6 col-lg-3 col-md-6">
                        <div class="card">
                            <a href="{{ route('finance') }}">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                            <div class="stats-icon red mb-2">
                                                <i class="iconly-boldBookmark"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Total Finance</h6>
                                            <h6 class="font-extrabold mb-0">{{ $totalFinance }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">



                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Total Pemasukan & Keuntungan Tahun {{ date('Y') }}</h4>
                            <div class="d-flex justify-content-end mt-2">

                                <a href="{{ route('downloadReportProfit') }}" class="btn btn-success" type="submit">
                                    <i class="bi bi-printer"></i>
                                    Cetak PDF
                                </a>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="graph_profit"></div>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik Jumlah Transaksi Tahun {{ date('Y') }}</h4>
                            </div>
                            <div class="card-body">
                                <div id="graph_transactions"></div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h4>Grafik Pengguna</h4>
                            </div>
                            <div class="card-body">
                                <div id="graph_user"></div>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="row">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">
                                Table Daftar Transaksi Bulan Ini
                            </h5>
                            <p>{{ date('F Y') }}</p>

                            <div class="d-flex justify-content-end mt-2">

                                <a href="{{ route('downloadReportTransactionMonth') }}" class="btn btn-success"
                                    type="submit">
                                    <i class="bi bi-printer"></i>
                                    Cetak PDF
                                </a>

                            </div>


                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table1">


                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Code Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Mobil</th>
                                            <th>No Plat</th>
                                            <th>Nama lengkap</th>
                                            <th>No Hp</th>
                                            <th>Alamat</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Finance</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($dataTransactions as $dm)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $dm->transaksi_id }}</td>
                                                <td>{{ $dm->created_at }}</td>
                                                <td>
                                                    @if ($dm->nama_model != null)
                                                        <a
                                                            href="{{ route('adminDetailMobil', $dm->mobil_id) }}">{{ $dm->merk . '-' . $dm->nama_model }}</a>
                                                    @else
                                                        Mobil telah dihapus
                                                    @endif
                                                </td>
                                                <td>{{ $dm->no_plat }}</td>
                                                <td>
                                                    @if ($dm->nama_user != null)
                                                        {{ $dm->nama_user }}
                                                    @else
                                                        {{ $dm->nama_pelanggan }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dm->no_hp_user != null)
                                                        <a target="_blank"
                                                            href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dm->no_hp_user) }}&text=Halo,%20*{{ $dm->nama_user }}*,%20kami%20dari%20{{ $dataApp['app_name'] }}">
                                                            {{ $dm->no_hp_user }}
                                                        </a>
                                                    @else
                                                        <a target="_blank"
                                                            href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dm->no_hp_pelanggan) }}&text=Halo,%20*{{ $dm->nama_pelanggan }}*,%20kami%20dari%20{{ $dataApp['app_name'] }}">
                                                            {{ $dm->no_hp_pelanggan }}
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dm->alamat_user != null)
                                                        {{ $dm->alamat_user }}
                                                    @else
                                                        {{ $dm->alamat_pelanggan }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dm->payment_method == 1)
                                                        {{-- cash --}}
                                                        Cash / Tunai
                                                    @elseif ($dm->payment_method == 2)
                                                        {{-- credit --}}
                                                        Kredit / Cicil
                                                    @elseif ($dm->payment_method == 3)
                                                        Transfer
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dm->nama_finance != null)
                                                        <a target="_blank"
                                                            href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dm->telepon_finance) }}&text=Halo...">
                                                            {{ $dm->nama_finance }}
                                                        </a>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($dm->status == 1)
                                                        <span class="badge bg-success">Selesai</span>
                                                    @elseif ($dm->status == 0)
                                                        <span class="badge bg-danger">Tidak Valid</span>
                                                    @elseif ($dm->status == 2)
                                                        <span class="badge bg-warning">Proses</span>
                                                    @elseif ($dm->status == 3)
                                                        <span class="badge bg-info">Finance Proses</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ route('adminDetailTransaction', $dm->transaksi_id) }}"
                                                            class="btn btn-info text-white" style="margin-right: 10px;"><i
                                                                class="bi bi-info-lg"></i></a>
                                                        <button data-transaksi_id="{{ $dm->transaksi_id }}"
                                                            data-payment_method="{{ $dm->payment_method }}"
                                                            class="btn btn-danger btnDelete"><i
                                                                class="fa-regular fa-trash-can"></i></a>
                                                        </button>


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
    </section>
@endsection


@section('js')
    {{-- script chart pemasukan dan profit  --}}
    <script>
        $(document).ready(function() {
            function formatRupiah(number) {
                var formatter = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                });
                return formatter.format(number);
            }

            // data pemasukan
            var dataPemasukanPerTahun = {
                "January": {{ $dataPemasukanPerTahun['January'] }},
                "February": {{ $dataPemasukanPerTahun['February'] }},
                "March": {{ $dataPemasukanPerTahun['March'] }},
                "April": {{ $dataPemasukanPerTahun['April'] }},
                "May": {{ $dataPemasukanPerTahun['May'] }},
                "June": {{ $dataPemasukanPerTahun['June'] }},
                "July": {{ $dataPemasukanPerTahun['July'] }},
                "August": {{ $dataPemasukanPerTahun['August'] }},
                "September": {{ $dataPemasukanPerTahun['September'] }},
                "October": {{ $dataPemasukanPerTahun['October'] }},
                "November": {{ $dataPemasukanPerTahun['November'] }},
                "December": {{ $dataPemasukanPerTahun['December'] }},
            };

            var dataKeuntunganPerTahun = {
                "January": {{ $dataKeuntunganPerTahun['January'] }},
                "February": {{ $dataKeuntunganPerTahun['February'] }},
                "March": {{ $dataKeuntunganPerTahun['March'] }},
                "April": {{ $dataKeuntunganPerTahun['April'] }},
                "May": {{ $dataKeuntunganPerTahun['May'] }},
                "June": {{ $dataKeuntunganPerTahun['June'] }},
                "July": {{ $dataKeuntunganPerTahun['July'] }},
                "August": {{ $dataKeuntunganPerTahun['August'] }},
                "September": {{ $dataKeuntunganPerTahun['September'] }},
                "October": {{ $dataKeuntunganPerTahun['October'] }},
                "November": {{ $dataKeuntunganPerTahun['November'] }},
                "December": {{ $dataKeuntunganPerTahun['December'] }},
            };

            var lineOptions = {
                chart: {
                    type: "line",
                    height: 350,
                },
                series: [{
                        name: "Pemasukan",
                        data: [
                            dataPemasukanPerTahun["January"],
                            dataPemasukanPerTahun["February"],
                            dataPemasukanPerTahun["March"],
                            dataPemasukanPerTahun["April"],
                            dataPemasukanPerTahun["May"],
                            dataPemasukanPerTahun["June"],
                            dataPemasukanPerTahun["July"],
                            dataPemasukanPerTahun["August"],
                            dataPemasukanPerTahun["September"],
                            dataPemasukanPerTahun["October"],
                            dataPemasukanPerTahun["November"],
                            dataPemasukanPerTahun["December"]
                        ],
                        dataLabels: {
                            enabled: true,
                            formatter: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    },
                    {
                        name: "Keuntungan",
                        data: [
                            dataKeuntunganPerTahun["January"],
                            dataKeuntunganPerTahun["February"],
                            dataKeuntunganPerTahun["March"],
                            dataKeuntunganPerTahun["April"],
                            dataKeuntunganPerTahun["May"],
                            dataKeuntunganPerTahun["June"],
                            dataKeuntunganPerTahun["July"],
                            dataKeuntunganPerTahun["August"],
                            dataKeuntunganPerTahun["September"],
                            dataKeuntunganPerTahun["October"],
                            dataKeuntunganPerTahun["November"],
                            dataKeuntunganPerTahun["December"]
                        ],
                        dataLabels: {
                            enabled: true,
                            formatter: function(value) {
                                return formatRupiah(value);
                            }
                        }
                    }
                ],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu",
                        "Sep", "Okt", "Nov",
                        "Des"
                    ],
                },


                tooltip: {
                    y: {
                        formatter: function(value) {
                            return formatRupiah(value);
                        }
                    }
                }
            };

            var line = new ApexCharts(document.querySelector("#graph_profit"), lineOptions);
            line.render();
        });
    </script>

    {{-- script chart user --}}
    <script>
        $(document).ready(function() {


            // data pengguna
            var dataPengguna = {
                "January": {{ $totalPengguna['January'] }},
                "February": {{ $totalPengguna['February'] }},
                "March": {{ $totalPengguna['March'] }},
                "April": {{ $totalPengguna['April'] }},
                "May": {{ $totalPengguna['May'] }},
                "June": {{ $totalPengguna['June'] }},
                "July": {{ $totalPengguna['July'] }},
                "August": {{ $totalPengguna['August'] }},
                "September": {{ $totalPengguna['September'] }},
                "October": {{ $totalPengguna['October'] }},
                "November": {{ $totalPengguna['November'] }},
                "December": {{ $totalPengguna['December'] }},
            };

            var lineOptions = {
                chart: {
                    type: "line",
                    height: 350,
                },

                series: [{
                        name: "Pengguna",
                        data: [
                            dataPengguna["January"],
                            dataPengguna["February"],
                            dataPengguna["March"],
                            dataPengguna["April"],
                            dataPengguna["May"],
                            dataPengguna["June"],
                            dataPengguna["July"],
                            dataPengguna["August"],
                            dataPengguna["September"],
                            dataPengguna["October"],
                            dataPengguna["November"],
                            dataPengguna["December"]
                        ],
                        dataLabels: {
                            enabled: true,
                            formatter: function(value) {
                                return Math.round(value);
                            }
                        }
                    },

                ],
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu",
                        "Sep", "Okt", "Nov",
                        "Des"
                    ],
                },



            };

            var line = new ApexCharts(document.querySelector("#graph_user"), lineOptions);
            line.render();
        });
    </script>

    {{-- script chart total jumlah transaksi --}}

    <script>
        $(document).ready(function() {
            var transaksiSelesai = {
                "January": {{ $jumlahTransaksiSelesai['January'] }},
                "February": {{ $jumlahTransaksiSelesai['February'] }},
                "March": {{ $jumlahTransaksiSelesai['March'] }},
                "April": {{ $jumlahTransaksiSelesai['April'] }},
                "May": {{ $jumlahTransaksiSelesai['May'] }},
                "June": {{ $jumlahTransaksiSelesai['June'] }},
                "July": {{ $jumlahTransaksiSelesai['July'] }},
                "August": {{ $jumlahTransaksiSelesai['August'] }},
                "September": {{ $jumlahTransaksiSelesai['September'] }},
                "October": {{ $jumlahTransaksiSelesai['October'] }},
                "November": {{ $jumlahTransaksiSelesai['November'] }},
                "December": {{ $jumlahTransaksiSelesai['December'] }},
            };

            var transaksiProses = {
                "January": {{ $jumlahTransaksiProses['January'] }},
                "February": {{ $jumlahTransaksiProses['February'] }},
                "March": {{ $jumlahTransaksiProses['March'] }},
                "April": {{ $jumlahTransaksiProses['April'] }},
                "May": {{ $jumlahTransaksiProses['May'] }},
                "June": {{ $jumlahTransaksiProses['June'] }},
                "July": {{ $jumlahTransaksiProses['July'] }},
                "August": {{ $jumlahTransaksiProses['August'] }},
                "September": {{ $jumlahTransaksiProses['September'] }},
                "October": {{ $jumlahTransaksiProses['October'] }},
                "November": {{ $jumlahTransaksiProses['November'] }},
                "December": {{ $jumlahTransaksiProses['December'] }},
            };

            var transaksiProsesFinance = {
                "January": {{ $jumlahTransaksiProsesFinance['January'] }},
                "February": {{ $jumlahTransaksiProsesFinance['February'] }},
                "March": {{ $jumlahTransaksiProsesFinance['March'] }},
                "April": {{ $jumlahTransaksiProsesFinance['April'] }},
                "May": {{ $jumlahTransaksiProsesFinance['May'] }},
                "June": {{ $jumlahTransaksiProsesFinance['June'] }},
                "July": {{ $jumlahTransaksiProsesFinance['July'] }},
                "August": {{ $jumlahTransaksiProsesFinance['August'] }},
                "September": {{ $jumlahTransaksiProsesFinance['September'] }},
                "October": {{ $jumlahTransaksiProsesFinance['October'] }},
                "November": {{ $jumlahTransaksiProsesFinance['November'] }},
                "December": {{ $jumlahTransaksiProsesFinance['December'] }},
            };

            var transaksiTidakValid = {
                "January": {{ $jumlahTransaksiTidakValid['January'] }},
                "February": {{ $jumlahTransaksiTidakValid['February'] }},
                "March": {{ $jumlahTransaksiTidakValid['March'] }},
                "April": {{ $jumlahTransaksiTidakValid['April'] }},
                "May": {{ $jumlahTransaksiTidakValid['May'] }},
                "June": {{ $jumlahTransaksiTidakValid['June'] }},
                "July": {{ $jumlahTransaksiTidakValid['July'] }},
                "August": {{ $jumlahTransaksiTidakValid['August'] }},
                "September": {{ $jumlahTransaksiTidakValid['September'] }},
                "October": {{ $jumlahTransaksiTidakValid['October'] }},
                "November": {{ $jumlahTransaksiTidakValid['November'] }},
                "December": {{ $jumlahTransaksiTidakValid['December'] }},
            };
            var barOptions = {
                series: [{
                        name: "Proses Finance",
                        data: [
                            transaksiProsesFinance["January"],
                            transaksiProsesFinance["February"],
                            transaksiProsesFinance["March"],
                            transaksiProsesFinance["April"],
                            transaksiProsesFinance["May"],
                            transaksiProsesFinance["June"],
                            transaksiProsesFinance["July"],
                            transaksiProsesFinance["August"],
                            transaksiProsesFinance["September"],
                            transaksiProsesFinance["October"],
                            transaksiProsesFinance["November"],
                            transaksiProsesFinance["December"]
                        ],
                    },

                    {
                        name: "Selesai",
                        data: [
                            transaksiSelesai["January"],
                            transaksiSelesai["February"],
                            transaksiSelesai["March"],
                            transaksiSelesai["April"],
                            transaksiSelesai["May"],
                            transaksiSelesai["June"],
                            transaksiSelesai["July"],
                            transaksiSelesai["August"],
                            transaksiSelesai["September"],
                            transaksiSelesai["October"],
                            transaksiSelesai["November"],
                            transaksiSelesai["December"]
                        ],
                    },
                    {
                        name: "Proses",
                        data: [
                            transaksiProses["January"],
                            transaksiProses["February"],
                            transaksiProses["March"],
                            transaksiProses["April"],
                            transaksiProses["May"],
                            transaksiProses["June"],
                            transaksiProses["July"],
                            transaksiProses["August"],
                            transaksiProses["September"],
                            transaksiProses["October"],
                            transaksiProses["November"],
                            transaksiProses["December"]
                        ],
                    },
                    {
                        name: "Tidak Valid",
                        data: [
                            transaksiTidakValid["January"],
                            transaksiTidakValid["February"],
                            transaksiTidakValid["March"],
                            transaksiTidakValid["April"],
                            transaksiTidakValid["May"],
                            transaksiTidakValid["June"],
                            transaksiTidakValid["July"],
                            transaksiTidakValid["August"],
                            transaksiTidakValid["September"],
                            transaksiTidakValid["October"],
                            transaksiTidakValid["November"],
                            transaksiTidakValid["December"]
                        ],
                    },
                ],
                chart: {
                    type: "bar",
                    height: 350,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: "55%",
                        endingShape: "rounded",
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ["transparent"],
                },
                xaxis: {
                    categories: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu",
                        "Sep", "Okt", "Nov",
                        "Des"
                    ],
                },
                fill: {
                    opacity: 1,
                },

            }
            var bar = new ApexCharts(document.querySelector("#graph_transactions"), barOptions);
            bar.render();
        });
    </script>

    {{-- script btn delete transaksi --}}
    <script>
        $(document).on('click', '.btnDelete', function() {
            var transaksi_id = $(this).data('transaksi_id');
            var payment_method = $(this).data('payment_method');
            Swal.fire({
                title: 'Konfirmasi Hapus Data',
                text: 'Apakah Anda yakin ingin menghapus data ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: {
                    confirmButton: 'confirm-button-class',
                    cancelButton: 'cancel-button-class'
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    window.location.href = '/adminHapusTrasaksi/' + transaksi_id + '/' + payment_method;

                }
            });
        });
    </script>
    {{-- Script greeting --}}
    <script>
        $(document).ready(function() {

            var waktu = new Date();
            var username = "{{ $dataAdmin['name'] }}";

            var jam = waktu.getHours();

            if (jam >= 6 && jam < 11) {

                $("#greeting").text("Selamat pagi, " + username + '!');
            } else if (jam >= 11 && jam < 15) {

                $("#greeting").text("Selamat siang, " + username + '!');
            } else if (jam >= 15 && jam < 18) {

                $("#greeting").text("Selamat sore, " + username + '!');
            } else {

                $("#greeting").text("Selamat malam, " + username + '!');
            }

        });
    </script>
@endsection
