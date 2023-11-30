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
            <h3>LAPORAN DATA MOBIL</h3>
            <p style="font-style: italic; margin-top: 0; margin-bottom: 0;">Email: {{ $dataApp['email'] }} - Telp:
                {{ $dataApp['no_hp'] }}
            </p>
            <p style="font-style: italic; margin-top: 10px; margin-bottom: 10px;">{{ $dataApp['alamat'] }}</p>
            <hr />

        </div>
    </div>

    <br><br><br>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>No Plat</th>
                <th>Merk & Model Mobil</th>
                <th>No Mesin</th>
                <th>No Rangka</th>
                <th>Tahun</th>
                <th>Harga Beli</th>
                <th>Biaya Perbaikan</th>
                <th>Harga Jual</th>
                <th>Diskon</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach ($dataMobil as $dm)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $dm->no_plat }}</td>
                    <td>{{ $dm->merk . ' - ' . $dm->nama_model }}</td>
                    <td>{{ $dm->no_mesin }}</td>
                    <td>{{ $dm->no_rangka }}</td>
                    <td>{{ $dm->tahun }}</td>
                    <td>{{ formatRupiah($dm->harga_beli) }}</td>
                    <td>{{ formatRupiah($dm->biaya_perbaikan) }}</td>
                    <td>{{ formatRupiah($dm->harga_jual) }}</td>
                    <td>{{ formatRupiah($dm->diskon) }}</td>
                    <td>
                        @if ($dm->status_mobil == 1)
                            <span class="badge bg-success">Tersedia</span>
                        @elseif ($dm->status_mobil == 0)
                            <span class="badge bg-danger">Terjual</span>
                        @elseif ($dm->status_mobil == 2)
                            <span class="badge bg-warning">Di Pesan</span>
                        @endif
                    </td>

                </tr>
            @endforeach
        </tbody>


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

        <!-- Skrip JavaScript untuk menambahkan tulisan pada setiap halaman -->
        <script type="text/php">
        if ( isset($pdf) ) {
            $pdf->page_script('
                $font = $fontMetrics->get_font("Arial, Helvetica, sans-serif", "normal", 12);
                $size = 12;
                $pageText = "Dicetak pada tanggal ' . now()->format("Y-m-d H:i:s") . '";
                $y = 15;
                $x = 520;
                $pdf->text($x, $y, $pageText, $font, $size);
            ');
        }
    </script>
</body>

</html>
