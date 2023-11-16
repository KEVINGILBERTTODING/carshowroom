<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class MobilModel extends Model
{
    use HasFactory;
    protected $table = 'mobil';

    function getDetailMobil($mobilId)
    {
        $data = MobilModel::select(
            'mobil.*',
            'merk.merk',
            'body.body',
            'warna.warna',
            'kapasitas_mesin.kapasitas as kapasitas_mesin',
            'bahan_bakar.bahan_bakar',
            'transmisi.transmisi',
            'kapasitas_penumpang.kapasitas as kapasitas_penumpang',
            'tangki.tangki'

        )->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('body', 'mobil.body_id', '=', 'body.body_id')
            ->leftJoin('warna', 'mobil.warna_id', '=', 'warna.warna_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->leftJoin('bahan_bakar', 'mobil.bahan_bakar_id', '=', 'bahan_bakar.bahan_bakar_id')
            ->leftJoin('transmisi', 'mobil.transmisi_id', '=', 'transmisi.transmisi_id')
            ->leftJoin('kapasitas_penumpang', 'mobil.kp_id', '=', 'kapasitas_penumpang.kp_id')
            ->leftJoin('tangki', 'mobil.tangki_id', '=', 'tangki.tangki_id')
            ->where('mobil.mobil_id', $mobilId)
            ->first();

        return $data;
    }


    function clientGetCar()
    {
        $query = MobilModel::select(
            'mobil.nama_model',
            'mobil.no_plat',
            'mobil.tahun',
            'mobil.km',
            'mobil.harga_jual',
            'mobil.diskon',
            'mobil.status_mobil',
            'mobil.gambar1',
            'mobil.gambar2',
            'mobil.gambar3',
            'mobil.gambar4',
            'mobil.gambar5',
            'mobil.gambar6',
            'merk.merk',
            'transmisi.transmisi',
            'kapasitas_mesin.kapasitas as kapasitas_mesin'
        )->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('transmisi', 'mobil.transmisi_id', '=', 'transmisi.transmisi_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id');


        $query->orderBy('mobil_id', 'desc');

        return $query;
    }
}
