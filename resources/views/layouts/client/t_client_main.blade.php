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
    <footer class="footer set-bg" data-setbg="img/footer-bg.jpg">
        <div class="container">
            <div class="footer__contact">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__contact__title">
                            <h2>Contact Us Now!</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="footer__contact__option">
                            <div class="option__item"><i class="fa fa-phone"></i> (+12) 345 678 910</div>
                            <div class="option__item email"><i class="fa fa-envelope-o"></i> Colorlib@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="footer__about">
                        <div class="footer__logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <p>Any questions? Let us know in store at 625 Gloria Union, California, United Stated or call us
                            on (+1) 96 123 8888</p>
                        <div class="footer__social">
                            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" class="google"><i class="fa fa-google"></i></a>
                            <a href="#" class="skype"><i class="fa fa-skype"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1 col-md-3">
                    <div class="footer__widget">
                        <h5>Infomation</h5>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Purchase</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Payemnt</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Shipping</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Return</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3">
                    <div class="footer__widget">
                        <h5>Infomation</h5>
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
                        <h5>Top Brand</h5>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Abarth</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Acura</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Alfa Romeo</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Audi</a></li>
                        </ul>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i> BMW</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Chevrolet</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Ferrari</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i> Honda</a></li>
                        </ul>
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
