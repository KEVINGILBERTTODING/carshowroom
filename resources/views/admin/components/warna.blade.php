@extends('layouts.admin.main.t_main')

@section('title')
    @if (session('role') == 'admin')
        <title>Admin - Warna Mobil</title>
    @else
        <title>Karyawan - Warna Mobil</title>
    @endif
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
                    <li class="sidebar-item  ">
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
                    <li class="sidebar-item  has-sub active">
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

                            <li class="submenu-item active">
                                <a href="{{ route('warna') }}" class="submenu-link">Warna</a>
                            </li>
                        </ul>

                    <li class="sidebar-item ">
                        <a href="{{ route('finance') }}" class='sidebar-link'>
                            <i class="bi bi-wallet2"></i>
                            <span>Finance</span>
                        </a>


                    </li>


                    </li>
                    @if (session('role') == 'admin')
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
                    @endif


                    @if (session('role') == 'admin')
                        <li class="sidebar-title">Utilitas</li>
                        <li class="sidebar-item ">
                            <a href="{{ route('settings') }}" class='sidebar-link'>
                                <i class="bi bi-tools"></i>
                                <span>Pengaturan</span>
                            </a>
                        </li>
                    @endif



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
                                    @if (session('role') == 'admin')
                                        <p class="mb-0 text-sm text-gray-600">Administrator</p>
                                    @else
                                        <p class="mb-0 text-sm text-gray-600">Karyawan</p>
                                    @endif
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
                            @if (session('role') == 'admin')
                                <li><a class="dropdown-item" href="{{ route('logOutAdmin') }}"><i
                                            class="icon-mid bi bi-box-arrow-left me-2"></i> Keluar</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('logOutEmployee') }}"><i
                                            class="icon-mid bi bi-box-arrow-left me-2"></i> Keluar</a></li>
                            @endif
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
                <h3>Daftar Warna Mobil</h3>

            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Warna Mobil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Table Warna Mobil
                </h5>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_insert">Tambah
                    </button>
                </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table" id="table1">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Warna</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp

                            @foreach ($dataWarna as $dw)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $dw->warna }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <button style="margin-right: 10px" class="btn btn-warning"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal_update_{{ $dw->warna_id }}"><i
                                                    class="fa-regular fa-pen-to-square"></i></button>
                                            <button data-warna_id="{{ $dw->warna_id }}"
                                                class="btn btn-danger btnDelete"><i
                                                    class="fa-regular fa-trash-can"></i></a>
                                            </button>

                                        </div>


                                    </td>
                                </tr>

                                <!--Modal ubah warna -->
                                <div class="modal fade text-left modal-borderless" id="modal_update_{{ $dw->warna_id }}"
                                    tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Ubah Warna</h5>
                                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('updateWarna') }}" method="post">
                                                @csrf
                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="basicInput">Nama Warna</label>
                                                        <input type="text" hidden readonly class="form-control mt-2"
                                                            value="{{ $dw->warna_id }}" name="warna_id" id="basicInput">
                                                        <input type="text" class="form-control mt-2"
                                                            value="{{ $dw->warna }}" name="warna" id="basicInput">
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light-primary"
                                                        data-bs-dismiss="modal">
                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Batal</span>
                                                    </button>
                                                    <button type="submit" class="btn btn-primary ms-1">
                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                        <span class="d-none d-sm-block">Simpan Perubahan</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!--Modal tambah warna -->
                <div class="modal fade text-left modal-borderless" id="modal_insert" tabindex="-1" role="dialog"
                    aria-labelledby="myModalLabel1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tambah Warna Baru</h5>
                                <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <form action="{{ route('tambahWarna') }}" method="post">
                                @csrf
                                <div class="modal-body">

                                    <div class="form-group">
                                        <label for="basicInput">Nama Warna</label>
                                        <input type="text" class="form-control mt-2" name="warna" id="basicInput">
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Batal</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ms-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection


@section('js')
    <script>
        $(document).on('click', '.btnDelete', function() {
            var warna_id = $(this).data('warna_id');
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

                    window.location.href = '/hapusWarna/' + warna_id;

                }
            });
        });
    </script>
@endsection
