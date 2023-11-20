@extends('layouts.client.t_client_main')

@section('title')
    <title>{{ $dataApp['app_name'] . ' ' . $dataMobil['merk'] . '-' . $dataMobil['nama_model'] }}</title>
@endsection

@section('content')
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__widget">

            <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
            @if (session('role') == 'customer' && session('login') == true)
                <a href="#" class="primary-btn">Dasboard</a>
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
                                <li class="active"><a href="{{ route('mobil') }}">Mobil</a></li>
                                <li><a href="{{ route('review') }}">Testimoni</a></li>
                                <li><a href="{{ route('dataFinance') }}">Finance</a></li>
                                <li><a href="{{ route('aboutUs') }}">About</a></li>
                            </ul>
                        </nav>
                        <div class="header__nav__widget">
                            <div class="header__nav__widget__btn">
                                <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
                            </div>
                            @if (session('role') == 'customer' && session('login') == true)
                                <a href="#" class="primary-btn">Dasboard</a>
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
                        <h2>{{ $dataMobil['merk'] . '-' . $dataMobil['nama_model'] . ' ' . $dataMobil['tahun'] }}</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}"><i class="fa fa-home"></i> Home</a>
                            <a href="{{ route('mobil') }}">Daftar Mobil</a>
                            <span>Mobil</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Car Details Section Begin -->
    <section class="car-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="car__details__pic">
                        <div class="car__details__pic__large">
                            <img class="car-big-img" src="{{ asset('data/cars/' . $dataMobil['gambar1']) }}"
                                alt="">
                        </div>
                        <div class="car-thumbs">
                            <div class="car-thumbs-track car__thumb__slider owl-carousel">

                                @for ($i = 2; $i < 5; $i++)
                                    <div class="ct"
                                        data-imgbigurl="{{ asset('data/cars/' . $dataMobil['gambar' . $i]) }}">
                                        <img src="{{ asset('data/cars/' . $dataMobil['gambar' . $i]) }}" alt="">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="car__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Informasi
                                    Kendaraan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Deskripsi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Postingan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab">Youtube</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-5" role="tab">Testimoni</a>
                            </li>


                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="car__details__tab__info">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="car__details__tab__info__item">
                                                <h5>Informasi Kendaraan</h5>
                                                <ul>
                                                    <li>
                                                    <li> <i class="fa fa-check"></i><strong>Merk mobil:</strong>
                                                        {{ $dataMobil['merk'] }}</li>

                                                    <li> <i class="fa fa-check"></i><strong>Model:</strong>
                                                        {{ $dataMobil['nama_model'] }}</li>
                                                    <li> <i class="fa fa-check"></i><strong>Tahun:</strong>
                                                        {{ $dataMobil['tahun'] }}</li>
                                                    <li> <i class="fa fa-check"></i><strong>Warna:</strong>
                                                        {{ $dataMobil['warna'] }}</li>
                                                    <li> <i class="fa fa-check"></i><strong>Kilometer:</strong>
                                                        {{ $dataMobil['km'] }}</li>


                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="car__details__tab__info__item">
                                                <h5>Spesifikasi Kendaraan</h5>
                                                <ul>
                                                    <li> <i class="fa fa-check"></i><strong>Kapasitas Mesin:</strong>
                                                        {{ $dataMobil['kapasitas_mesin'] }}</li>
                                                    <li> <i class="fa fa-check"></i><strong>Jenis Bahan Bakar:</strong>
                                                        {{ $dataMobil['bahan_bakar'] }}</li>
                                                    <li> <i class="fa fa-check"></i><strong>Transmisi:</strong>
                                                        {{ $dataMobil['transmisi'] }}</li>
                                                    <li> <i class="fa fa-check"></i><strong>Kapasitas Penumpang:</strong>
                                                        {{ $dataMobil['kapasitas_penumpang'] }}</li>
                                                    <li> <i class="fa fa-check"></i><strong>Kapasitas Tangki:</strong>
                                                        {{ $dataMobil['tangki'] }}</li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="car__details__tab__info">

                                    <h4 class="text-dark">Deskripsi</h4>
                                    <p class="text-muted mt-3">{{ $dataMobil['deskripsi'] }}</p>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="car__details__tab__info">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="car__details__tab__info__item">
                                                <h5 class="mb-3">Postingan Instagram</h5>


                                                @if ($dataMobil['url_instagram'] != null)
                                                    {{-- Jika url youtube berupa blockquote --}}

                                                    @if (Str::contains($dataMobil['url_instagram'], '<blockquote'))
                                                        {!! $dataMobil['url_instagram'] !!}
                                                    @else
                                                        <a href="{{ $dataMobil['url_instagram'] }}" target="_blank"
                                                            class="btn btn-primary">Lihat Postingan</a>
                                                    @endif
                                                @else
                                                    <p class="text-sm text-muted">Tidak ada postingan.</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="car__details__tab__info__item">
                                                <h5 class="mb-3">Postingan Facebook</h5>

                                                @if ($dataMobil['url_facebook'] != null)
                                                    {{-- Jika url youtube berupa iframe --}}

                                                    @if (Str::contains($dataMobil['url_facebook'], '<iframe'))
                                                        {!! $dataMobil['url_facebook'] !!}
                                                    @else
                                                        <a href="{{ $dataMobil['url_facebook'] }}" target="_blank"
                                                            class="btn btn-primary">Lihat Postingan</a>
                                                    @endif
                                                @else
                                                    <p class="text-sm text-muted">Tidak ada postingan.</p>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-4" role="tabpanel">
                                <div class="car__details__tab__info">


                                    <div class="car__details__tab__info__item">
                                        <h5 class="mb-3">Link Youtube</h5>

                                        @if ($dataMobil['url_youtube'] != null)
                                            {{-- Jika url youtube berupa iframe --}}

                                            @if (Str::contains($dataMobil['url_youtube'], '<iframe'))
                                                {!! $dataMobil['url_youtube'] !!}
                                            @else
                                                <a href="{{ $dataMobil['url_youtube'] }}" target="_blank"
                                                    class="btn btn-primary"><i class="fa fa-play" aria-hidden="true"></i>
                                                    Lihat
                                                    Video</a>
                                            @endif
                                        @else
                                            <p class="text-sm text-muted">Tidak link youtube.</p>
                                        @endif


                                    </div>


                                </div>

                            </div>
                            <div class="tab-pane" id="tabs-5" role="tabpanel">
                                <div class="car__details__tab__info">


                                    <div class="car__details__tab__info__item">
                                        <h5>Review Pelanggan Kami</h5>

                                        @if ($dataReview != null)
                                            <!-- Testimonial Card -->
                                            <div class="testimonial__item mt-4"
                                                style=" padding: 20px; margin-bottom: 20px; background-color: #fff; position: relative; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">



                                                <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                                    <img src="{{ asset('data/profile_photo/' . $dataReview['profile_photo']) }}"
                                                        alt="Profile Picture"
                                                        style="border-radius: 50%; max-width: 50px; margin-right: 20px;">
                                                    <div>
                                                        @for ($i = 1; $i <= $dataReview['star']; $i++)
                                                            <i class="fa fa-star text-warning"
                                                                style="font-size: 1.5rem;"></i>
                                                        @endfor

                                                        <h5 style="margin: 0;">{{ $dataReview['nama_lengkap'] }}</h5>
                                                        <p style="margin: 0; font-size: 0.8rem; color: #6c757d;">
                                                            {{ $dataReview['created_at'] }}</p>
                                                    </div>
                                                </div>

                                                <!-- Review Text -->
                                                <p class="text  text-muted" style="margin-bottom: 15px; font-size: 18px ">
                                                    {{ $dataReview['review_text'] }}
                                                </p>

                                                <!-- Review Images -->
                                                <div style="margin-bottom: -10px;">
                                                    @for ($i = 1; $i <= 4; $i++)
                                                        <a data-toggle="modal"
                                                            data-target="#detailgambar{{ $i }}">
                                                            <img src="{{ asset('data/review/' . $dataReview['image' . $i]) }}"
                                                                style="max-width: 100px; margin-right: 5px;">
                                                        </a>
                                                    @endfor

                                                </div>


                                            </div>
                                        @else
                                            <p class="text text-muted">Belum ada review.</p>
                                        @endif


                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 card-price">
                    <div class="card shadow-sm mb-5 bg-white rounded" style="border-radius: 20px;">
                        <div style="background-color: #3e6ae1" class="div  p-3 d-flex flex-column align-items-center">
                            <h4 class="text-white">{{ $dataApp['app_name'] }}</h4>
                            @if ($dataMobil['status_mobil'] == 1)
                                <p style="text-align: center;" class="text-sm text text-white">Penawaran spesial untuk
                                    Anda
                                </p>
                            @endif

                        </div>


                        <div class="card-body">

                            {{-- Tersedia --}}
                            @if ($dataMobil['status_mobil'] == 1)
                                <div class="car__details__sidebar__payment p-3">

                                    <ul>
                                        <li>Harga <span>{{ formatRupiah($dataMobil['harga_jual']) }}</span></li>
                                        <li>Diskon <span>{{ formatRupiah($dataMobil['diskon']) }}</span></li>
                                        <hr>
                                        <li>Total
                                            <span>{{ formatRupiah($dataMobil['harga_jual'] - $dataMobil['diskon']) }}</span>

                                        </li>
                                        @if ($dataFinance != null)
                                            <p class="text-sm text-warning" style="font-size: 12px; text-align: right">
                                                {{ formatRupiah($dataMobil['total_cicilan']) . '/ bulan' }} </p>
                                    </ul>
                                    <p style="font-size: 12px;" class="text-center">Total cicilan mencakup <b>36x</b>
                                        angsuran dan sudah
                                        termasuk uang muka (DP) serta bunga sebesar <b>{{ $dataFinance['bunga'] }}%</b>
                                        dari total
                                        harga mobil, menggunakan <b><a
                                                href="{{ route('detailDataFinance', Crypt::encrypt($dataFinance['finance_id'])) }}"
                                                class="text-primary">{{ $dataFinance['nama_finance'] }}</a></b>.
                                    </p>
                                @else
                                    </ul>
                            @endif

                            <hr>

                            <a href="#" class="btn btn-primary w-100 mt-3"><i class="fa fa-check-circle"
                                    aria-hidden="true"></i>
                                <b> Pesan Sekarang</b></a>

                            @if ($dataFinance != null)
                                <button data-toggle="modal" data-target="#finance_chooser"
                                    class="btn btn-warning w-100 mt-3"><i class="fa fa-credit-card"></i>
                                    <b> Ajukan Kredit</b></button>
                            @endif
                            <a href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dataApp['no_hp']) }}&text=Halo,%20saya%20ingin%20bertanya%20tentang%20mobil%20{{ $dataMobil['merk'] }}%20{{ $dataMobil['nama_model'] }}%20{{ $dataMobil['tahun'] }}"
                                target="_blank" rel="noopener noreferrer"
                                class="btn btn-success sidebar-btn w-100 mt-3"><i class="fa fa-whatsapp"
                                    aria-hidden="true"></i></i>
                                <b>Hubungi Kami</b></a>

                            <div class="div mt-3 d-flex justify-content-center"> <a href="{{ route('userGuide') }}"
                                    style="font-size: 12px;" class="text-sm text-primary">
                                    Baca panduan pengguna.</a></div>




                        </div>

                        {{-- Terjual --}}
                    @elseif ($dataMobil['status_mobil'] == 0)
                        <div class="car__details__sidebar__payment p-3">

                            <ul>
                                <li>Harga <span class="text-muted">{{ formatRupiah($dataMobil['harga_jual']) }}</span>
                                </li>
                                <li>Diskon <span class="text-muted">{{ formatRupiah($dataMobil['diskon']) }}</span>
                                </li>
                                <hr>
                                <li>Total
                                    <span
                                        class="text-muted">{{ formatRupiah($dataMobil['harga_jual'] - $dataMobil['diskon']) }}</span>

                                </li>

                            </ul>

                            <hr>
                            <span style="background-color: #eee" class="badge p-2 d-flex justify-content-center">
                                <h5 class="text text-dark">Terjual</h5>
                            </span>


                        </div>
                    @else
                        <div class="car__details__sidebar__payment p-3 ">

                            <ul>
                                <li>Harga <span class="text-muted">{{ formatRupiah($dataMobil['harga_jual']) }}</span>
                                </li>
                                <li>Diskon <span class="text-muted">{{ formatRupiah($dataMobil['diskon']) }}</span>
                                </li>
                                <hr>
                                <li>Total
                                    <span
                                        class="text-muted">{{ formatRupiah($dataMobil['harga_jual'] - $dataMobil['diskon']) }}</span>

                                </li>



                            </ul>

                            <span class="badge bg-warning p-2 d-flex justify-content-center">
                                <h5 class="text text-dark">Di pesan</h5>
                            </span>


                        </div>
                        @endif
                    </div>


                </div>
            </div>
        </div>

        {{-- Modal pilih finance --}}

        <div class="modal fade" id="finance_chooser" tabindex="-1" role="dialog" aria-labelledby="galleryModalTitle"
            aria-hidden="true">
            <div class="modal-dialog " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="galleryModalTitle">
                            Pilih Finance
                        </h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row justify-content-center">
                            @foreach ($dataAllFinance as $daf)
                                <div class="col-md-6 d-flex flex-column align-items-center">
                                    <div style="border-radius: 20px;" class="card p-3">
                                        <a
                                            href="{{ route('credit', ['mobilId' => Crypt::encrypt($dataMobil['mobil_id']), 'financeId' => Crypt::encrypt($daf->finance_id)]) }}">
                                            <img src="{{ asset('data/finance/img/' . $daf['image']) }}" alt="">
                                        </a>

                                        <p class="mt-2 text-dark text-center"><b>Bunga {{ $daf->bunga }}% / bulan</b>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>



        {{-- Modal gambar testimoni --}}
        @if ($dataMobil['status_mobil'] == 0)
            @for ($i = 1; $i <= 4; $i++)
                <div class="modal fade" id="detailgambar{{ $i }}" tabindex="-1" role="dialog"
                    aria-labelledby="galleryModalTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="galleryModalTitle">
                                    Gambar review
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div id="Gallerycarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        <img src="{{ asset('data/review/' . $dataReview['image' . $i]) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        @endif


    </section>
@endsection

@section('js')
@endsection
