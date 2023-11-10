<?php

namespace App\Models;

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
                'pelanggan.nama_lengkap as nama_pelanggan',
                'pelanggan.no_hp as no_hp_pelanggan',
                'finance.nama_finance',
                'mobil.nama_model',
                'mobil.no_plat',
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
            'kapasitas_mesin.kapasitas as kapasitas_mesin'

        )
            ->leftJoin('mobil', 'transaksi.mobil_id', '=', 'mobil.mobil_id')
            ->leftJoin('users', 'transaksi.user_id', '=', 'users.user_id')
            ->leftJoin('pelanggan', 'transaksi.pelanggan_id', '=', 'pelanggan.pelanggan_id')
            ->leftJoin('pengajuan_kredit as pk', 'transaksi.transaksi_id', '=', 'pk.transaksi_id')
            ->leftJoin('finance', 'pk.finance_id', '=', 'finance.finance_id')
            ->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->where('transaksi.transaksi_id', $transactionId)
            ->orderBy('transaksi.created_at', 'desc')
            ->first();

        return $data;
    }
}
