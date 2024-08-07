@extends('layouts.client.t_client_main')

@section('title')
    <title>{{ $dataApp['app_name'] }}</title>
@endsection

@section('content')
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__widget">

            <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
            @if (session('client') == true)
                <a href="{{ route('dashboardClient') }}" class="primary-btn text-dark btnDashboard">Dashboard</a>
            @else
                <a href="{{ route('client.sign-in') }}" class="primary-btn text-dark btnDashboard">Login</a>
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
                                <li class="active"><a href="{{ route('/') }}">Beranda</a></li>
                                <li><a href="{{ route('mobil') }}">Mobil</a></li>
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
                                <a href="{{ route('dashboardClient') }}"
                                    class="primary-btn text-dark btnDashboard">Dashboard</a>
                            @else
                                <a href="{{ route('client.sign-in') }}"
                                    class="primary-btn text-dark btnDashboard">Login</a>
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
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <div id="carouselExample" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExample" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExample" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" style="max-height: 100;"
                    src="{{ asset('template/client/img/main/' . $dataApp['img_hero1']) }}" alt="First slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="hero__text">
                        <div class="hero__text__title">
                            <h3 class="text-white">Temukan Mobil Impian Anda</h3>
                            <h2>Rizki Motor</h2>
                        </div>
                        <a href="{{ route('mobil') }}" class="primary-btn" style="color: black">Temukan Sekarang</a>
                        <a href="{{ route('aboutUs') }}" class="primary-btn more-btn">Tentang Kami</a>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img class="d-block w-100" src="{{ asset('template/client/img/main/' . $dataApp['img_hero2']) }}"
                    alt="Second slide">
                <div class="carousel-caption d-none d-md-block">
                    <div class="hero__text">
                        <div class="hero__text__title">
                            <h3 class="text-white">Bergabung Bersama Kami</h3>
                            <h2>Rizki Motor</h2>
                        </div>
                        <a href="{{ route('client.register') }}" class="primary-btn" style="color: black">
                            Daftar Sekarang
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Hero Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    {{-- PELIHAT WEBSITE --}}
                    <div class="section-title">
                        <span>Pengunjung Website</span>
                        <h2>Total Pengunjung Website</h2>
                        <h5>{{ $jumlah_visitor }} Pengunjung</h5>
                    </div>

                    <div class="section-title">
                        <span>Pelayanan Kami</span>
                        <h2>Apa Yang Kami Tawarkan</h2>
                        <p>
                            Temukan berbagai pilihan mobil murah berkualitas. Proses pembelian yang
                            mudah dan transparan, membawa Anda satu langkah lebih dekat untuk memiliki mobil impian.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/services/service1.png') }}"
                            alt="">
                        <h5>Mobil Murah Berkualitas</h5>
                        <p>
                            Nikmati mobil impian tanpa menguras kantong. Temukan penawaran mobil murah dan berkualitas
                            tinggi sesuai kebutuhan mobilitas Anda.
                        </p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/services/service2.png') }}"
                            alt="">
                        <h5>Terjamin Aman</h5>
                        <p>
                            Kami memahami betapa pentingnya keamanan dalam setiap transaksi. Data pribadi Anda akan dijaga
                            kerahasiaannya dengan baik.
                        </p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/services/service3.png') }}"
                            alt="">
                        <h5>Cicilan Mudah</h5>
                        <p>
                            Tersedia pembayaran cicilan yang mudah, berkat kerjasama kami
                            dengan lembaga keuangan terpercaya.
                        </p>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="services__item">
                        <img style="width: 40%;" src="{{ asset('template/client/img/services/service4.png') }}">
                        <h5>Pelayanan Cepat dan Responsif</h5>
                        <p>
                            Tim kami siap membantu untuk membuat proses
                            pembelian mobil Anda lebih mudah dan efisien.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <!-- Feature Section Begin -->
    <section class="feature spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="feature__text">
                        <div class="section-title">
                            <span>Keunggulan Kami</span>
                            <h2>Kami Telah Terpercaya di Dunia Otomotif</h2>
                        </div>
                        <div class="feature__text__desc">
                            <p>Nikmati kenyamanan berbelanja mobil dengan nama terpercaya di industri otomotif. Kami
                                berkomitmen untuk memberikan pengalaman yang luar biasa.</p>
                            <p>Untuk mengetahui lebih lanjut tentang layanan kami, jangan ragu untuk menghubungi kami atau
                                kunjungi showroom kami.</p>
                        </div>
                        <div class="feature__text__btn">

                            <a href="#" class="primary-btn partner-btn">Testimoni Kami</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-4">
                    <div class="row">
                        <div class="col-lg-6 col-md-4 col-6">
                            <div class="feature__item">
                                <div class="feature__item__icon">
                                    <img src="{{ asset('template/client/img/feature/feature-1.png') }}" alt="">
                                </div>
                                <h6>Engine</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-6">
                            <div class="feature__item">
                                <div class="feature__item__icon">
                                    <img src="{{ asset('template/client/img/feature/feature-2.png') }}" alt="">
                                </div>
                                <h6>Turbo</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-6">
                            <div class="feature__item">
                                <div class="feature__item__icon">
                                    <img src="{{ asset('template/client/img/feature/feature-3.png') }}" alt="">
                                </div>
                                <h6>Colling</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-6">
                            <div class="feature__item">
                                <div class="feature__item__icon">
                                    <img src="{{ asset('template/client/img/feature/feature-4.png') }}" alt="">
                                </div>
                                <h6>Suspension</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-6">
                            <div class="feature__item">
                                <div class="feature__item__icon">
                                    <img src="{{ asset('template/client/img/feature/feature-5.png') }}" alt="">
                                </div>
                                <h6>Electrical</h6>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-4 col-6">
                            <div class="feature__item">
                                <div class="feature__item__icon">
                                    <img src="{{ asset('template/client/img/feature/feature-6.png') }}" alt="">
                                </div>
                                <h6>Brakes</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Chooseus Section Begin -->
    <section class="chooseus spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="chooseus__text">
                        <div class="section-title">
                            <h2>Kenapa Memilih Kami?</h2>
                            <p>Kami menyajikan alasan-alasan mengapa Anda seharusnya memilih layanan kami.</p>
                        </div>
                        <ul>
                            <li><i class="fa fa-check-circle"></i> Pengalaman - Kami memiliki pengalaman dalam menyediakan
                                layanan terbaik.</li>
                            <li><i class="fa fa-check-circle"></i> Kualitas - Produk berkualitas tinggi untuk kepuasan
                                Anda.</li>
                            <li><i class="fa fa-check-circle"></i> Pelayanan - Layanan pelanggan yang ramah dan responsif.
                            </li>
                            <li><i class="fa fa-check-circle"></i> Keandalan - Terpercaya dalam memberikan solusi mobilitas
                                Anda.</li>
                        </ul>
                        <a href="{{ route('aboutUs') }}" class="primary-btn" style="color: black">Tentang Kami</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="chooseus__video set-bg">
            <img src="{{ asset('template/client/img/main/' . $dataApp['img_about_us2']) }}" alt="Image">

        </div>
    </section>
    <!-- Chooseus Section End -->

    <!-- Testimonial Section Begin -->
    <section class="testimonial spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title testimonial-title">
                        <span>Testimoni</span>
                        <h2>Apa Kata Mereka Tentang Kami</h2>
                        <p>Pelanggan kami adalah pendukung terbesar kami. Apa pendapat mereka tentang kami? Temukan di bawah
                            ini.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="testimonial__slider owl-carousel">
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($dataReview as $dr)
                        <div class="col-lg-6">

                            <div style="display: flex; align-items: center; margin-bottom: 15px;">
                                @if ($dr->sign_in == 'google')
                                    <img src="{{ $dr->profile_photo }}" alt="Profile Picture"
                                        style="border-radius: 50%; max-width: 50px; margin-right: 20px;">
                                    <div>
                                    @else
                                        <img src="{{ asset('data/profile_photo/' . $dr['profile_photo']) }}"
                                            alt="Profile Picture"
                                            style="border-radius: 50%; max-width: 50px; margin-right: 20px;">
                                        <div>
                                @endif
                                @for ($i = 1; $i <= $dr->star; $i++)
                                    <i class="fa fa-star text-warning" style="font-size: 1.5rem;"></i>
                                @endfor

                                <h6 style="margin: 0;"><b>{{ $dr->nama_lengkap }}</b></h6>
                                <p style="margin: 0; font-size: 0.8rem; color: #6c757d;">
                                    {{ $dr->created_at }}</p>

                                <p style="margin: 0; font-size: 15px; color: black;">
                                    {{ $dr->review_text }}</p>
                            </div>
                        </div>
                </div>
                @endforeach


            </div>
        </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
