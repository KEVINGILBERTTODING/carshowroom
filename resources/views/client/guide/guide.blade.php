@extends('layouts.client.t_client_main')

@section('title')
    <title>{{ $dataApp['app_name'] . ' - Panduan' }}</title>
@endsection

@section('content')
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__widget">

            <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
            @if (session('client') == true)
                <a href="{{ route('dashboardClient') }}" class="primary-btn text-dark">Dashboard</a>
            @else
                <a href="{{ route('client.sign-in') }}" class="primary-btn text-dark">Login</a>
            @endif
        </div>
        <div class="offcanvas__logo">
            <a href="{{ route('/') }}"><img width="10%;" src="{{ asset('data/app/img/' . $dataApp['logo']) }}"
                    alt="{{ $dataApp['app_name'] }}"></a>
        </div>
        <div id="mobile-menu-wrap"></div>
        <ul class="offcanvas__widget__add">
            <li><i class="fa fa-clock-o"></i> {{ $dataApp['jadwal'] }}</li>
            <li><i class="fa fa-envelope-o"></i> {{ $dataApp['email'] }}</li>
        </ul>
        <div class="offcanvas__phone__num">
            <i class="fa fa-phone"></i>
            <span>{{ $dataApp['no_hp'] }}</span>
        </div>
        <div class="offcanvas__social">
            <a href="{{ $dataApp['url_facebook'] }}"><i class="fa fa-facebook"></i></a>
            <a href="{{ $dataApp['url_youtube'] }}"><i class="fa fa-youtube"></i></a>
            <a href="{{ $dataApp['url_instagram'] }}"><i class="fa fa-instagram"></i></a>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <ul class="header__top__widget">
                            <li><i class="fa fa-clock-o"></i> {{ $dataApp['jadwal'] }}</li>
                            <li><i class="fa fa-envelope-o"></i> {{ $dataApp['email'] }}</li>
                        </ul>
                    </div>
                    <div class="col-lg-5">
                        <div class="header__top__right">
                            <div class="header__top__phone">
                                <i class="fa fa-phone"></i>
                                <span>{{ $dataApp['no_hp'] }}</span>
                            </div>
                            <div class="header__top__social">
                                <a href="{{ $dataApp['url_facebook'] }}"><i class="fa fa-facebook"></i></a>
                                <a href="{{ $dataApp['url_youtube'] }}"><i class="fa fa-youtube"></i></a>
                                <a href="{{ $dataApp['url_instagram'] }}"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="{{ route('/') }}"><img width="40px;"
                                src="{{ asset('data/app/img/' . $dataApp['logo']) }}"
                                alt="{{ $dataApp['app_name'] }}"></a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="header__nav">
                        <nav class="header__menu">
                            <ul>
                                <li><a href="{{ route('/') }}">Beranda</a></li>
                                <li><a href="{{ route('mobil') }}">Mobil</a>
                                </li>
                                <li><a href="{{ route('review') }}">Testimoni</a></li>
                                <li><a href="{{ route('dataFinance') }}">Finance</a></li>
                                <li><a href="{{ route('aboutUs') }}">About</a></li>
                            </ul>
                        </nav>
                        <div class="header__nav__widget">
                            <div class="header__nav__widget__btn">

                                <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
                            </div>
                            @if (session('client') == true)
                                <a href="{{ route('dashboardClient') }}" class="primary-btn text-dark">Dashboard</a>
                            @else
                                <a href="{{ route('client.sign-in') }}" class="primary-btn text-dark">Login</a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <span class="fa fa-bars"></span>
            </div>
        </div>
    </header>
    <!-- Breadcrumb End -->
    <div class="breadcrumb-option set-bg" data-setbg="{{ asset('template/client/img/main/hero.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Panduan Pengguna</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}"><i class="fa fa-home"></i> Beranda</a>
                            <span>Panduan Pengguna</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">

                        <h2>Transfer</h2>
                        <p>
                            Berikut adalah langkah-langkah ketika Anda memilih metode pembayaran melalui transfer.
                        </p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/user_guide/car.png') }}"
                            alt="">
                        <h5>Pilih Mobil</h5>
                        <p>
                            Di halaman mobil, pilihlah mobil yang Anda impikan. Pastikan Anda membaca detail informasi
                            kendaraan, atau jika Anda ingin bertanya, silakan hubungi kami melalui tombol "Hubungi
                            Sekarang".
                        </p>


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/services/service3.png') }}"
                            alt="">
                        <h5>Transaksi</h5>
                        <p>
                            Di halaman detail mobil, pada bagian rincian harga, pilih opsi "Pesan Sekarang". Selanjutnya,
                            Anda akan diarahkan ke halaman pembuatan pesanan baru. Isilah data diri Anda secara lengkap,
                            kemudian pilih jenis bank dan lakukan transfer sesuai dengan nominal yang tercantum.
                        </p>


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/user_guide/work-process.png') }}"
                            alt="">
                        <h5>Proses</h5>
                        <p>
                            Transaksi Anda akan segera divalidasi oleh admin. Anda akan menerima pemberitahuan apakah
                            transaksi Anda valid atau ditolak. proses membutuhkan paling lambat 1 minggu.
                        </p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/user_guide/checked.png') }}">
                        <h5>Selesai</h5>
                        <p>
                            Jika validasi berhasil, kami akan segera menghubungi Anda untuk menjadwalkan test drive dan
                            membantu Anda mengurus kelengkapan berkas yang diperlukan.
                        </p>


                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">

                        <h2>Kredit</h2>
                        <p>
                            Berikut adalah langkah-langkah ketika Anda memilih metode pembayaran melalui kredit / cicilan.
                        </p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/user_guide/car.png') }}"
                            alt="">
                        <h5>Pilih Mobil</h5>
                        <p>
                            Di halaman mobil, pilihlah mobil yang Anda impikan. Pastikan Anda membaca detail informasi
                            kendaraan, atau jika Anda ingin bertanya, silakan hubungi kami melalui tombol "Hubungi
                            Sekarang".
                        </p>


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/services/service3.png') }}"
                            alt="">
                        <h5>Pengajuan Kredit</h5>
                        <p>
                            Di halaman detail mobil, pada bagian rincian harga, pilih opsi "Ajukan Kredit". Selanjutnya,
                            Anda akan diarahkan ke hitung cicilan. Di sana, Anda dapat melihat gambaran total biaya cicilan
                            dan biaya lain-lain. Setelah itu, pilih menu "Ajukan Pembiayaan," isilah data diri Anda secara
                            lengkap, dan unggah file yang dibutuhkan.
                        </p>



                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/user_guide/work-process.png') }}"
                            alt="">
                        <h5>Proses</h5>
                        <p>
                            Pengajuan kredit Anda akan segera divalidasi oleh admin. Jika valid, kami akan meneruskan kepada
                            pihak keuangan yang bersangkutan. Anda akan menerima pemberitahuan apakah pengajuan kredit Anda
                            valid atau tidak, paling lambat 1 minggu pada hari kerja. Anda akan dihubungi oleh pihak
                            finance jika pengajuan disetujui.
                        </p>


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/user_guide/checked.png') }}">
                        <h5>Selesai</h5>
                        <p>
                            Jika pengajuan kredit selesai, kami akan segera menghubungi Anda untuk menjadwalkan test drive
                            dan
                            membantu Anda mengurus kelengkapan berkas yang diperlukan.
                        </p>


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
