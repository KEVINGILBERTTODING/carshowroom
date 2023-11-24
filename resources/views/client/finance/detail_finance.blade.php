@extends('layouts.client.t_client_main')

@section('title')
    <title>{{ $dataApp['app_name'] . ' - Finance' }}</title>
@endsection

@section('content')
    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__widget">

            <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
            @if (session('client') == true)
                <a href="#" class="primary-btn text-dark">Dashboard</a>
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
                                <li class="active"><a href="{{ route('dataFinance') }}">Finance</a></li>
                                <li><a href="{{ route('aboutUs') }}">About</a></li>
                            </ul>
                        </nav>
                        <div class="header__nav__widget">
                            <div class="header__nav__widget__btn">

                                <a href="#" class="search-switch"><i class="fa fa-search"></i></a>
                            </div>
                            @if (session('client') == true)
                                <a href="#" class="primary-btn text-dark">Dashboard</a>
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
                        <h2>{{ $dataFinance['nama_finance'] }}</h2>
                        <div class="breadcrumb__links">
                            <a href="{{ route('/') }}"><i class="fa fa-home"></i> Beranda</a>
                            <a href="{{ route('dataFinance') }}">
                                Finance</a>
                            <span>{{ $dataFinance['nama_finance'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <h2>{{ $dataFinance['nama_finance'] }}</h2>
                            <p>{{ $dataFinance['deskripsi'] }}</p>
                        </div>
                        <ul>

                            @if ($dataFinance['email'] != null)
                                <li><span>Email:</span> <a class="text-primary" href="mailto:{{ $dataFinance['email'] }}"
                                        target="_blank" rel="noopener noreferrer" style="text-decoration: none; ">
                                        {{ $dataFinance['email'] }}</a></li>
                            @endif

                            @if ($dataFinance['telepon'] != null)
                                <li><span>No Hp:</span> <a class="text-primary"
                                        href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dataFinance['telepon']) }}&text=Halo,%20*"
                                        target="_blank" rel="noopener noreferrer" style="text-decoration: none; ">
                                        {{ $dataFinance['telepon'] }}</a></li>
                            @endif

                        </ul>

                    </div>
                    <div class="footer__social">
                        @if ($dataFinance['url_facebook'] != null)
                            <a href="{{ $dataFinance['url_facebook'] }}" target="_blank" class="facebook"><i
                                    class="fa fa-facebook"></i></a>
                        @endif

                        @if ($dataFinance['url_instagram'] != null)
                            <a href="{{ $dataFinance['url_instagram'] }}" target="_blank" class="skype"><i
                                    class="fa fa-instagram"></i></a>
                        @endif

                        @if ($dataFinance['url_website'] != null)
                            <a href="{{ $dataFinance['url_website'] }}" target="_blank" class="google"><i
                                    class="fa fa-globe"></i></a>
                        @endif

                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="services__item">
                        <img src="{{ asset('data/finance/img/' . $dataFinance['image']) }}" alt="">
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
@endsection
