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
}
