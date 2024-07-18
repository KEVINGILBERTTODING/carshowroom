<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMobil extends Model
{
    protected $table = "detail_mobil";
    protected $primaryKey = "id";
    use HasFactory;
    protected $fillable = [
        'mobil_id',
        'url_youtube',
        'url_facebook',
        'url_instagram',
        'harga_beli',
        'biaya_perbaikan',
        'harga_jual',
        'diskon',
        'status_mobil',
        'status_post',
        'deskripsi',
        'tgl_masuk',
        'created_at',
        'updated_at',
    ];
}
