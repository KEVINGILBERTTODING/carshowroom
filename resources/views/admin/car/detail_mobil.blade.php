@extends('layouts.admin.main.t_main')

@section('title')
    <title>
        Admin - Detail Mobil</title>
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



                    <li class="sidebar-title">Data Master</li>

                    <li class="sidebar-item active  has-sub">
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

                            <li class="submenu-item">
                                <a href="{{ route('kapasitasMesin') }}" class="submenu-link">Kapasitas mesin</a>

                            </li>
                            <li class="submenu-item ">
                                <a href="{{ route('kapasitasPenumpang') }}" class="submenu-link">Kapasitas penumpang</a>
                            </li>
                            <li class="submenu-item   ">
                                <a href="{{ route('merk') }}" class="submenu-link">Merk</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('tangki') }}" class="submenu-link">Kapasitas Tangki</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('transmisi') }}" class="submenu-link">Transmisi</a>

                            </li>

                            <li class="submenu-item">
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
                <h3>Detail Mobil
                </h3>



            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">

                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Mobil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <form action="{{ route('insertMobil') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4>Data Mobil</h4>
                                @if ($dataMobil['status_mobil'] == 1)
                                    <span class="badge bg-success">Tersedia</span>
                                @elseif ($dataMobil['status_mobil'] == 0)
                                    <span class="badge bg-danger">Terjual</span>
                                @else
                                    <span class="badge bg-warning">Booked</span>
                                @endif

                                <div class="row mt-3">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Merk Mobil</label>
                                        <input type="text" name="nama_model" readonly class="form-control" required
                                            value="{{ $dataMobil['merk'] }}">

                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Jenis Mobil</label>
                                        <input type="text" name="nama_model" readonly class="form-control" required
                                            value="{{ $dataMobil['body'] }}">

                                    </div>


                                </div>

                                <div class="form-group">
                                    <label>Nama Model</label>
                                    <input type="text" name="nama_model" readonly class="form-control" required
                                        value="{{ $dataMobil['nama_model'] }}">
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Nomor Plat</label>
                                        <input name="no_plat" required type="text" readonly class="form-control"
                                            autocomplete="off" value="{{ $dataMobil['no_plat'] }}">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Nomor Mesin</label>
                                        <input name="no_mesin" required type="text" readonly class="form-control"
                                            autocomplete="off" value="{{ $dataMobil['no_mesin'] }}">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Nomor Rangka</label>
                                        <input name="no_rangka" required type="text" class="form-control"
                                            autocomplete="off" value="{{ $dataMobil['no_rangka'] }}">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Tahun</label>
                                        <input type="text" required class="form-control" name="tahun" readonly
                                            value="{{ $dataMobil['tahun'] }}" />


                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Warna Mobil</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['warna'] }}" readonly>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kapasitas Mesin</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['kapasitas_mesin'] }}" readonly>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Jenis Bahan Bakar</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['bahan_bakar'] }}" readonly>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Jenis Transmisi</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['transmisi'] }}" readonly>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kapasitas Penumpang</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['kapasitas_penumpang'] }}" readonly>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kilometer yang telah ditempuh</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['km'] }}" readonly>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kapasitas Tangki</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['tangki'] }}" readonly>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Harga Beli</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ formatRupiah($dataMobil['harga_beli']) }}" readonly>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Biaya Perbaikan</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ formatRupiah($dataMobil['biaya_perbaikan']) }}" readonly>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Harga Jual</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ formatRupiah($dataMobil['harga_jual']) }}" readonly>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Tanggal Masuk</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ $dataMobil['tgl_masuk'] }}" readonly>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Diskon</label>
                                        <input type="text" name="nama_model" class="form-control" required
                                            value="{{ formatRupiah($dataMobil['diskon']) }}" readonly>
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label>Nama Pemilik</label>
                                    <input type="text" name="nama_model" class="form-control" required readonly
                                        value="{{ $dataMobil['nama_pemilik'] }}">
                                </div>

                                <div class="form-group ">
                                    <label>Link Youtube</label>
                                    <br>
                                    <a href="{{ $dataMobil['url_youtube'] }}" class="text-primary" target="_blank"
                                        rel="noopener noreferrer">{{ $dataMobil['url_youtube'] }}</a>

                                </div>

                                <div class="form-group ">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" type="text" rows="3" class="form-control" required readonly>{{ $dataMobil['deskripsi'] }}</textarea>
                                </div>




                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">


                            <div class="card-body">
                                <h4>Gambar Mobil</h4>

                                <div class="row mt-3">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar depan</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailgambar1">
                                            <img class="w-100" src="{{ asset('data/cars/' . $dataMobil['gambar1']) }}"
                                                data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                        </a>

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar samping kanan</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailgambar2">
                                            <img class="w-100" src="{{ asset('data/cars/' . $dataMobil['gambar2']) }}"
                                                data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                        </a>

                                    </div>

                                </div>
                                <div class="row">


                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar belakang</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailgambar3">
                                            <img class="w-100" src="{{ asset('data/cars/' . $dataMobil['gambar3']) }}"
                                                data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                        </a>

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar samping kiri</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailgambar4">
                                            <img class="w-100" src="{{ asset('data/cars/' . $dataMobil['gambar4']) }}"
                                                data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                        </a>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar detail</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailgambar5">
                                            <img class="w-100" src="{{ asset('data/cars/' . $dataMobil['gambar5']) }}"
                                                data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                        </a>

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar detail</label>
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#detailgambar6">
                                            <img class="w-100" src="{{ asset('data/cars/' . $dataMobil['gambar6']) }}"
                                                data-bs-target="#Gallerycarousel" data-bs-slide-to="5">
                                        </a>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>



            </div>
            </div>

            @for ($i = 0; $i < 7; $i++)
                <div class="modal fade" id="detailgambar{{ $i }}" tabindex="-1" role="dialog"
                    aria-labelledby="galleryModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="galleryModalTitle">
                                    @if ($i == 1)
                                        Gambar depan
                                    @elseif ($i == 2)
                                        Gambar samping kanan
                                    @elseif ($i == 3)
                                        Gambar belakang
                                    @elseif ($i == 4)
                                        Gambar samping kiri
                                    @else
                                        Gambar Detail
                                    @endif
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">

                                    <div class="carousel-inner">
                                        <img class="d-block w-100"
                                            src="{{ asset('data/cars/' . $dataMobil['gambar' . $i]) }}">
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor




    </section>
@endsection

@section('js')
    <script>
        function formatRupiah(angka) {
            var number_string = angka.toString();
            var sisa = number_string.length % 3;
            var rupiah = number_string.substr(0, sisa);
            var ribuan = number_string.substr(sisa).match(/\d{3}/g);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return 'Rp. ' + rupiah;
        }
    </script>
@endsection
