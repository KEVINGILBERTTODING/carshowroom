<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\EmployeeModel;
use App\Models\FInanceModel;
use App\Models\MobilModel;
use App\Models\NotificationAdminModel;
use App\Models\OwnerModel;
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

        try {
            $yearNow = Carbon::now()->format('Y');

            Carbon::setLocale('id'); // Mengatur bahasa Indonesia
            $monthNow = Carbon::now()->locale('id')->isoFormat('MMMM');
            $transaksiModel = new TransactionModel();



            $dataPemasukanPerTahun = $transaksiModel->totalPemasukanYear($yearNow);
            $dataKeuntunganPerTahun = $transaksiModel->totalKeuntunganYear($yearNow);
            $jumlaTransaksiSelesai = $transaksiModel->totalTransaksiYear($yearNow, 1);
            $jumlaTransaksiProses = $transaksiModel->totalTransaksiYear($yearNow, 2);
            $jumlaTransaksiProsesFinance = $transaksiModel->totalTransaksiYear($yearNow, 3);
            $jumlaTransaksiTidakValid = $transaksiModel->totalTransaksiYear($yearNow, 0);


            return response(
                [
                    'message' => 'success',
                    'data' => [

                        'data_pemasukan' => $dataPemasukanPerTahun,
                        'data_keuntungan' => $dataKeuntunganPerTahun,
                        'data_trans_selesai' => $jumlaTransaksiSelesai,
                        'data_trans_proses' => $jumlaTransaksiProses,
                        'data_trans_proses_finance' => $jumlaTransaksiProsesFinance,
                        'data_trans_tidak_valid' => $jumlaTransaksiTidakValid,
                        'year_now'  => $yearNow,
                        'month_now' => $monthNow
                    ]
                ],
                200
            );
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function filterProfitIncome($monthYear)
    {

        try {

            $transaksiModel = new TransactionModel();



            $dataPemasukanPerTahun = $transaksiModel->totalPemasukanMonth($monthYear);
            $dataKeuntunganPerTahun = $transaksiModel->totalProfitMonth($monthYear);



            return response(
                [
                    'message' => 'success',
                    'data' => [

                        'data_pemasukan' => $dataPemasukanPerTahun,
                        'data_keuntungan' => $dataKeuntunganPerTahun,
                    ]
                ],
                200
            );
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function profil()
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

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
            if (session('role') == 'admin') {
                $fileName = 'Admin_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileImage->getClientOriginalExtension();
            } elseif (session('role') == 'employee') {
                $fileName = 'Employee_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileImage->getClientOriginalExtension();
            } else {
                $fileName = 'Owner_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileImage->getClientOriginalExtension();
            }

            $fileImage->move('data/profile_photo', $fileName);
            $data = [
                'photo_profile' => $fileName,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if (session('role') == 'admin') {
                $update = Admin::where('admin_id', session('admin_id'))->update($data);
            } elseif (session('role') == 'employee') {
                $update = EmployeeModel::where('karyawan_id', session('karyawan_id'))->update($data);
            } else {
                $update = OwnerModel::where('owner_id', session('owner_id'))->update($data);
            }

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
        if (session('role') == 'admin') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email',

            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'name.string' => 'Nama hanya boleh mengandung huruf dan angka',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|email|unique:karyawan,email,' . session('karyawan_id') . ',karyawan_id',

            ], [
                'name.required' => 'Nama tidak boleh kosong',
                'name.string' => 'Nama hanya boleh mengandung huruf dan angka',
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email telah digunakan'
            ]);
        }


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

                if (session('role') == 'admin') {
                    $validatePassword = Admin::where('admin_id', session('admin_id'))->first();
                } elseif (session('role') == 'employee') {
                    $validatePassword = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
                } else {
                    $validatePassword = OwnerModel::where('owner_id', session('owner_id'))->first();
                }


                if ($validatePassword) {
                    if (Hash::check($request->input('old_password'), $validatePassword['password'])) {
                        try {
                            $data = [
                                'name' => $request->input('name'),
                                'email' => $request->input('email'),
                                'password' => Hash::make($request->input('new_password')),
                                'updated_at' => date('Y-m-d H:i:s')
                            ];

                            if (session('role') == 'admin') {
                                $update =  Admin::where('admin_id', session('admin_id'))->update($data);
                            } elseif (session('role') == 'employee') {
                                $update =  EmployeeModel::where('karyawan_id', session('karyawan_id'))->update($data);
                            } else {
                                $update =  OwnerModel::where('owner_id', session('owner_id'))->update($data);
                            }

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
                    if (session('role') == 'admin') {
                        $update =  Admin::where('admin_id', session('admin_id'))->update($data);
                    } elseif (session('role') == 'employee') {
                        $update =  EmployeeModel::where('karyawan_id', session('karyawan_id'))->update($data);
                    } else {
                        $update =  OwnerModel::where('owner_id', session('owner_id'))->update($data);
                    }

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
