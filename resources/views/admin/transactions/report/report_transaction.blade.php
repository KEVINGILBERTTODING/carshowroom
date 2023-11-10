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
            max-width: 10%;
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
    </style>
</head>

<body>
    <div class="container">
        <img src="" alt="Main Logo">
    </div>

    <div class="container">
        <div class="header">

            <h1>RIZQI MOTOR</h1>
            <h3>LAPORAN TRANSAKSI PENJUALAN MOBIL</h3>
            <p style="font-style: italic; margin-top: 0;">Email: rizqi@gmail.com - Telp: 08232323</p>
            <p style="font-style: italic; margin-top: 0;">Jl. WR. Supratman</p>
            <hr />

        </div>
    </div>
    <p>Periode 2023-02-02 s/d 2023-02-02</p>
    <br>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Kode Transaksi</th>
                <th>Mobil</th>
                <th>No. Hp</th>
                <th>Alamat</th>
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
                            <a
                                href="{{ route('adminDetailMobil', $dm->mobil_id) }}">{{ $dm->merk . '-' . $dm->nama_model }}</a>
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
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dm->no_hp_user) }}&text=Halo,%20*{{ $dm->nama_user }}*,%20kami%20dari%20{{ $dataApp['app_name'] }}">
                                {{ $dm->no_hp_user }}
                            </a>
                        @else
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dm->no_hp_pelanggan) }}&text=Halo,%20*{{ $dm->nama_pelanggan }}*,%20kami%20dari%20{{ $dataApp['app_name'] }}">
                                {{ $dm->no_hp_pelanggan }}
                            </a>
                        @endif
                    </td>
                    <td>
                        @if ($dm->alamat_user != null)
                            {{ $dm->alamat_user }}
                        @else
                            {{ $dm->alamat_pelanggan }}
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
                            <a target="_blank"
                                href="https://api.whatsapp.com/send?phone={{ str_replace('08', '628', $dm->telepon_finance) }}&text=Halo...">
                                {{ $dm->nama_finance }}
                            </a>
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

                    Daskrimti,<br>
                    Kejaksaan Tinggi Jawa Tengah
                    <br>

                    <br><br><br><br><br>
                    {{-- {{ $nama_daskrimti }} --}}

                </td>

            </tr>

            <tr>

            </tr>

        </table>
</body>

</html>
