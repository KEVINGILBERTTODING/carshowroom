<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transaksi';

    function getAllTransactionByStatus($status)
    {
        if ($status == 4) { // semua transactions
            $data = TransactionModel::select(
                'transaksi.*',
                'users.nama_lengkap as nama_user',
                'users.no_hp as no_hp_user',
                'users.alamat as alamat_user',
                'pelanggan.nama_lengkap as nama_pelanggan',
                'pelanggan.no_hp as no_hp_pelanggan',
                'pelanggan.alamat as alamat_pelanggan',
                'finance.nama_finance',
                'finance.telepon as telepon_finance',
                'mobil.nama_model',
                'mobil.no_plat',
                'mobil.mobil_id',
                'mobil.tahun',
                'mobil.gambar1',
                'mobil.harga_jual',
                'mobil.harga_beli',
                'mobil.biaya_perbaikan',
                'mobil.diskon',
                'merk.merk'

            )
                ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
                ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
                ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
                ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
                ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
                ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                ->orderBy('transaksi.created_at', 'desc')
                ->get();

            return $data;
        } else {
            $data = TransactionModel::select(
                'transaksi.*',
                'users.nama_lengkap as nama_user',
                'users.no_hp as no_hp_user',
                'users.alamat as alamat_user',
                'pelanggan.nama_lengkap as nama_pelanggan',
                'pelanggan.no_hp as no_hp_pelanggan',
                'pelanggan.alamat as alamat_pelanggan',
                'finance.nama_finance',
                'finance.telepon as telepon_finance',
                'mobil.nama_model',
                'mobil.no_plat',
                'mobil.mobil_id',
                'mobil.tahun',
                'mobil.gambar1',
                'mobil.harga_jual',
                'mobil.harga_beli',
                'mobil.biaya_perbaikan',
                'mobil.diskon',
                'merk.merk'

            )
                ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
                ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
                ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
                ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
                ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
                ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                ->orderBy('transaksi.created_at', 'desc')
                ->where('transaksi.status', $status)
                ->orderBy('transaksi.created_at', 'desc')
                ->get();

            return $data;
        }
    }

    function adminDetailTransaction($transactionId)
    {
        $data = TransactionModel::select(
            'transaksi.*',
            'users.nama_lengkap as nama_user',
            'users.no_hp as no_hp_user',
            'users.alamat as alamat_user',
            'pelanggan.nama_lengkap as nama_pelanggan',
            'pelanggan.no_hp as no_hp_pelanggan',
            'pelanggan.alamat as alamat_pelanggan',
            'finance.nama_finance',
            'finance.finance_id',
            'finance.telepon as telepon_finance',
            'mobil.nama_model',
            'mobil.no_plat',
            'mobil.mobil_id',
            'mobil.tahun',
            'mobil.gambar1',
            'mobil.harga_jual',
            'mobil.harga_beli',
            'mobil.biaya_perbaikan',
            'mobil.diskon',
            'merk.merk',
            'kapasitas_mesin.kapasitas as kapasitas_mesin',
            'pengajuan_kredit.ktp_suami',
            'pengajuan_kredit.ktp_istri',
            'pengajuan_kredit.kk',



        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->leftJoin('pengajuan_kredit', 'transaksi.transaksi_id', '=', 'pengajuan_kredit.transaksi_id')
            ->where('transaksi.transaksi_id', $transactionId)
            ->orderBy('transaksi.created_at', 'desc')
            ->first();

        return $data;
    }

    function clientDetailTransaction($transactionId)
    {
        $data = TransactionModel::select(
            'transaksi.*',
            'users.nama_lengkap as nama_user',
            'users.no_hp as no_hp_user',
            'users.alamat as alamat_user',
            'pelanggan.nama_lengkap as nama_pelanggan',
            'pelanggan.no_hp as no_hp_pelanggan',
            'pelanggan.alamat as alamat_pelanggan',
            'finance.nama_finance',
            'finance.finance_id',
            'finance.telepon as telepon_finance',
            'mobil.nama_model',
            'mobil.no_plat',
            'mobil.mobil_id',
            'mobil.tahun',
            'mobil.gambar1',
            'mobil.harga_jual',
            'mobil.harga_beli',
            'mobil.biaya_perbaikan',
            'mobil.diskon',
            'merk.merk',
            'kapasitas_mesin.kapasitas as kapasitas_mesin',
            'pengajuan_kredit.ktp_suami',
            'pengajuan_kredit.ktp_istri',
            'pengajuan_kredit.kk',
            'review.review_id'

        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('review', 'mobil.mobil_id', '=', 'review.mobil_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->leftJoin('pengajuan_kredit', 'transaksi.transaksi_id', '=', 'pengajuan_kredit.transaksi_id')
            ->where('transaksi.transaksi_id', $transactionId)
            ->orderBy('transaksi.created_at', 'desc')
            ->first();

        return $data;
    }

    function filterTransaksi($dateFrom, $dateEnd, $status)
    {
        // Konversi tanggal yang diberikan oleh pengguna ke format `Y-m-d H:i:s`
        $dateFrom = Carbon::createFromFormat('Y-m-d', $dateFrom)->startOfDay();
        $dateEnd = Carbon::createFromFormat('Y-m-d', $dateEnd)->endOfDay();
        if ($status == 4) { // semua transactions
            $data = TransactionModel::select(
                'transaksi.*',
                'users.nama_lengkap as nama_user',
                'users.no_hp as no_hp_user',
                'users.alamat as alamat_user',
                'pelanggan.nama_lengkap as nama_pelanggan',
                'pelanggan.no_hp as no_hp_pelanggan',
                'pelanggan.alamat as alamat_pelanggan',
                'finance.nama_finance',
                'finance.telepon as telepon_finance',
                'mobil.nama_model',
                'mobil.no_plat',
                'mobil.mobil_id',
                'mobil.tahun',
                'mobil.gambar1',
                'mobil.harga_jual',
                'mobil.harga_beli',
                'mobil.biaya_perbaikan',
                'mobil.diskon',
                'merk.merk'

            )
                ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
                ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
                ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
                ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
                ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
                ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                ->whereBetween('transaksi.created_at', [$dateFrom, $dateEnd])
                ->orderBy('transaksi.created_at', 'desc')
                ->get();

            return $data;
        } else {
            $data = TransactionModel::select(
                'transaksi.*',
                'users.nama_lengkap as nama_user',
                'users.no_hp as no_hp_user',
                'users.alamat as alamat_user',
                'pelanggan.nama_lengkap as nama_pelanggan',
                'pelanggan.no_hp as no_hp_pelanggan',
                'pelanggan.alamat as alamat_pelanggan',
                'finance.nama_finance',
                'finance.telepon as telepon_finance',
                'mobil.nama_model',
                'mobil.no_plat',
                'mobil.mobil_id',
                'mobil.tahun',
                'mobil.gambar1',
                'mobil.harga_jual',
                'mobil.harga_beli',
                'mobil.biaya_perbaikan',
                'mobil.diskon',
                'merk.merk'

            )
                ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
                ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
                ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
                ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
                ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
                ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                ->where('transaksi.status', $status)
                ->whereBetween('transaksi.created_at', [$dateFrom, $dateEnd])
                ->orderBy('transaksi.created_at', 'desc')
                ->get();

            return $data;
        }
    }

    function getTransactionByUser($userId)
    {

        $data = TransactionModel::select(
            'transaksi.*',
            'users.nama_lengkap as nama_user',
            'users.no_hp as no_hp_user',
            'users.alamat as alamat_user',
            'pelanggan.nama_lengkap as nama_pelanggan',
            'pelanggan.no_hp as no_hp_pelanggan',
            'pelanggan.alamat as alamat_pelanggan',
            'finance.nama_finance',
            'finance.telepon as telepon_finance',
            'mobil.nama_model',
            'mobil.no_plat',
            'mobil.mobil_id',
            'mobil.tahun',
            'mobil.gambar1',
            'mobil.harga_jual',
            'mobil.harga_beli',
            'mobil.biaya_perbaikan',
            'mobil.diskon',
            'merk.merk'

        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->orderBy('transaksi.created_at', 'desc')
            ->where('transaksi.user_id', $userId)
            ->orderBy('transaksi.created_at', 'desc')
            ->get();

        return $data;
    }

    function getTransactionByPelanggan($pelangganId)
    {

        $data = TransactionModel::select(
            'transaksi.*',
            'users.nama_lengkap as nama_user',
            'users.no_hp as no_hp_user',
            'users.alamat as alamat_user',
            'pelanggan.nama_lengkap as nama_pelanggan',
            'pelanggan.no_hp as no_hp_pelanggan',
            'pelanggan.alamat as alamat_pelanggan',
            'finance.nama_finance',
            'finance.telepon as telepon_finance',
            'mobil.nama_model',
            'mobil.no_plat',
            'mobil.mobil_id',
            'mobil.tahun',
            'mobil.gambar1',
            'mobil.harga_jual',
            'mobil.harga_beli',
            'mobil.biaya_perbaikan',
            'mobil.diskon',
            'merk.merk'

        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->orderBy('transaksi.created_at', 'desc')
            ->where('transaksi.pelanggan_id', $pelangganId)
            ->orderBy('transaksi.created_at', 'desc')
            ->get();

        return $data;
    }

    function totalProfitFilter($dateFrom, $dateEnd)
    {
        // Konversi tanggal yang diberikan oleh pengguna ke format `Y-m-d H:i:s`
        $dateFrom = Carbon::createFromFormat('Y-m-d', $dateFrom)->startOfDay();
        $dateEnd = Carbon::createFromFormat('Y-m-d', $dateEnd)->endOfDay();
        $data = TransactionModel::select(

            'mobil.harga_jual',
            'mobil.biaya_perbaikan',
            'mobil.harga_beli',
            'mobil.diskon'
        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->where('transaksi.status', 1)
            ->whereBetween('transaksi.created_at', [$dateFrom, $dateEnd])
            ->get();

        $totalProfit = 0;
        foreach ($data as $transaction) {
            $sellingPrice = $transaction->harga_jual;
            $purchasePrice = $transaction->harga_beli;
            $repairCost = $transaction->biaya_perbaikan;
            $discount = $transaction->diskon;
            $hargaSetelahDiskon = $sellingPrice - $discount;

            $profit = ($hargaSetelahDiskon - $purchasePrice - $repairCost);

            $totalProfit += $profit;
        }

        return $totalProfit;
    }

    function totalKeuntunganYear($year)
    {
        // Set tanggal awal dan akhir tahun
        $dateFrom = Carbon::createFromFormat('Y-m-d H:i:s', $year . '-01-01 00:00:00');

        $totalProfits = [];

        // Iterasi setiap bulan
        for ($month = 1; $month <= 12; $month++) {
            // Set tanggal awal dan akhir bulan
            $dateFromMonth = $dateFrom->copy()->setMonth($month)->startOfMonth();
            $dateToMonth = $dateFrom->copy()->setMonth($month)->endOfMonth();

            // Query untuk mendapatkan data transaksi per bulan
            $data = TransactionModel::select(
                'mobil.harga_jual',
                'mobil.biaya_perbaikan',
                'mobil.harga_beli',
                'mobil.diskon'
            )
                ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
                ->where('transaksi.status', 1)
                ->whereBetween('transaksi.created_at', [$dateFromMonth, $dateToMonth])
                ->get();

            // Hitung total keuntungan per bulan
            $totalProfit = 0;

            foreach ($data as $transaction) {
                $sellingPrice = $transaction->harga_jual;
                $purchasePrice = $transaction->harga_beli;
                $repairCost = $transaction->biaya_perbaikan;
                $discount = $transaction->diskon;

                // Kurangi diskon dari harga jual
                $sellingPriceAfterDiscount = $sellingPrice - $discount;

                // Hitung keuntungan
                $profit = ($sellingPriceAfterDiscount - $purchasePrice - $repairCost);

                // Tambahkan keuntungan ke total keuntungan
                $totalProfit += $profit;
            }

            // Simpan total keuntungan per bulan dalam array asosiatif
            $monthName = Carbon::createFromDate($year, $month, 1)->format('F');
            $totalProfits[$monthName] = $totalProfit;
        }

        return $totalProfits;
    }

    function totalPemasukanYear($year)
    {
        // Set tanggal awal dan akhir tahun
        $dateFrom = Carbon::createFromFormat('Y-m-d H:i:s', $year . '-01-01 00:00:00');

        $totalPemasukan = [];

        // Iterasi setiap bulan
        for ($month = 1; $month <= 12; $month++) {
            // Set tanggal awal dan akhir bulan
            $dateFromMonth = $dateFrom->copy()->setMonth($month)->startOfMonth();
            $dateToMonth = $dateFrom->copy()->setMonth($month)->endOfMonth();

            // Query untuk mendapatkan data transaksi per bulan
            $data = TransactionModel::select(
                'transaksi.total_pembayaran',
            )
                ->where('transaksi.status', 1)
                ->whereBetween('transaksi.created_at', [$dateFromMonth, $dateToMonth])
                ->get();

            // Hitung total pemasukan per bulan
            $totalProfit = 0;

            foreach ($data as $transaction) {
                $pemasukan = $transaction->total_pembayaran;
                $totalProfit += $pemasukan;
            }

            // Simpan total pemasukan

            $monthName = Carbon::createFromDate($year, $month, 1)->format('F');
            $totalPemasukan[$monthName] = $totalProfit;
        }

        return $totalPemasukan;
    }


    function totalTransaksiYear($year, $status)
    {
        // Set tanggal awal dan akhir tahun
        $dateFrom = Carbon::createFromFormat('Y-m-d H:i:s', $year . '-01-01 00:00:00');

        $jumlahTransaksi = [];

        // Iterasi setiap bulan
        for ($month = 1; $month <= 12; $month++) {
            // Set tanggal awal dan akhir bulan
            $dateFromMonth = $dateFrom->copy()->setMonth($month)->startOfMonth();
            $dateToMonth = $dateFrom->copy()->setMonth($month)->endOfMonth();

            // Query untuk mendapatkan total transaksi
            $data = TransactionModel::select(
                'transaksi.transaksi_id',
            )
                ->where('transaksi.status', $status)
                ->whereBetween('transaksi.created_at', [$dateFromMonth, $dateToMonth])
                ->count();


            // Simpan total transaksi
            $monthName = Carbon::createFromDate($year, $month, 1)->format('F');
            $jumlahTransaksi[$monthName] = $data;
        }

        return $jumlahTransaksi;
    }

    function getTransactionsMonth($year, $month)
    {
        // Set tanggal awal dan akhir tahun
        $data = TransactionModel::select(
            'transaksi.*',
            'users.nama_lengkap as nama_user',
            'users.no_hp as no_hp_user',
            'users.alamat as alamat_user',
            'pelanggan.nama_lengkap as nama_pelanggan',
            'pelanggan.no_hp as no_hp_pelanggan',
            'pelanggan.alamat as alamat_pelanggan',
            'finance.nama_finance',
            'finance.telepon as telepon_finance',
            'mobil.nama_model',
            'mobil.no_plat',
            'mobil.mobil_id',
            'mobil.tahun',
            'mobil.gambar1',
            'mobil.harga_jual',
            'mobil.harga_beli',
            'mobil.biaya_perbaikan',
            'mobil.diskon',
            'merk.merk'

        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->whereRaw("MONTH(transaksi.created_at) = ?", [$month])
            ->whereRaw("YEAR(transaksi.created_at) = ?", [$year])
            ->orderBy('transaksi.created_at', 'desc')
            ->get();

        return $data;
    }

    function countTotalTransactionCustomer($userId, $status)
    {
        $data = TransactionModel::select(
            'transaksi_id'
        )
            ->where('user_id', $userId)
            ->where('status', $status)
            ->count();
        return $data;
    }

    function getClientTransactionStatus($status, $userId)
    {

        $data = TransactionModel::select(
            'transaksi.*',
            'users.nama_lengkap as nama_user',
            'users.no_hp as no_hp_user',
            'users.alamat as alamat_user',
            'finance.nama_finance',
            'finance.finance_id',
            'mobil.nama_model',
            'mobil.mobil_id',
            'mobil.tahun',
            'mobil.gambar1',
            'merk.merk',
            'review.review_text'

        )

            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('review', 'mobil.mobil_id', '=', 'review.mobil_id')
            ->where('transaksi.user_id', $userId)
            ->where('transaksi.status', $status)
            ->orderBy('transaksi.created_at', 'desc')
            ->get();

        return $data;
    }

    function getClientAllTransactions($userId)
    {
        $data = TransactionModel::select(
            'transaksi.*',
            'users.nama_lengkap as nama_user',
            'users.no_hp as no_hp_user',
            'users.alamat as alamat_user',
            'finance.nama_finance',
            'finance.finance_id',
            'mobil.nama_model',
            'mobil.mobil_id',
            'mobil.tahun',
            'mobil.gambar1',
            'merk.merk'

        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->where('transaksi.user_id', $userId)
            ->orderBy('transaksi.created_at', 'desc')
            ->get();

        return $data;
    }
}
