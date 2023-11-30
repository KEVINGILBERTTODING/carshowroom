<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style type="text/css">
        .container {
            display: flex;
            align-items: center;
        }

        .container img {
            max-width: 8%;
            height: auto;
        }

        .header {
            flex-grow: 1;
            text-align: center;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }


        h1 {
            margin-bottom: 10px;
        }

        h3 {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .table td,
        .table th {
            border: 2px solid #000000;
            padding: 8px;
        }

        hr {
            height: 3px;
            border: none;
            background-color: black;
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: left;
            font-style: italic;
            font-size: 10px;
            padding: 5px;
        }

        .table tfoot tr td[colspan="9"] {
            text-align: right;
            font-weight: bold;
            border: 2px solid #000000;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="{{ $logo }}" alt="Main Logo">
    </div>

    <div class="container">
        <div class="header">

            <h1>@php
                echo Str::upper($dataApp['app_name']);
            @endphp</h1>
            <h3>LAPORAN PEMASUKAN DAN KEUNTUNGAN</h3>
            <p style="font-style: italic; margin-top: 0; margin-bottom: 0;">Email: {{ $dataApp['email'] }} - Telp:
                {{ $dataApp['no_hp'] }}
            </p>
            <p style="font-style: italic; margin-top: 10px; margin-bottom: 10px;">{{ $dataApp['alamat'] }}</p>
            <hr />

        </div>
    </div>
    <p style="font-size: 12px; ">Periode 1 Januari {{ date('Y') }} s/d 31 Desember {{ date('Y') }}</p>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th colspan="3" style="text-align: center; font-weight: bold;">LAPORAN PEMASUKAN</td>
            </tr>
            <tr>

                <th style="width: 10%;">No</th>
                <th>Bulan</th>
                <th style="width: 25%">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalPemasukan = 0;
            @endphp

            @foreach ($dataPemasukan as $dm => $nominalPemasukan)
                @php

                    $totalPemasukan += $nominalPemasukan;
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $dm }}</td>
                    <td style="text-align: right">{{ formatRupiah($nominalPemasukan) }}</td>


                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold;">Total Pemasukan</td>
                <td style="text-align: right;"><b>{{ formatRupiah($totalPemasukan) }}</b></td>
            </tr>

        </tfoot>


    </table>
    <br><br><br>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3" style="text-align: center; font-weight: bold;">LAPORAN KEUNTUNGAN</td>
            </tr>
            <tr>

                <th style="width: 10%;">No</th>
                <th>Bulan</th>
                <th style="width: 25%">Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
                $totalKeuntungan = 0;
            @endphp


            @foreach ($dataKeuntungan as $dm => $nominalKeuntungan)
                @php

                    $totalKeuntungan += $nominalKeuntungan;
                @endphp
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $dm }}</td>
                    <td style="text-align: right">{{ formatRupiah($nominalKeuntungan) }}</td>


                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: center; font-weight: bold;">Total Keuntungan</td>
                <td style="text-align: right;"><b>{{ formatRupiah($totalKeuntungan) }}</b></td>
            </tr>

        </tfoot>


    </table>
    <br><br><br><br>

    <table>
        <table width="0">

            <tr>
                <td width="0"><br><br></td>
                <td>
                    <br>
                    Kudus, {{ now()->format('d F Y') }}
                    <br><br><br><br>

                    <div style="border-top: 1px solid #000; width: 200px; margin-top: 20px;"></div>
                    <span style="font-size: 12px; font-weight: bold;">
                        {{ $dataAdmin['name'] }}<br>

                    </span>

                </td>

            </tr>

            <tr>

            </tr>

            <div class="footer">
                Dicetak pada tanggal {{ now()->format('Y-m-d H:i:s') }}
            </div>

        </table>


</body>

</html>
