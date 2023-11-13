<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\FInanceModel;
use App\Models\MobilModel;
use App\Models\PelangganModel;
use App\Models\TransactionModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $yearNow = Carbon::now()->format('Y');
        $transaksiModel = new TransactionModel();
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $totalUser = User::count();
        $totalFinance = FInanceModel::count();
        $dataPemasukanPerTahun = $transaksiModel->totalPemasukanYear($yearNow);
        $dataKeuntunganPerTahun = $transaksiModel->totalKeuntunganYear($yearNow);
        $jumlaTransaksiSelesai = $transaksiModel->totalTransaksiYear($yearNow, 1);
        $jumlaTransaksiProses = $transaksiModel->totalTransaksiYear($yearNow, 2);
        $jumlaTransaksiProsesFinance = $transaksiModel->totalTransaksiYear($yearNow, 3);
        $jumlaTransaksiTidakValid = $transaksiModel->totalTransaksiYear($yearNow, 0);
        $totalPelanggan = PelangganModel::count();
        $totalMobilTersedia = MobilModel::where('status_mobil', 1)->count();
        $userModel = new User();
        $totalPengguna = $userModel->getTotalUserYear($yearNow);
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'totalUser' => $totalUser,
            'dataPemasukanPerTahun' => $dataPemasukanPerTahun,
            'dataKeuntunganPerTahun' => $dataKeuntunganPerTahun,
            'jumlahTransaksiSelesai' => $jumlaTransaksiSelesai,
            'jumlahTransaksiProses' => $jumlaTransaksiProses,
            'jumlahTransaksiProsesFinance' => $jumlaTransaksiProsesFinance,
            'jumlahTransaksiTidakValid' => $jumlaTransaksiTidakValid,
            'totalPengguna' => $totalPengguna,
            'totalPelanggan' => $totalPelanggan,
            'totalFinance' => $totalFinance,
            'totalMobilTersedia' => $totalMobilTersedia
        ];
        return view('admin.main.index', $data);
    }

    function profil()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp
        ];
        return view('admin.profile.profile', $data);
    }

    function ubahFotoProfil(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2000'
        ], [
            'image.required' => 'Gambar tidak boleh kosong',
            'image.image' => 'Gambar tidak valid',
            'image.mimes' => 'Fotmat gambar tidak valid',
            'image.max' => 'Ukuran Gambar tidak boleh lebih dari 2000 MB',
        ]);
        if ($validator->fails()) {
            return redirect()->route('adminProfile')->with('failed', $validator->errors()->first());
        }

        try {
            if (!$request->hasFile('image')) {
                return redirect()->route('adminProfile')->with('failed', 'Gambar tidak boleh kosong');
            }

            $fileImage = $request->file('image');
            $fileName = 'Admin_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileImage->getClientOriginalExtension();
            $fileImage->move('data/profile_photo', $fileName);
            $data = [
                'photo_profile' => $fileName,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $update = Admin::where('admin_id', session('admin_id'))->update($data);
            if ($update) {
                return redirect()->route('adminProfile')->with('success', 'Berhasil mengubah foto profil');
            } else {
                return redirect()->route('adminProfile')->with('failed', 'Gagal mengubah foto profil');
            }
        } catch (\Throwable $th) {
            return redirect()->route('adminProfile')->with('failed', 'Terjadi kesalahan');
        }
    }

    function ubahProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',

        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'name.string' => 'Nama hanya boleh mengandung huruf dan angka',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect()->route('adminProfile')->with('failed', $validator->errors()->first());
        } else {
            if (!empty($request->input('old_password')) || !empty($request->input('new_password'))) {


                $validatorPassword = Validator::make($request->all(), [
                    'old_password' => 'required|string|min:8',
                    'new_password' => 'required|string|min:8',
                ], [
                    'old_password.required' => 'Password lama tidak boleh kosong',
                    'old_password.string' => 'Password lama hanya boleh mengandung huruf dan angka',
                    'old_password.min' => 'Panjang karakter password lama tidak boleh kurang dari 8 karakter',
                    'new_password.required' => 'Password baru tidak boleh kosong',
                    'new_password.string' => 'Password baru hanya boleh mengandung huruf dan angka',
                    'new_password.min' => 'Panjang karakter password baru tidak boleh kurang dari 8 karakter',
                ]);

                if ($validatorPassword->fails()) {
                    return redirect()->route('adminProfile')->with('failed', $validatorPassword->errors()->first());
                }

                $validatePassword = Admin::where('admin_id', session('admin_id'))->first();

                if ($validatePassword) {
                    if (Hash::check($request->input('old_password'), $validatePassword['password'])) {
                        try {
                            $data = [
                                'name' => $request->input('name'),
                                'email' => $request->input('email'),
                                'password' => Hash::make($request->input('new_password')),
                                'updated_at' => date('Y-m-d H:i:s')
                            ];
                            $update =  Admin::where('admin_id', session('admin_id'))->update($data);
                            if ($update) {
                                return redirect()->route('adminProfile')->with('success', 'Berhasil memperbaharui profil');
                            } else {
                                return redirect()->route('adminProfile')->with('failed', 'Gagal memperbaharui profil');
                            }
                        } catch (\Throwable $th) {
                            return redirect()->route('adminProfile')->with('failed', 'Terjadi kesalahan');
                        }
                    } else {
                        return redirect()->route('adminProfile')->with('failed', 'Password lama tidak sesuai');
                    }
                } else {
                    return redirect()->route('adminProfile')->with('failed', 'Terjadi kesalahan');
                }
            } else {

                try {
                    $data = [
                        'name' => $request->input('name'),
                        'email' => $request->input('email'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    $update =  Admin::where('admin_id', session('admin_id'))->update($data);
                    if ($update) {
                        return redirect()->route('adminProfile')->with('success', 'Berhasil memperbaharui profil');
                    } else {
                        return redirect()->route('adminProfile')->with('failed', 'Gagal memperbaharui profil');
                    }
                } catch (\Throwable $th) {
                    return redirect()->route('adminProfile')->with('failed', 'Terjadi kesalahan');
                }
            }
        }
    }
}
