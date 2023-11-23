@extends('layouts.client.t_client_main')

@section('title')
    <title>{{ $dataApp['app_name'] . '- Pengajuan Kredit' }}</title>
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
                            <a href="{{ route('/') }}"><i class="fa fa-home"></i> Beranda</a>
                            <a href="{{ route('mobil') }}">Mobil</a>
                            <span>Pengajuan Kredit</span>
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


                <div class="col-lg-9 ">
                    <h2 style="font-size: 50px;" class="text"><b>Pengajuan Kredit.</b></h2>
                    <form action="{{ route('insertTransaction') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row  mt-4">
                            <div class="col-md-6 mb-3">
                                <div class="from-group">
                                    <label>Nama Lengkap</label>
                                    <input type="text" hidden class="form-control" name="mobil_id"
                                        value="{{ $dataMobil['mobil_id'] }}" required>
                                    <input type="text" class="form-control" hidden name="total_pembayaran"
                                        value="{{ $dataMobil['harga_jual'] - $dataMobil['diskon'] }}" required>
                                    <input type="text" class="form-control" name="nama_lengkap"
                                        value="{{ $dataUser['nama_lengkap'] }}" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="from-group">
                                    <label>No Handphone</label>
                                    <input type="text" class="form-control" name="no_hp"
                                        value="{{ $dataUser['no_hp'] }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="from-group">
                                    <label>Alamat</label>
                                    <textarea type="text" rows="3" class="form-control" name="alamat" value="{{ $dataUser['alamat'] }}"
                                        placeholder="Alamat lengkap anda" required></textarea>
                                </div>

                            </div>

                            <div class="col-md-6 mb-3">
                                <div class="from-group">
                                    <label>Bukti Pembayaran</label>
                                    <span style="font-size: 12px;" class="text text-sm text-danger">(Format jpg, png, dan
                                        jpeg
                                        |
                                        5MB.)</span>
                                    <input type="file" name="evidence" accept=".png,.jpg,.jpeg" class="form-control"
                                        name="evidence" required>

                                </div>



                            </div>

                            <div class="col-md-6 mb-4 mt-3">
                                <button type="submit" class="btn btn-warning btn-block"><b>Bayar Sekarang!</b></button>
                            </div>


                        </div>
                    </form>
                </div>



                {{-- Card sidebar --}}
                <div class="col-lg-3 card-price mt-4">
                    <div class="card shadow-sm mb-5 bg-white rounded" style="border-radius: 20px;">
                        <div class="div bg-warning  p-3 d-flex flex-column align-items-center">
                            <h4>{{ $dataApp['app_name'] }}</h4>
                        </div>


                        <div class="card-body" style="width: 100%;">

                            <span class="text text-sm mb-2">Merk & Tipe Mobil</span>

                            <h5 class="text ">{{ $dataMobil['merk'] . ' - ' . $dataMobil['nama_model'] }}</h5>

                            <hr>
                            <span class="text text-sm mb-2">Tahun</span>

                            <h5 class="text ">{{ $dataMobil['tahun'] }}</h5>
                            <hr>


                            <a href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dataApp['no_hp']) }}&text=Halo,%20saya%20ingin%20bertanya%20tentang%20mobil%20{{ $dataMobil['merk'] }}%20{{ $dataMobil['nama_model'] }}%20{{ $dataMobil['tahun'] }}"
                                target="_blank" rel="noopener noreferrer" class="btn btn-success sidebar-btn w-100 mt-3">
                                <i class="fa fa-whatsapp" aria-hidden="true"></i></i>
                                <b>Hubungi Kami</b>
                            </a>

                            <div class="div mt-3 d-flex justify-content-center"> <a href="{{ route('userGuide') }}"
                                    style="font-size: 12px;" class="text-sm text-primary">
                                    Baca panduan pengguna.</a></div>

                        </div>

                    </div>

                </div>
            </div>
        </div>





    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#bankChooser').change(function(e) {
                e.preventDefault();
                var bankId = $('#bankChooser').val();

                $.ajax({
                    type: "get",
                    url: "/getBankAccountById/" + bankId,

                    dataType: "json",
                    success: function(data) {


                        if (data.status == 'success') {
                            $('#no_rek').val(data.data.no_rekening);
                            $('#nama_lengkap').val(data.data.nama);

                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Gagal menmuat data.",
                            });
                        }

                    }
                });

            });

        });
    </script>
@endsection
