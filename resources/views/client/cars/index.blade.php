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
            @if (session('client') == true)
                <a href="{{ route('dashboardClient') }}" class="primary-btn text-dark">Dashboard</a>
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
                            @if (session('client') == true)
                                <a href="{{ route('dashboardClient') }}" class="primary-btn text-dark">Dashboard</a>
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
                            <a href="{{ route('/') }}"><i class="fa fa-home"></i> Beranda</a>
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
                            <form action="{{ route('cariMobil') }}" action="get">
                                @csrf
                                <input type="text" name="keyword" placeholder="Cari...">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        {{-- filter --}}
                        <div class="car__filter">
                            <h5>Filter Mobil</h5>
                            <form action="{{ route('filterMobil') }}" method="GET">
                                @csrf
                                <p class="text-sm">Merk</p>
                                <select name="merkId">
                                    <option value="0">Pilih Merk</option>
                                    @foreach ($dataMerk as $dam)
                                        <option value="{{ $dam->merk_id }}">{{ $dam->merk }}</option>
                                    @endforeach
                                </select>

                                <p class="text-sm">Jenis</p>
                                <select name="bodyId">
                                    <option value="0">Pilih Jenis Body</option>
                                    @foreach ($dataBody as $db)
                                        <option value="{{ $db->body_id }}">{{ $db->body }}</option>
                                    @endforeach
                                </select>


                                <p class="text-sm">Transmisi</p>
                                <select name="transmisiId">
                                    <option value="0">Pilih Transmisi</option>
                                    @foreach ($dataTransmisi as $tm)
                                        <option value="{{ $tm->transmisi_id }}">{{ $tm->transmisi }}</option>
                                    @endforeach
                                </select>

                                <div>
                                    <p class="text-sm">Harga Mulai</p>
                                    <input name="priceFrom" placeholder="Rp." class="form-control rupiahInput">
                                </div>

                                <div>
                                    <p class="text-sm">Harga Akhir</p>
                                    <input name="priceEnd" placeholder="Rp." type="text"
                                        class="form-control rupiahInput">
                                </div>

                                <div class="car__filter__btn mt-3 ">
                                    <button type="submit" type="text" class="site-btn text-dark"><i
                                            class="fa fa-filter"></i>
                                        Filter</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
                <div class="col-lg-9">

                    @if (!$dataMobil->isEmpty())
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
                                                    <h5><a
                                                            href="{{ route('detailMobil', Crypt::encrypt($dm->mobil_id)) }}">{{ $dm->merk . ' ' . $dm->nama_model }}</a>
                                                    </h5>
                                                    <ul>
                                                        <li class="text-dark">{{ formatDecimal($dm->km) }} KM</li>
                                                        <li class="text-dark">{{ $dm->transmisi }}</li>
                                                    </ul>
                                                @else
                                                    <div class="label-date text-muted">{{ $dm->tahun }}</div>
                                                    <h5><a href="{{ route('detailMobil', Crypt::encrypt($dm->mobil_id)) }}"
                                                            class="text-muted">{{ $dm->merk . ' ' . $dm->nama_model }}</a>
                                                    </h5>
                                                    <ul>
                                                        <li class="text-dark">{{ formatDecimal($dm->km) }} KM</li>
                                                        <li class="text-muted">{{ $dm->transmisi }}</li>
                                                    </ul>
                                                @endif

                                            </div>
                                            <div class="car__item__price"
                                                style="display: flex; justify-content: space-between; align-items: center;">
                                                @if ($dm->status_mobil == 1)
                                                    <span class="car-option available">Tersedia</span>
                                                    @if ($dm->diskon != 0)
                                                        <div
                                                            style="display: flex; flex-direction: column; align-items: flex-end;">
                                                            <h6 style="text-decoration: line-through; text-decoration-thickness: 2px;"
                                                                class="text-muted text-decoration-line-through">
                                                                {{ formatRupiah($dm->harga_jual) }}</h6>
                                                            <h6 class="text-dark text-decoration-line-through">
                                                                {{ formatRupiah($dm->harga_jual - $dm->diskon) }}</h6>
                                                            @if ($dm->total_cicilan != 0)
                                                                <p class="text-warning" style="font-size: 12px;">
                                                                    {{ formatRupiah($dm->total_cicilan) }} /
                                                                    bulan</p>
                                                            @endif
                                                        </div>
                                                    @else
                                                        <div
                                                            style="display: flex; flex-direction: column; align-items: flex-end;">
                                                            <h6 class="text-muted">
                                                                {{ formatRupiah($dm->harga_jual) }} </h6>
                                                            @if ($dm->total_cicilan != 0)
                                                                <p class="text-warning" style="font-size: 12px;">
                                                                    {{ formatRupiah($dm->total_cicilan) }} /
                                                                    bulan</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @elseif ($dm->status_mobil == 0)
                                                    <span class="car-option soldout">Terjual</span>
                                                    @if ($dm->diskon != 0)
                                                        <div
                                                            style="display: flex; flex-direction: column; align-items: flex-end;">
                                                            <h6 style="text-decoration: line-through; text-decoration-thickness: 2px;"
                                                                class="text-muted text-decoration-line-through">
                                                                {{ formatRupiah($dm->harga_jual) }}</h6>
                                                            <h6 class="text-muted text-decoration-line-through">
                                                                {{ formatRupiah($dm->harga_jual - $dm->diskon) }}</h6>

                                                        </div>
                                                    @else
                                                        <div
                                                            style="display: flex; flex-direction: column; align-items: flex-end;">
                                                            <h6 class="text-muted">
                                                                {{ formatRupiah($dm->harga_jual) }}</h6>
                                                            <p class="text-warning" style="font-size: 12px;">
                                                                {{ formatRupiah($dm->total_cicilan) }} /
                                                                bulan</p>
                                                        </div>
                                                    @endif
                                                @else
                                                    <span class="car-option booked text-dark">Di pesan</span>
                                                    @if ($dm->diskon != 0)
                                                        <div
                                                            style="display: flex; flex-direction: column; align-items: flex-end;">
                                                            <h6 style="text-decoration: line-through; text-decoration-thickness: 2px;"
                                                                class="text-muted text-decoration-line-through">
                                                                {{ formatRupiah($dm->harga_jual) }}</h6>
                                                            <h6 class="text-muted text-decoration-line-through">
                                                                {{ formatRupiah($dm->harga_jual - $dm->diskon) }}</h6>


                                                            @if ($dm->total_cicilan != 0)
                                                                <p class="text-warning" style="font-size: 12px;">
                                                                    {{ formatRupiah($dm->total_cicilan) }} /
                                                                    bulan</p>
                                                            @endif

                                                        </div>
                                                    @else
                                                        <div
                                                            style="display: flex; flex-direction: column; align-items: flex-end;">
                                                            <h6 class="text-muted">
                                                                {{ formatRupiah($dm->harga_jual) }}</h6>
                                                            @if ($dm->total_cicilan != 0)
                                                                <p class="text-warning" style="font-size: 12px;">
                                                                    {{ formatRupiah($dm->total_cicilan) }} /
                                                                    bulan</p>
                                                            @endif
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>

                        {{-- pagination --}}
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
                    @else
                        <div class="row d-flex justify-content-center">
                            <h3 class="d-flex justify-content-center">Tidak ada mobil yang sesuai.</h3>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    {{-- Format rupiah --}}
    <script>
        $(document).ready(function() {
            $('.rupiahInput').on('input', function() {
                // Mengambil nilai tanpa tanda ribuan
                var inputValue = $(this).val();

                // Hapus karakter selain digit
                var numericValue = inputValue.replace(/[^0-9]/g, '');

                // Format sebagai rupiah
                var formattedValue = formatRupiah(numericValue);

                // Update nilai input
                $(this).val(formattedValue);
            });
        });

        function formatRupiah(angka) {
            // Hapus karakter selain digit
            var numericValue = angka.replace(/[^0-9]/g, '');

            // Pastikan angka tidak kosong
            if (numericValue === '') {
                return '';
            }

            var reverse = numericValue.toString().split('').reverse().join('');
            var ribuan = reverse.match(/\d{1,3}/g);
            var formattedValue = ribuan.join('.').split('').reverse().join('');

            return 'Rp ' + formattedValue;
        }
    </script>
@endsection
