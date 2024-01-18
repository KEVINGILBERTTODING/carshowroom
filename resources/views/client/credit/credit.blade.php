@extends('layouts.client.t_client_main')

@section('title')
    <title>{{ $dataApp['app_name'] . '- Kredit' }}</title>
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
                                <a href="{{ route('dashboardClient') }}" class="primary-btn text-dark">Dashoard</a>
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
                            <a href="{{ route('mobil') }}">Daftar Mobil</a>
                            <span>Kredit</span>
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
                    <h2 style="font-size: 60px; color: black" class="text"><b>Hitung Cicilan.</b></h2>
                    <br>
                    <label class="text text-dark mt-3" style="font-size: 20px"><b>Uang Muka (DP)</b></label>
                    <table>
                        <tr>

                            <td style="text-align: center; vertical-align: middle; margin-right: 10px;">
                                <h4 style="margin-right: 10px;">Rp</h4>
                            </td>
                            <td>
                                <div style="width: 300px;">

                                    <input type="text" readonly id="dp" class="form-control">
                                </div>
                            </td>
                        </tr>
                    </table>

                    <br><br>
                    <div id="priceSliderWrapper" class="w-100" style="position: relative;">
                        <h6 style="position: absolute; left: 0; top: 0; font-size: 15px; margin-top: -20px;">
                            {{ formatRupiah($totalMinDp) }}
                        </h6>
                        <h6 style="position: absolute; right: 0; top: 0; font-size: 15px; margin-top: -20px;">
                            {{ formatRupiah($totalMaxDp) }}</h6>
                        <div id="priceSlider" class="w-100"></div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label class="text text-dark" style="font-size: 20px;"><b>Lama Pinjaman (Bulan)</b></label>
                        <div class="btn-group btn-group-toggle d-block" data-toggle="buttons">
                            <label class="btn btn-secondary"
                                style="border-radius: 50%; width: 40px; height: 40px; padding: 6px; text-align: center; font-size: 16px; color: black; background-color: #fff; margin-right: 5px; border: 2px solid black;">
                                <input type="radio" name="loanTenure" value="13" onclick="getSelectedValue(this)">
                                13
                            </label>
                            <label class="btn btn-secondary"
                                style="border-radius: 50%; width: 40px; height: 40px; padding: 6px; text-align: center; font-size: 16px; color: black; background-color: #fff; margin-right: 5px; border: 2px solid black;">
                                <input type="radio" name="loanTenure" value="24" onclick="getSelectedValue(this)">
                                24
                            </label>
                            <label class="btn btn-secondary"
                                style="border-radius: 50%; width: 40px; height: 40px; padding: 6px; text-align: center; font-size: 16px; color: black; background-color: #fff; margin-right: 5px; border: 2px solid black;">
                                <input type="radio" name="loanTenure" value="36" onclick="getSelectedValue(this)">
                                36
                            </label>
                            <label class="btn btn-secondary"
                                style="border-radius: 50%; width: 40px; height: 40px; padding: 6px; text-align: center; font-size: 16px; color: black; background-color: #fff; margin-right: 5px; border: 2px solid black;">
                                <input type="radio" name="loanTenure" value="48" onclick="getSelectedValue(this)">
                                48
                            </label>
                            <label class="btn btn-secondary"
                                style="border-radius: 50%; width: 40px; height: 40px; padding: 6px; text-align: center; font-size: 16px; color: black; background-color: #fff; margin-right: 5px; border: 2px solid black;">
                                <input type="radio" name="loanTenure" value="60" onclick="getSelectedValue(this)">
                                60
                            </label>
                        </div>
                    </div>

                    <button class="btn btn-warning mt-3" id="btn_hitung"><b>Hitung Total Cicilan</b></button>
                    <hr>
                    <br>
                    <label class="text text-dark mt-2" style="font-size: 20px;"><b>Rincian Biaya Tambahan</b></label>


                    <div class="container">
                        <div class="row mt-3 flex-column flex-md-row">
                            <div class="col-md-5 col-12">
                                <p class="text-sm">+ Biaya Administrasi</p>
                            </div>

                            <div class="col-md-5 col-12 text-md-right">
                                <p class="text-sm" id="biaya_administrasi">2023-02-023</p>
                            </div>

                            <div class="col-md-5 col-12">
                                <p class="text-sm">+ Biaya Provisi</p>
                            </div>

                            <div class="col-md-5 col-12 text-md-right">
                                <p class="text-sm" id="biaya_provisi">2023-02-023</p>
                            </div>

                            <div class="col-md-5 col-12">
                                <p class="text-sm">+ Asuransi Unit</p>
                            </div>

                            <div class="col-md-5 col-12 text-md-right">
                                <p class="text-sm" id="biaya_asuransi">2023-02-023</p>
                            </div>


                        </div>
                        <hr class="text-muted" style="border-top: dotted 3px;" />

                        <div class="row">
                            <div class="col-md-5 col-12 mb-3">
                                <h5 class="text">Total Biaya Tambahan</h5>
                            </div>

                            <div class="col-md-5 col-12 text-md-right">
                                <h5 class="text" id="biaya_tambahan">2023-02-023</h5>
                            </div>

                        </div>

                        <br>
                        <div class="row mt-4">
                            <div class="col-md-5 col-12">
                                <label class="text text-dark" style="font-size: 20px;">
                                    <b>
                                        Total Pembayaran Pertama (TDP)
                                    </b>
                                </label>

                            </div>

                            <div class="col-md-5 col-12 text-md-right">
                                <label class="text text-dark" style="font-size: 20px;">
                                    <b id="total_tdp">

                                    </b>
                                </label>
                            </div>

                        </div>
                        <p class="text-sm">+ Uang Muka</p>
                        <p class="text-sm">+ Total Biaya Tambahan</p>
                        <p class="text-sm">+ Angsuran Pertama</p>

                        <br><br>
                        <label class="text text-dark" style="font-size: 20px;">
                            <b>
                                Perkiraan cicilan
                            </b>
                        </label>
                        <br>

                        <label class="text text-dark" style="font-size: 20px;">
                            <b id="total_cicilan">

                            </b>
                        </label>
                        <br>
                        <div class="p-2 mt-3" style="background-color: #FFF9C1; border-radius: 7px;">
                            <p class="text text-dark">Perhitungan di atas bersifat sementara dan bisa berubah
                                sewaktu-waktu sesuai ketentuan yang berlaku.</p>
                        </div>

                    </div>

                </div>
                {{-- Card sidebar --}}
                <div class="col-lg-3 card-price mt-4">
                    <div class="card shadow-sm mb-5 bg-white rounded" style="border-radius: 20px;">
                        <div class="div bg-warning  p-3 d-flex flex-column align-items-center">
                            <h4>{{ $dataFinance['nama_finance'] }}</h4>






                        </div>


                        <div class="card-body">


                            <div class="car__details__sidebar__payment p-3">

                                <ul>
                                    <h4>{{ formatRupiah($dataMobil['harga_jual'] - $dataMobil['diskon']) }}</h4>
                                    <hr>
                                    <span class="text-sm text text-dark">Perkiraan Cicilan</span>
                                    <h6 style="color: black" class="text mt-2" id="total_cicilan2">
                                    </h6>

                                    </li>
                                    <a href="{{ route('detailDataFinance', Crypt::encrypt($dataFinance['finance_id'])) }}"
                                        style="text-align: center; font-size: 12px;"
                                        class="text-sm text text-primary mt-3">Lihat detail
                                        finance
                                    </a>


                                </ul>

                                <hr>


                                <a href="{{ route('pengajuanKredit', ['mobilId' => Crypt::encrypt($dataMobil['mobil_id']), 'financeId' => Crypt::encrypt($dataFinance['finance_id'])]) }}"
                                    class="btn btn-warning w-100 mt-3">
                                    <i class="fa fa-credit-card"></i>
                                    <b> Ajukan Pembiayaan</b>
                                </a>

                                <a href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dataApp['no_hp']) }}&text=Halo,%20saya%20ingin%20bertanya%20tentang%20mobil%20{{ $dataMobil['merk'] }}%20{{ $dataMobil['nama_model'] }}%20{{ $dataMobil['tahun'] }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="btn btn-success sidebar-btn w-100 mt-3"><i class="fa fa-whatsapp"
                                        aria-hidden="true"></i></i>
                                    <b>Hubungi Kami</b></a>


                            </div>


                        </div>


                    </div>
                </div>
            </div>




    </section>
@endsection

@section('js')
    {{-- Script untuk slider harga --}}
    <script>
        $(function() {
            // Set the initial values and range of the slider
            var initialMinValue = {{ $totalMinDp }};
            var initialMaxValue = {{ $totalMaxDp }};
            var stepValue = 500; // Set the step value

            // Initialize the price slider
            $("#priceSlider").slider({
                range: "min", // Set range to "min" to have a single handle
                min: {{ $totalMinDp }},
                max: {{ $totalMaxDp }},
                value: initialMinValue, // Set the initial value
                step: stepValue, // Set the step value
                slide: function(event, ui) {
                    // Format the value as a decimal with a specific locale
                    $("#dp").val(ui.value.toLocaleString('id-ID'));
                }
            });

            // Set the initial value of the input field
            $("#dp").val(initialMinValue.toLocaleString('id-ID'));
        });
    </script>

    <script>
        function getSelectedValue(radio) {

            $(".btn-secondary").css("background-color",
                "#fff"); // Mengembalikan warna latar belakang semua elemen radio
            $(radio).closest(".btn-secondary").css("background-color", "orange");
            return radio.value;
        }
        $(document).ready(function() {



            // sett default nilai
            $('#biaya_administrasi').text(formatDecimal(0));
            $('#biaya_provisi').text(formatDecimal(0));
            $('#biaya_asuransi').text(formatDecimal(0));
            $('#biaya_tambahan').text(formatDecimal(0));
            $('#total_tdp').text(formatDecimal(0));
            $('#total_cicilan').text(formatDecimal(0) + ' / bulan');
            $('#total_cicilan2').text(formatDecimal(0) + ' / bulan');

            $('#btn_hitung').click(function(e) {
                e.preventDefault();


                // Dapatkan nilai radio yang dipilih
                var selectedValue = $('input[name="loanTenure"]:checked').val();
                var valueDp = $('#dp').val();
                var valueDpFormatted = parseInt(valueDp.replace(/\./g, ''), 10);
                var totalPembayaran = {{ $dataMobil['harga_jual'] - $dataMobil['diskon'] }};
                var financeId = {{ $dataFinance['finance_id'] }}

                // Cek apakah nilai ada
                if (selectedValue == undefined) {

                    Swal.fire({
                        icon: "error",
                        title: "Gagal",
                        text: "Anda belum memilih durasi pinjaman.",
                    });

                } else {

                    $.ajax({
                        type: "POST",
                        url: "/countCredit",
                        data: {
                            finance_id: financeId,
                            total_pembayaran: totalPembayaran,
                            total_dp: valueDpFormatted,
                            durasi: selectedValue,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        dataType: "json",
                        success: function(data) {
                            var biayaTambahan = data.biaya_admin + data
                                .biaya_asuransi + data.biaya_provisi;
                            var totalTdp = biayaTambahan + valueDpFormatted;

                            $('#biaya_administrasi').text("Rp. " + formatDecimal(data
                                .biaya_admin));
                            $('#biaya_provisi').text("Rp. " + formatDecimal(data
                                .biaya_asuransi));
                            $('#biaya_asuransi').text("Rp. " + formatDecimal(data
                                .biaya_provisi));
                            $('#biaya_tambahan').text("Rp. " + formatDecimal(biayaTambahan));
                            $('#total_tdp').text("Rp. " + formatDecimal(totalTdp));
                            $('#total_cicilan').text("Rp. " + formatDecimal(data.totalCicilan) +
                                ' / bulan');
                            $('#total_cicilan2').text( "Rp. " +  formatDecimal(data.totalCicilan) +
                                ' / bulan');


                        },
                        error: function(error) {
                            Swal.fire({
                                icon: "error",
                                title: "Gagal",
                                text: "Terjadi kesalahan.",
                            });
                        }
                    });




                }






            });


        });

        function formatDecimal(number, decimalPlaces = 2, decimalSeparator = ',', thousandsSeparator = '.') {
            var formattedNumber = parseFloat(number).toFixed(decimalPlaces);
            formattedNumber = formattedNumber.replace('.', decimalSeparator);

            // Tambahkan pemisah ribuan
            if (thousandsSeparator !== '') {
                var parts = formattedNumber.split(decimalSeparator);
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousandsSeparator);
                formattedNumber = parts.join(decimalSeparator);
            }

            return formattedNumber;
        }
    </script>
@endsection
