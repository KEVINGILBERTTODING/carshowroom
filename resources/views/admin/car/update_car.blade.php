@extends('layouts.admin.main.t_main')

@section('title')
    <title>Admin - Ubah Data Mobil</title>
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
                            <li class="submenu-item ">
                                <a href="{{ route('tambahMobilBaru') }}" class="submenu-link">Tambah Mobil Baru</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('seluruhMobil') }}" class="submenu-link">Seluruh Mobil</a>
                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('mobilDiPesan') }}" class="submenu-link">Mobil Telah di pesan</a>

                            </li>

                            <li class="submenu-item  ">
                                <a href="{{ route('kapasitasMesin') }}" class="submenu-link">Mobil Terjual</a>

                            </li>
                            <li class="submenu-item  ">
                                <a href="{{ route('kapasitasPenumpang') }}" class="submenu-link">Mobil Tersedia</a>
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
                <h3>Ubah Data Mobil</h3>
                <p class="section-lead">
                    Form untuk mengubah data mobil.
                </p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('adminDashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Ubah Data Mobil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <form action="{{ route('updateMobil') }}" method="post" enctype="multipart/form-data">

            @csrf
            <div class="section-body">
                <div class="row mt-sm-4">
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4>Data Mobil</h4>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Merk Mobil</label>
                                        <select name="merk_id" class="form-control" required>
                                            <option value="{{ $dataMobil['merk_id'] }}" selected>
                                                {{ $detailMobil['merk'] }}
                                            </option>

                                            @foreach ($dataMerk as $dm)
                                                @if ($dm->merk_id == $dataMobil['merk_id'])
                                                    <option hidden value="{{ $dm->merk_id }}">
                                                    </option>
                                                @else
                                                    <option value="{{ $dm->merk_id }}">{{ $dm->merk }}</option>
                                                @endif
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Jenis Mobil</label>
                                        <select name="body_id" class="form-control" required>
                                            <option value="{{ $dataMobil['body_id'] }}" selected>
                                                {{ $detailMobil['body'] }}
                                            </option>

                                            @foreach ($dataBody as $db)
                                                @if ($db->body_id == $dataMobil['body_id'])
                                                    <option hidden value="{{ $db->body_id }}">
                                                    </option>
                                                @else
                                                    <option value="{{ $db->body_id }}">{{ $db->body }}</option>
                                                @endif
                                            @endforeach

                                        </select>

                                    </div>


                                </div>

                                <div class="form-group">
                                    <label>Nama Model</label>
                                    <input type="text" name="mobil_id" hidden value="{{ $dataMobil['mobil_id'] }}"
                                        class="form-control">
                                    <input type="text" name="nama_model" value="{{ $dataMobil['nama_model'] }}"
                                        class="form-control" required>
                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Nomor Plat</label>
                                        <input name="no_plat" required type="text" class="form-control"
                                            autocomplete="off" value="{{ $dataMobil['no_plat'] }}">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Nomor Mesin</label>
                                        <input name="no_mesin" required type="text" class="form-control"
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
                                        <input type="text" required class="form-control" name="tahun"
                                            id="datepicker" value="{{ $dataMobil['tahun'] }}" />


                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Warna Mobil</label>
                                        <select name="warna_id" required class="form-control" required>
                                            <option value="{{ $dataMobil['warna_id'] }}" selected>
                                                {{ $detailMobil['warna'] }}
                                            </option>

                                            @foreach ($dataWarna as $dw)
                                                @if ($dw->warna_id == $dataMobil['warna_id'])
                                                    <option hidden value="{{ $dw->warna_id }}">
                                                    </option>
                                                @else
                                                    <option value="{{ $dw->warna_id }}">{{ $dw->warna }}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kapasitas Mesin</label>
                                        <select name="km_id" required class="form-control" required>
                                            <option value="{{ $dataMobil['km_id'] }}" selected>
                                                {{ $detailMobil['kapasitas_mesin'] }}
                                            </option>

                                            @foreach ($dataKapasitasMesin as $km)
                                                @if ($km->km_id == $dataMobil['km_id'])
                                                    <option hidden value="{{ $km->km_id }}">
                                                    </option>
                                                @else
                                                    <option value="{{ $km->km_id }}">{{ $km->kapasitas }}</option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Jenis Bahan Bakar</label>
                                        <select name="bahan_bakar_id" required class="form-control" required>
                                            <option value="{{ $dataMobil['bahan_bakar_id'] }}" selected>
                                                {{ $detailMobil['bahan_bakar'] }}
                                            </option>

                                            @foreach ($dataBahanBakar as $dbb)
                                                @if ($dbb->bahan_bakar_id == $dataMobil['bahan_bakar_id'])
                                                    <option hidden value="{{ $dbb->bahan_bakar_id }}">
                                                    </option>
                                                @else
                                                    <option value="{{ $dbb->bahan_bakar_id }}">{{ $dbb->bahan_bakar }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Jenis Transmisi</label>
                                        <select name="transmisi_id" required class="form-control" required>
                                            <option value="{{ $dataMobil['transmisi_id'] }}" selected>
                                                {{ $detailMobil['transmisi'] }}
                                            </option>

                                            @foreach ($dataTransmisi as $dtm)
                                                @if ($dtm->transmisi_id == $dataMobil['transmisi_id'])
                                                    <option hidden value="{{ $dtm->transmisi_id }}">
                                                    </option>
                                                @else
                                                    <option value="{{ $dtm->transmisi_id }}">{{ $dtm->transmisi }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kapasitas Penumpang</label>
                                        <select name="kp_id" required class="form-control" required>
                                            <option value="{{ $dataMobil['kp_id'] }}" selected>
                                                {{ $detailMobil['kapasitas_penumpang'] }}
                                            </option>

                                            @foreach ($dataKapasitasPenumpang as $dkpm)
                                                @if ($dkpm->kp_id == $dataMobil['kp_id'])
                                                    <option hidden value="{{ $dkpm->kp_id }}">
                                                    </option>
                                                @else
                                                    <option value="{{ $dkpm->kp_id }}">{{ $dkpm->kapasitas }}
                                                    </option>
                                                @endif
                                            @endforeach

                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kilometer yang telah ditempuh</label>
                                        <input name="km" type="number" required class="form-control" required
                                            value="{{ $dataMobil['km'] }}">

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Kapasitas Tangki</label>
                                        <select name="tangki_id" required class="form-control" required>
                                            @foreach ($dataTangki as $dt)
                                                <option value="{{ $dt->tangki_id }}">{{ $dt->tangki }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Harga Beli</label>
                                        <input name="harga_beli" type="number" required class="form-control" required
                                            value="{{ $dataMobil['harga_beli'] }}">

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Biaya Perbaikan</label>
                                        <input name="biaya_perbaikan" type="number" required class="form-control"
                                            required value="{{ $dataMobil['biaya_perbaikan'] }}">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Harga Jual</label>
                                        <input name="harga_jual" type="number" required class="form-control" required
                                            value="{{ $dataMobil['harga_jual'] }}">
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Tanggal Masuk</label>
                                        <input name="tanggal_masuk" type="date" required class="form-control" required
                                            value="{{ $dataMobil['tgl_masuk'] }}">
                                    </div>

                                    <div class="form-group col-md-6 col-12">
                                        <label>Diskon</label>
                                        <input name="diskon" type="number" required class="form-control"
                                            value="{{ $dataMobil['diskon'] }}">
                                    </div>
                                </div>

                                <div class="form-group ">
                                    <label>Nama Pemilik</label>
                                    <input name="nama_pemilik" type="text" required class="form-control" required
                                        value="{{ $dataMobil['nama_pemilik'] }}">
                                </div>

                                <div class="form-group ">
                                    <label>Link Youtube</label>
                                    <input name="url_youtube" type="text" required class="form-control" required
                                        value="{{ $dataMobil['url_youtube'] }}">
                                </div>

                                <div class="form-group ">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" type="text" rows="3" required class="form-control"
                                        placeholder="Tulis sesuatu..." required>{{ $dataMobil['deskripsi'] }}</textarea>
                                </div>


                                <div class="form-group ">
                                    <label>Status</label>
                                    <select name="status" id="status" class="form-control">
                                        @if ($dataMobil['status_mobil'] == 1)
                                            <option value="1" selected>Tersedia</option>
                                            <option value="0">Terjual</option>
                                        @elseif ($dataMobil['status_mobil'] == 2)
                                            <option value="2" selected>Telah dipesan</option>
                                            <option value="1">Tersedia</option>
                                            <option value="0">Terjual</option>
                                        @elseif ($dataMobil['status_mobil'] == 0)
                                            <option value="0" selected>Terjual</option>
                                            <option value="1">Tersedia</option>
                                        @endif


                                    </select>
                                </div>




                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-6">
                        <div class="card">


                            <div class="card-body">
                                <h4>Gambar Mobil</h4>
                                <p class="text-sm text-warning">Ukuran gambar tidak boleh lebih dari 5 Mb.</p>
                                <div class="row mt-3">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar depan</label>
                                        <input type="file" accept=".png,.jpeg,.jpg" name="gambar1"
                                            class="form-control">
                                        <span class="text-success text-sm">{{ $dataMobil['gambar1'] }}</span>

                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar samping kanan</label>
                                        <input type="file" accept=".png,.jpeg,.jpg" name="gambar2"
                                            class="form-control">
                                        <span class="text-success text-sm">{{ $dataMobil['gambar2'] }}</span>


                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar belakang</label>
                                        <input type="file" accept=".png,.jpeg,.jpg" name="gambar3"
                                            class="form-control">
                                        <span class="text-success text-sm">{{ $dataMobil['gambar3'] }}</span>


                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar samping kiri</label>
                                        <input type="file" accept=".png,.jpeg,.jpg" name="gambar4"
                                            class="form-control">
                                        <span class="text-success text-sm">{{ $dataMobil['gambar4'] }}</span>


                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar detail</label>
                                        <input type="file" accept=".png,.jpeg,.jpg" name="gambar5"
                                            class="form-control">
                                        <span class="text-success text-sm">{{ $dataMobil['gambar5'] }}</span>


                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Gambar detail</label>
                                        <input type="file" accept=".png,.jpeg,.jpg" name="gambar6"
                                            class="form-control">
                                        <span class="text-success text-sm">{{ $dataMobil['gambar6'] }}</span>


                                    </div>
                                </div>

                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Simpan Data</button>
                            </div>
        </form>
        </div>
        </div>



        </div>
        </div>

        <!--Modal ubah status tersedia mobil -->
        <div class="modal fade text-left modal-borderless" id="modal_tersedia" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah status mobil</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <form action="{{ route('setStatusMobilTersedia') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <h6>Apakah anda yakin ingin mengubah status mobil menjadi "Tersedia" ?</h6>
                            <p class="text-muted">Dengan mengubah status mobil maka seluruh transaksi yang berkaitan dengan
                                mobil
                                ini akan otomatis berubah status menjadi "tidak valid".</p>
                            <input type="text" class="form-control mt-2" hidden name="mobil_id" required="basicInput"
                                value="{{ $dataMobil['mobil_id'] }}">
                            <input type="text" class="form-control mt-2" hidden name="status" required="basicInput"
                                value="1">

                            <div class="form-group">
                                <label>Alasan</label>
                                <textarea type="text" name="alasan" class="form-control" rows="4" placeholder="Ketikkan sesuatu..."></textarea>


                            </div>



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                                <i class="bx bx-x d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Batal</span>
                            </button>
                            <button type="submit" class="btn btn-primary ms-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Ya, ubah!</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Modal ubah status terjual mobil -->
        <form action="{{ route('setStatusMobilTerjual') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal fade text-left modal-borderless" id="modal_terjual" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">

                    <div class="modal-content">


                        <div class="modal-header">
                            <h5 class="modal-title">Data Pembelian</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>

                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" hidden value="{{ $dataMobil['mobil_id'] }}" name="mobil_id"
                                    class="form-control" required>
                                <input type="text" hidden value="{{ $dataMobil['harga_jual'] }}" name="harga_jual"
                                    class="form-control" required>
                                <input type="text" hidden value="{{ $dataMobil['diskon'] }}" name="diskon"
                                    class="form-control" required>
                                <input type="text" name="nama_lengkap" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>No HP</label>
                                <input type="number" name="no_hp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Alamat Lengkap</label>
                                <textarea type="text" name="alamat" class="form-control" required placeholder="Alamat anda"></textarea>
                            </div>

                            <div class="form-group">
                                <label>Metode Pembayaran</label>
                                <select name="payment_method" id="payment_method" required class="form-control">
                                    <option value="1">Cash</option>
                                    <option value="2">Cicilan</option>
                                </select>
                            </div>

                            <div class="form-group" id="finance">
                                <label>Finance</label>
                                <select name="finance_id" class="form-control">
                                    @foreach ($dataFinance as $df)
                                        <option value="{{ $df->finance_id }}">{{ $df->nama_finance }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="form-group" id="ktp_suami">
                                <label>KTP Suami</label>
                                <input type="file" accept=".jpg,.png,.jpeg,.pdf" name="ktp_suami"
                                    class="form-control">

                            </div>

                            <div class="form-group" id="ktp_istri">
                                <label>KTP Istri</label>
                                <input type="file" accept=".jpg,.png,.jpeg,.pdf" name="ktp_istri"
                                    class="form-control">

                            </div>

                            <div class="form-group" id="kk">
                                <label>Kartu Keluarga</label>
                                <input type="file" accept=".jpg,.png,.jpeg,.pdf" name="kk" class="form-control">

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

                    </div>

                </div>
            </div>
        </form>




    </section>
@endsection

@section('js')
    {{-- Script untuk menampilkan year picker --}}
    <script>
        $(document).ready(function() {

            $("#datepicker").datepicker({
                format: "yyyy",
                viewMode: "years",
                minViewMode: "years",
                autoclose: true
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            // Logic ketika memilih status mobil
            $("#status").on("change", function() {
                if ($("#status").val() === "1") {
                    // Tampilkan modal dengan ID "modal_insert"
                    $("#modal_tersedia").modal("show");
                } else if ($("#status").val() === "0") {
                    // Tampilkan modal dengan ID "modal_insert"
                    $("#modal_terjual").modal("show");
                }
            });



            //  set agar inputan tersembunyi
            $("#ktp_suami").hide();
            $("#ktp_istri").hide();
            $("#kk").hide();
            $("#finance").hide();

            // logic ketika memilih metode pembayaran
            $("#payment_method").on("change", function() {
                if ($("#payment_method").val() === "1") { // methode pembayaran cash

                    $("#ktp_suami").hide();
                    $("#ktp_istri").hide();
                    $("#kk").hide();
                    $("#finance").hide();
                } else if ($("#payment_method").val() === "2") { // Methode pembayaran kredit

                    $("#ktp_suami").show();
                    $("#ktp_istri").show();
                    $("#kk").show();
                    $("#finance").show();
                }
            });
        });
    </script>
@endsection
