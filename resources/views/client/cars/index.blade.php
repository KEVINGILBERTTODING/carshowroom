@extends('layouts.client.t_client_main')

@section('title')
    <title>{{ $dataApp['app_name'] . ' - Mobil' }}</title>
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
                                <li><a href="./blog.html">Testimoni</a></li>
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
                        <h2>Daftar Mobil</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}"><i class="fa fa-home"></i> Home</a>
                            <span>Mobil</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Car Section Begin -->
    <section class="car spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="car__sidebar">
                        <div class="car__search">
                            <h5>Cari Mobil</h5>
                            <form action="#">
                                <input type="text" placeholder="Cari...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        {{-- filter --}}
                        <div class="car__filter">
                            <h5>Filter Mobil</h5>
                            <form action="#">
                                <p class="text-sm">Merk</p>
                                <select>
                                    @foreach ($dataMerk as $dam)
                                        <option value="{{ $dam->merk_id }}">{{ $dam->merk }}</option>
                                    @endforeach
                                </select>

                                <p class="text-sm">Jenis</p>
                                <select>
                                    @foreach ($dataBody as $db)
                                        <option value="{{ $db->body_id }}">{{ $db->body }}</option>
                                    @endforeach
                                </select>


                                <p class="text-sm">Transmisi</p>
                                <select>
                                    @foreach ($dataTransmisi as $tm)
                                        <option value="{{ $tm->transmisi_id }}">{{ $tm->transmisi }}</option>
                                    @endforeach
                                </select>

                                <div class="car__filter__btn mt-3 ">
                                    <button type="submit" class="site-btn"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="car__filter__option">
                        <div class="row">
                            {{-- <div class="col-lg-6 col-md-6">
                                <div class="car__filter__option__item">
                                    <h6>Show On Page</h6>
                                    <select>
                                        <option value="">9 Car</option>
                                        <option value="">15 Car</option>
                                        <option value="">20 Car</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col">
                                <div class="car__filter__option__item car__filter__option__item--right">
                                    <h6>Sort By</h6>
                                    <select>
                                        <option value="">Harga Tertinggi</option>
                                        <option value="">Harga Terendah</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($dataMobil as $dm)
                            <div class="col-lg-4 col-md-4">
                                <div class="car__item">
                                    <div class="car__item__pic__slider owl-carousel">
                                        <img src="{{ asset('data/cars/' . $dm->gambar1) }}" alt=""
                                            style="height: 200px; width: 100%; object-fit: cover;">
                                        <img src="{{ asset('data/cars/' . $dm->gambar2) }}" alt=""
                                            style="height: 200px; width: 100%; object-fit: cover;">
                                        <img src="{{ asset('data/cars/' . $dm->gambar3) }}" alt=""
                                            style="height: 200px; width: 100%; object-fit: cover;">
                                        <img src="{{ asset('data/cars/' . $dm->gambar4) }}" alt=""
                                            style="height: 200px; width: 100%; object-fit: cover;">
                                        <img src="{{ asset('data/cars/' . $dm->gambar5) }}" alt=""
                                            style="height: 200px; width: 100%; object-fit: cover;">
                                        <img src="{{ asset('data/cars/' . $dm->gambar6) }}" alt=""
                                            style="height: 200px; width: 100%; object-fit: cover;">
                                    </div>

                                    <div class="car__item__text">
                                        <div class="car__item__text__inner">
                                            @if ($dm->status_mobil == 1)
                                                <div class="label-date">{{ $dm->tahun }}</div>
                                                <h5><a href="#">{{ $dm->merk . ' ' . $dm->nama_model }}</a></h5>
                                                <ul>
                                                    <li class="text-dark">{{ $dm->km }} KM</li>
                                                    <li class="text-dark">{{ $dm->transmisi }}</li>
                                                </ul>
                                            @else
                                                <div class="label-date text-muted">{{ $dm->tahun }}</div>
                                                <h5><a href="#"
                                                        class="text-muted">{{ $dm->merk . ' ' . $dm->nama_model }}</a>
                                                </h5>
                                                <ul>
                                                    <li class="text-muted">{{ $dm->km }} KM</li>
                                                    <li class="text-muted">{{ $dm->transmisi }}</li>
                                                </ul>
                                            @endif

                                        </div>
                                        <div class="car__item__price">
                                            @if ($dm->status_mobil == 1)
                                                <span class="car-option available">Tersedia</span>
                                                @if ($dm->diskon != 0)
                                                    <h6 style="  text-decoration: line-through; text-decoration-thickness: 2px;"
                                                        class="text-muted text-decoration-line-through">
                                                        {{ formatRupiah($dm->harga_jual) }}</h6>
                                                    <h6 class="text-dark text-decoration-line-through">
                                                        {{ formatRupiah($dm->harga_jual - $dm->diskon) }}</h6>
                                                @else
                                                    <h6 class="text-muted">
                                                        {{ formatRupiah($dm->harga_jual) }}</h6>
                                                @endif
                                            @elseif ($dm->status_mobil == 0)
                                                <span class="car-option soldout">Terjual</span>
                                                @if ($dm->diskon != 0)
                                                    <h6 style="  text-decoration: line-through; text-decoration-thickness: 2px;"
                                                        class="text-muted text-decoration-line-through">
                                                        {{ formatRupiah($dm->harga_jual) }}</h6>

                                                    <h6 class="text-muted text-decoration-line-through">
                                                        {{ formatRupiah($dm->harga_jual - $dm->diskon) }}</h6>
                                                @else
                                                    <h6 class="text-muted">
                                                        {{ formatRupiah($dm->harga_jual) }}</h6>
                                                @endif
                                            @else
                                                <span class="car-option booked">Dipesan</span>
                                                @if ($dm->diskon != 0)
                                                    <h6 style="  text-decoration: line-through; text-decoration-thickness: 2px;"
                                                        class="text-muted text-decoration-line-through">
                                                        {{ formatRupiah($dm->harga_jual) }}</h6>
                                                    <h6 class="text-muted text-decoration-line-through">
                                                        {{ formatRupiah($dm->harga_jual - $dm->diskon) }}</h6>
                                                @else
                                                    <h6 class="text-muted">
                                                        {{ formatRupiah($dm->harga_jual) }}</h6>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                    <div class="pagination__option">
                        @php
                            $currentPage = $dataMobil->currentPage();
                            $lastPage = $dataMobil->lastPage();
                        @endphp

                        {{-- Tampilkan tautan pagination ke halaman sebelumnya --}}
                        @if ($currentPage > 1)
                            <a href="{{ $dataMobil->previousPageUrl() }}" class="pagination-link">
                                {{ $currentPage - 1 }}
                            </a>
                        @endif

                        {{-- Tampilkan halaman saat ini dengan class "active" --}}
                        <a href="#" class="pagination-link active">{{ $currentPage }}</a>

                        {{-- Tampilkan tautan pagination ke halaman berikutnya --}}
                        @if ($currentPage < $lastPage)
                            <a href="{{ $dataMobil->nextPageUrl() }}" class="pagination-link">
                                {{ $currentPage + 1 }}
                            </a>
                        @endif

                        {{-- Tampilkan tautan ke halaman terakhir --}}
                        @if ($currentPage < $lastPage - 1)
                            <a href="{{ $dataMobil->url($lastPage) }}" class="pagination-link">
                                {{ $lastPage }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
