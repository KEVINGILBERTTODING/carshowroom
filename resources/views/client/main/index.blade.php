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
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <section class="hero spad set-bg" data-setbg="{{ asset('template/client/img/main/' . $dataApp['img_hero']) }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="hero__text">
                        <div class="hero__text__title">
                            <h3 class="text-white">Temukan Mobil Impian Anda</h3>
                            <h2>Rizki Motor</h2>
                        </div>

                        <a href="{{ route('mobil') }}" class="primary-btn"><img src="img/wheel.png" alt="">
                            Temukan Sekarang</a>
                        <a href="{{ route('aboutUs') }}" class="primary-btn more-btn">Tentang Kami</a>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="hero__tab">
                        {{-- <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" style="border-radius: 20px;" data-toggle="tab" href="#tabs-1"
                                    role="tab">
                                    Masuk</a>
                            </li>
                            <li class="nav-item">

                            </li>
                        </ul> --}}
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="hero__tab__form" style="border-radius: 20px;">
                                    <h2>Masuk</h2>

                                    <p class="text-sm text-muted">Baru bergabung? <a data-toggle="tab"
                                            style="text-decoration: none; color: #3e6ae1 ;" href="#tabs-2" role="tab">
                                            Buat akun baru</a></p>

                                    <form>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" id="email" placeholder="Email" class="form-control"
                                                name="email" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Kata Sandi</label>
                                            <input type="password" id="password" placeholder="Kata sandi"
                                                class="form-control" name="password" required>
                                        </div>
                                        <button type="submit" style="width: 100%;"
                                            class="site-btn full-width-btn">Masuk</button>
                                    </form>
                                    <div class="divider d-flex justify-content-center my-4">
                                        <p class="text-center fw-bold mx-3 mb-0 text-muted">ATAU</p>
                                    </div>
                                    <button id="btn-google" class="site-btn mt-4"
                                        style="width: 100%; background-color: #3e6ae1; display: flex; align-items: center; justify-content: center; text-align: left;">
                                        <i class="fa fa-google" aria-hidden="true" style="margin-right: 10px;"></i>
                                        Masuk dengan akun google
                                    </button>


                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <div class="hero__tab__form" style="border-radius: 20px;">
                                    <h2>Masuk</h2>

                                    <p class="text-sm text-muted">Telah memiliki akun? <a data-toggle="tab"
                                            style="text-decoration: none; color: #3e6ae1 ;" href="#tabs-1"
                                            role="tab">
                                            Masuk</a></p>

                                    <form>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" id="email" placeholder="Email"
                                                class="form-control" name="email" required>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label>Kata Sandi</label>
                                            <input type="password" id="password" placeholder="Kata sandi"
                                                class="form-control" name="password" required>
                                        </div>
                                        <button type="submit" style="width: 100%;"
                                            class="site-btn full-width-btn">Masuk</button>
                                    </form>
                                    <div class="divider d-flex justify-content-center my-4">
                                        <p class="text-center fw-bold mx-3 mb-0 text-muted">ATAU</p>
                                    </div>
                                    <button id="btn-google" class="site-btn mt-4"
                                        style="width: 100%; background-color: #3e6ae1; display: flex; align-items: center; justify-content: center; text-align: left;">
                                        <i class="fa fa-google" aria-hidden="true" style="margin-right: 10px;"></i>
                                        Masuk dengan akun google
                                    </button>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
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
                        <a href="{{ route('aboutUs') }}" class="primary-btn">Tentang Kami</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="chooseus__video set-bg">
            <img src="{{ asset('template/client/img/main/footer.png') }}" alt="">

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
                            <div class="testimonial__item">
                                <div class="testimonial__item__author">
                                    <div class="testimonial__item__author__pic">
                                        <img style="width: 50px;"
                                            src="{{ asset('data/profile_photo/' . $dr->profile_photo) }}" alt="">
                                    </div>
                                    <div class="testimonial__item__author__text">
                                        <div class="rating">
                                            @for ($i = 1; $i <= $dr->star; $i++)
                                                <i class="fa fa-star"></i>
                                            @endfor
                                        </div>
                                        <h5> {{ $dr->nama_lengkap }}</span></h5>
                                        <h6>{{ $dr->created_at }}</h6>
                                    </div>
                                </div>
                                <p>
                                    {{ $dr->review_text }}
                                </p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script type="module">
        // Import the functions you need from the SDKs you need
        import {
            initializeApp
        } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-app.js";
        import {
            getAnalytics
        } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-analytics.js";

        import {
            GoogleAuthProvider,
            getAuth,
            signInWithPopup
        } from "https://www.gstatic.com/firebasejs/10.6.0/firebase-auth.js"
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyC7RG6qHRqNyPoGrffer4fUIGIYR1xpNzQ",
            authDomain: "rizqi-motor-32f51.firebaseapp.com",
            projectId: "rizqi-motor-32f51",
            storageBucket: "rizqi-motor-32f51.appspot.com",
            messagingSenderId: "463365809602",
            appId: "1:463365809602:web:97177ca8bc54dea2dbe25b",
            measurementId: "G-9YVGX5MPHC"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);


        const provider = new GoogleAuthProvider();
        const auth = getAuth();

        document.querySelector('#btn-google').addEventListener('click', function(e) {
            signInWithPopup(auth, provider)
                .then((result) => {
                    // This gives you a Google Access Token. You can use it to access the Google API.
                    const credential = GoogleAuthProvider.credentialFromResult(result);
                    const token = credential.accessToken;
                    // The signed-in user info.
                    const user = result.user;
                    // IdP data available using getAdditionalUserInfo(result)
                    // ...
                    console.log(user);
                }).catch((error) => {
                    // Handle Errors here.
                    const errorCode = error.code;
                    const errorMessage = error.message;
                    // The email of the user's account used.
                    const email = error.customData.email;
                    // The AuthCredential type that was used.
                    const credential = GoogleAuthProvider.credentialFromError(error);
                    // ...
                });
        });
    </script>
@endsection
