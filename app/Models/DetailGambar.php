<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailGambar extends Model
{
    protected $table = "detail_gambar";

    use HasFactory;
    protected $fillable = [
        'mobil_id',
        'gambar1',
        'gambar2',
        'gambar3',
        'gambar4',
        'gambar5',
        'gambar6',
        'created_at',
        'updated_at',
    ];
}
