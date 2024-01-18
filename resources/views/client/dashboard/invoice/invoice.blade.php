<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>A simple, clean, and responsive HTML invoice template</title>

    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

        /** RTL **/
        .invoice-box.rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }

        .invoice-box.rtl table {
            text-align: right;
        }

        .invoice-box.rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="{{ $logo }}" style="max-width: 70px" />
                                <h6>Rizki Motor</h6>
                            </td>

                            <td>
                                #{{ $dataTransaksi['transaksi_id'] }}<br />
                                Tanggal: {{ $dataTransaksi['created_at'] }}<br />

                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Nama<br />
                                No. Handphone<br />
                                Alamat
                            </td>

                            <td>
                                @if ($dataTransaksi['nama_user'] != null)
                                    {{ $dataTransaksi['nama_user'] }}
                                @else
                                    {{ $dataTransaksi['nama_pelanggan'] }}
                                @endif
                                <br />
                                @if ($dataTransaksi['no_hp_user'] != null)
                                    {{ $dataTransaksi['no_hp_user'] }}
                                @else
                                    {{ $dataTransaksi['no_hp_pelanggan'] }}
                                @endif
                                <br />
                                @if ($dataTransaksi['alamat_user'] != null)
                                    {{ $dataTransaksi['alamat_user'] }}
                                @else
                                    {{ $dataTransaksi['alamat_user'] }}
                                @endif
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Metode Pembayaran</td>

                <td>Status #</td>
            </tr>

            <tr class="details">
                <td>
                    @if ($dataTransaksi['payment_method'] == 1)
                        Cash / Tunai
                    @elseif ($dataTransaksi['payment_method'] == 2)
                        Kredit / Cicilan
                    @elseif ($dataTransaksi['payment_method'] == 3)
                        Transfer Bank
                    @endif
                </td>

                <td>
                    @if ($dataTransaksi['status'] == 1)
                        <span class="badge bg-success">Lunas</span>
                    @elseif ($dataTransaksi['status'] == 2)
                        <span class="badge bg-warning">Belum Lunas</span>
                    @elseif ($dataTransaksi['status'] == 3)
                        <span class="badge bg-info">Belum Lunas</span>
                    @elseif ($dataTransaksi['status'] == 0)
                        <span class="badge bg-danger">Tidak Valid</span>
                    @endif
                </td>
            </tr>

            <tr class="heading">
                <td>Detail Mobil</td>

                <td>Keterangan</td>
            </tr>

            <tr class="item">
                <td>Merk & Tipe Mobil</td>
                <td>{{ $dataTransaksi['merk'] . ' - ' . $dataTransaksi['nama_model'] }}</td>
            </tr>
            <tr class="item">
                <td>Plat</td>
                <td>{{ $dataTransaksi['no_plat'] }}</td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>{{ $dataTransaksi['tahun'] }}</td>
            </tr>




            <tr class="heading">
                <td>Detail Transaksi</td>

                <td>Nominal</td>
            </tr>

            <tr class="item">
                <td>Harga Mobil</td>

                <td>{{ formatRupiah($dataTransaksi['harga_jual']) }}</td>
            </tr>

            <tr class="item">
                <td>Diskon</td>

                <td>{{ formatRupiah($dataTransaksi['diskon']) }}</td>
            </tr>

            <tr class="item">
                <td>Biaya Pengiriman</td>

                <td>
                    @if ($dataTransaksi['biaya_pengiriman'] === null)
                        Belum di tetapkan
                    @else
                        {{ formatRupiah($dataTransaksi['biaya_pengiriman']) }}
                    @endif
                </td>
            </tr>


            <tr class="total">
                <td></td>

                <td>
                    {{ formatRupiah($dataTransaksi['harga_jual'] - $dataTransaksi['diskon'] + $dataTransaksi['biaya_pengiriman']) }}
                </td>
            </tr>
        </table>
        <div style="text-align: right;">
            <img src="{{ $imgStempel }}" alt="Stempel Image" style="max-width: 200px;">
        </div>
    </div>
</body>

</html>
