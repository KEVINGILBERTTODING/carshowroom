<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    function getTotalUserYear($year)
    {
        // Set tanggal awal dan akhir tahun
        $dateFrom = Carbon::createFromFormat('Y-m-d H:i:s', $year . '-01-01 00:00:00');

        $jumlahPengguna = [];

        // Iterasi setiap bulan
        for ($month = 1; $month <= 12; $month++) {
            // Set tanggal awal dan akhir bulan
            $dateFromMonth = $dateFrom->copy()->setMonth($month)->startOfMonth();
            $dateToMonth = $dateFrom->copy()->setMonth($month)->endOfMonth();

            // Query untuk mendapatkan total transaksi
            $data =  User::whereBetween('users.created_at', [$dateFromMonth, $dateToMonth])
                ->count();

            // Simpan total transaksi
            $monthName = Carbon::createFromDate($year, $month, 1)->format('F');
            $jumlahPengguna[$monthName] = $data;
        }

        return $jumlahPengguna;
    }
}
