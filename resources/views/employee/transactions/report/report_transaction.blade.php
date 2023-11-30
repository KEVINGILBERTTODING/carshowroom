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
            <h3>LAPORAN TRANSAKSI PENJUALAN MOBIL</h3>
            <p style="font-style: italic; margin-top: 0; margin-bottom: 0;">Email: {{ $dataApp['email'] }} - Telp:
                {{ $dataApp['no_hp'] }}
            </p>
            <p style="font-style: italic; margin-top: 10px; margin-bottom: 10px;">{{ $dataApp['alamat'] }}</p>
            <hr />

        </div>
    </div>
    <p style="font-size: 12px; ">Periode {{ $dateFrom }} s/d {{ $dateEnd }}</p>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Transaksi</th>
                <th>Mobil</th>
                <th>Nama Lengkap</th>
                <th>No. Hp</th>
                <th>Metode Pembayaran</th>
                <th>Finance</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp

            @foreach ($dataTransactions as $dm)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $dm->created_at }}</td>
                    <td>{{ $dm->transaksi_id }}</td>
                    <td>
                        @if ($dm->nama_model != null)
                            {{ $dm->merk . '-' . $dm->nama_model }}
                        @else
                            Mobil telah dihapus
                        @endif
                    </td>
                    <td>
                        @if ($dm->nama_user != null)
                            {{ $dm->nama_user }}
                        @else
                            {{ $dm->nama_pelanggan }}
                        @endif
                    </td>
                    <td>
                        @if ($dm->no_hp_user != null)
                            {{ $dm->no_hp_user }}
                        @else
                            {{ $dm->no_hp_pelanggan }}
                        @endif
                    </td>

                    <td>
                        @if ($dm->payment_method == 1)
                            {{-- cash --}}
                            Cash / Tunai
                        @elseif ($dm->payment_method == 2)
                            {{-- credit --}}
                            Kredit / Cicil
                        @elseif ($dm->payment_method == 3)
                            Transfer
                        @endif
                    </td>
                    <td>
                        @if ($dm->nama_finance != null)
                            {{ $dm->nama_finance }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        @if ($dm->status == 1)
                            <span class="badge bg-success">Selesai</span>
                        @elseif ($dm->status == 0)
                            <span class="badge bg-danger">Tidak Valid</span>
                        @elseif ($dm->status == 2)
                            <span class="badge bg-warning">Proses</span>
                        @elseif ($dm->status == 3)
                            <span class="badge bg-info">Finance Proses</span>
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
