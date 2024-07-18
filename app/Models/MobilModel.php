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
    protected $primaryKey = 'mobil_id';
    protected $fillable = [
        'merk_id',
        'body_id',
        'nama_model',
        'no_plat',
        'no_mesin',
        'no_rangka',
        'tahun',
        'warna_id',
        'km_id',
        'bahan_bakar_id',
        'transmisi_id',
        'kp_id',
        'km',
        'tangki_id',
        'harga_beli',
        'biaya_perbaikan',
        'harga_jual',
        'tgl_masuk',
        'diskon',
        'nama_pemilik',
        'status_mobil',
        'status_post',
        'url_youtube',
        'url_instagram',
        'url_facebook',
        'deskripsi',
        'created_at',
        'updated_at'
    ];


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
            'tangki.tangki',
            'detail_gambar.*',


        )->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('body', 'mobil.body_id', '=', 'body.body_id')
            ->leftJoin('warna', 'mobil.warna_id', '=', 'warna.warna_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->leftJoin('detail_gambar', 'mobil.mobil_id', '=', 'detail_gambar.mobil_id')
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
            'mobil.mobil_id',
            'mobil.no_plat',
            'mobil.tahun',
            'mobil.km',
            'mobil.harga_jual',
            'mobil.diskon',
            'mobil.status_mobil',
            'detail_gambar.*',
            'merk.merk',
            'transmisi.transmisi',
            'kapasitas_mesin.kapasitas as kapasitas_mesin'
        )->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('detail_gambar', 'mobil.mobil_id', '=', 'detail_gambar.mobil_id')
            ->leftJoin('transmisi', 'mobil.transmisi_id', '=', 'transmisi.transmisi_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id');


        $query->orderBy('mobil.mobil_id', 'desc');

        return $query;
    }

    function getDetailMobilClient($mobilId)
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
            'tangki.tangki',
            'review.review_text',
            'review.star',
            'users.profile_photo as photo_customer',
            'review.created_at as tgl_review',
            'review.image1 as image_review1',
            'review.image2 as image_review2',
            'review.image3 as image_review3',
            'review.image4 as image_review4',
            'users.nama_lengkap',
            'detail_gambar.*'

        )->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('body', 'mobil.body_id', '=', 'body.body_id')
            ->leftJoin('warna', 'mobil.warna_id', '=', 'warna.warna_id')
            ->leftJoin('detail_gambar', 'mobil.mobil_id', '=', 'detail_gambar.mobil_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->leftJoin('bahan_bakar', 'mobil.bahan_bakar_id', '=', 'bahan_bakar.bahan_bakar_id')
            ->leftJoin('transmisi', 'mobil.transmisi_id', '=', 'transmisi.transmisi_id')
            ->leftJoin('kapasitas_penumpang', 'mobil.kp_id', '=', 'kapasitas_penumpang.kp_id')
            ->leftJoin('tangki', 'mobil.tangki_id', '=', 'tangki.tangki_id')
            ->leftJoin('review', 'mobil.mobil_id', '=', 'review.mobil_id')
            ->leftJoin('users', 'review.user_id', '=', 'users.user_id')
            ->where('mobil.mobil_id', $mobilId)
            ->first();

        return $data;
    }

    function searchCar($keyword)
    {
        $query = MobilModel::select(
            'mobil.nama_model',
            'mobil.mobil_id',
            'mobil.no_plat',
            'mobil.tahun',
            'mobil.km',
            'mobil.harga_jual',
            'mobil.diskon',
            'mobil.status_mobil',

            'merk.merk',
            'transmisi.transmisi',
            'detail_gambar.*',
            'kapasitas_mesin.kapasitas as kapasitas_mesin'
        )->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('transmisi', 'mobil.transmisi_id', '=', 'transmisi.transmisi_id')
            ->leftJoin('detail_gambar', 'mobil.mobil_id', '=', 'detail_gambar.mobil_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->where('mobil.nama_model', 'like', '%' . $keyword . '%')
            ->orWhere('merk.merk', 'like', '%' . $keyword . '%')
            ->orderBy('mobil.mobil_id', 'desc');

        return $query;
    }



    function filterCar($merk, $jenis, $transmisi, $hargaMulai, $hargaAkhir) //tambah $bahanBakarId
    {
        $query = MobilModel::select(
            'mobil.nama_model',
            'mobil.mobil_id',
            'mobil.no_plat',
            'mobil.tahun',
            'mobil.km',
            //'mobil.bahan_bakar_id',
            'mobil.harga_jual',
            'mobil.diskon',
            'detail_gambar.*',
            'mobil.status_mobil',

            'merk.merk',
            'transmisi.transmisi',
            'kapasitas_mesin.kapasitas as kapasitas_mesin'
        )->leftJoin('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->leftJoin('transmisi', 'mobil.transmisi_id', '=', 'transmisi.transmisi_id')
            ->leftJoin('detail_gambar', 'mobil.mobil_id', '=', 'detail_gambar.mobil_id')
            ->leftJoin('kapasitas_mesin', 'mobil.km_id', '=', 'kapasitas_mesin.km_id')
            ->where(function ($query) use ($merk, $jenis, $transmisi, $hargaMulai, $hargaAkhir) { //tambah $bahanBakarId
                if ($merk != 0) {
                    $query->where('merk.merk_id', $merk);
                }

                if ($jenis != 0) {
                    $query->where('mobil.body_id', $jenis);
                }

                if ($transmisi != 0) {
                    $query->where('mobil.transmisi_id', $transmisi);
                }

                // if ($bahanBakarId != 0) {
                //     $query->where('mobil.bahan_bakar_id', $bahanBakarId);
                // }

                if ($hargaAkhir > 0) {
                    $query->whereBetween('mobil.harga_jual', [$hargaMulai, $hargaAkhir]);
                } else {
                    $query->where('mobil.harga_jual', '>=', $hargaMulai);
                }
            })
            ->orderBy('mobil.mobil_id', 'desc');

        return $query;
    }
}
