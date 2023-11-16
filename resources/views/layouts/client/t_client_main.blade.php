<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="HVAC Template">
    <meta name="keywords" content="HVAC, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('template/client/css/bootstrap.min.css') }}"type="text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/font-awesome.min.css') }}"type=" text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/elegant-icons.css') }}"type="text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/nice-select.css') }}"type=" text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/magnific-popup.css') }}"type="text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/jquery-ui.min.css') }}"type=" text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/owl.carousel.min.css') }}"type="text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/slicknav.min.css') }}"type="text/css">
    <link rel="stylesheet" href="{{ asset('template/client/css/style.css') }}" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    {{-- Main content --}}
    @yield('content')


    <!-- Footer Section Begin -->
    <footer class="footer set-bg" style="background-color: black">
        <div class="container">
            <div class="footer__contact">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__contact__title">
                            <h3 style="color: white">Hubungi Kami Sekarang!</h3>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__contact__option">
                            <div class="option__item">
                                <i class="fa fa-phone"></i>
                                <a href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dataApp['no_hp']) }}&text=Halo,%20*"
                                    target="_blank" rel="noopener noreferrer"
                                    style="text-decoration: none; color: white">
                                    {{ $dataApp['no_hp'] }}
                                </a>
                            </div>

                            <div class="option__item email">
                                <i class="fa fa-envelope-o"></i>
                                <a href="mailto:{{ $dataApp['email'] }}"
                                    style="text-decoration: none; color: black">{{ $dataApp['email'] }}</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img style="width: 60px;"
                                    src="{{ asset('data/app/img/' . $dataApp['logo']) }}" alt=""></a>
                        </div>
                        <p>
                            {{ $dataApp['alamat'] }}
                        </p>
                        <div class="footer__social">

                            <a href="{{ $dataApp['url_facebook'] }}" target="_blank" class="facebook"><i
                                    class="fa fa-facebook"></i></a>
                            <a href="{{ $dataApp['url_instagram'] }}" target="_blank" class="skype"><i
                                    class="fa fa-instagram"></i></a>
                            <a href="{{ $dataApp['url_youtube'] }}" target="_blank" class="google"><i
                                    class="fa fa-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3">
                    <div class="footer__widget">
                        <h5>Tautan</h5>
                        <ul>
                            <li><a href="{{ route('admin') }}"><i class="fa fa-angle-right"></i> Admin</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Karyawan</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Owner</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="footer__widget">
                        <h5>Informasi</h5>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Hatchback</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Sedan</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> SUV</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Crossover</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer__brand">
                        <h5>Lokasi Showroom</h5>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.699165202248!2d110.85359717462626!3d-6.806402066570249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70c563d4241f47%3A0x6d57dee628b7bc7d!2sRizki%20Motor!5e0!3m2!1sid!2sid!4v1700057379421!5m2!1sid!2sid"
                            class="rounded w-100 h-100" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>

                    </div>
                </div>

            </div>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <div class="footer__copyright__text">
                <p>Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved | This template is made with <i class="fa fa-heart"
                        aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                </p>
            </div>
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->



    <!-- Js Plugins -->
    <script src="{{ asset('template/client/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('template/client/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/client/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('template/client/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('template/client/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('template/client/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('template/client/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('template/client/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/client/js/main.js') }}"></script>
    @yield('js')

</body>

</html>
