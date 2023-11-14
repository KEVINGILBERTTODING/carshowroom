<?php

namespace App\Http\Controllers\admin\users;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\KaryawanModel;
use App\Models\OwnerModel;
use App\Models\PelangganModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    function owner()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataPemilik = OwnerModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'dataPemilik' => $dataPemilik
        ];
        return view('admin.users.owner', $data);
    }

    function tambahPemilik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:owner,email',
            'password' => 'required|string|min:8'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'string' => 'Kolom :attribute hanya boleh berupa text',
            'email' => 'Kolom :attribute tidak valid',
            'unique' => 'Email telah terdaftar',
            'min' => 'Kata sandi tidak boleh kurang dari 8 karakter'
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Kata sandi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {

            $dataPemilik = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $insert = OwnerModel::insert($dataPemilik);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan pemilik baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan pemilik baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function hapusPemilik($ownerId)
    {
        try {
            $delete = OwnerModel::where('owner_id', $ownerId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus data');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus data');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function updatePemilik(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'owner_id' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email|unique:owner,email,' . $request->input('owner_id') . ',owner_id',
            'status' => 'required|numeric'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'string' => 'Kolom :attribute hanya boleh berupa text',
            'email' => 'Kolom :attribute tidak valid',
            'unique' => 'Email telah terdaftar',
            'numeric' => 'Terjadi kesalahan',
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'status' => 'Status'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {

            if (empty($request->input('password'))) {
                $dataPemilik = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'is_active' => $request->input('status'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            } else {
                $validatorPassword = Validator::make($request->all(), [
                    'password' => 'required|string|min:8'
                ], [
                    'password.required' => 'Kata sandi tidak boleh kosong',
                    'password.string' => 'Kata sandi hanya boleh mengandung text dan angka',
                    'password.min' => 'Kata sandi tidak boleh kurang dari 8 karakter'
                ]);
                if ($validatorPassword->fails()) {
                    return redirect()->back()->with('failed', $validatorPassword->errors()->first());
                }

                $dataPemilik = [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'is_active' => $request->input('status'),
                    'password' => Hash::make($request->input('password')),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }

            $update = OwnerModel::where('owner_id', $request->input('owner_id'))->update($dataPemilik);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah data pemilik');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah data pemilik');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function pelanggan()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataPelanggan = PelangganModel::orderBy('created_at', 'desc')->get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'dataPelanggan' => $dataPelanggan
        ];
        return view('admin.users.pelanggan', $data);
    }

    function updatePelanggan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pelanggan_id' => 'required|string',
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|string',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'string' => 'Kolom :attribute hanya boleh berupa text',
            'numeric' => 'Kolom :attribute Terjadi kesalahan'
        ], [
            'name' => 'Nama',
            'no_hp' => 'No Handphone',
            'alamat' => 'Alamat'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {


            $dataPelanggan = [
                'nama_lengkap' => $request->input('nama_lengkap'),
                'no_hp' => $request->input('no_hp'),
                'alamat' => $request->input('alamat'),
                'updated_at' => date('Y-m-d H:i:s')
            ];


            $update = PelangganModel::where('pelanggan_id', $request->input('pelanggan_id'))->update($dataPelanggan);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah data pelanggan');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah data pelanggan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapusPelanggan($pelangganId)
    {
        try {
            $delete = PelangganModel::where('pelanggan_id', $pelangganId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus pelanggan');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus pelanggan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function pengguna()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataPengguna = User::orderBy('user_id', 'desc')->get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'dataPengguna' => $dataPengguna
        ];
        return view('admin.users.pengguna', $data);
    }

    function updatePengguna(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'status' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }


        try {
            $data = [
                'status' => $request->input('status'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
            $update = User::where('user_id', $request->input('user_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil menguubah status pengguna');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah status pengguna');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Gagal mengubah status pengguna');
        }
    }

    function karyawan()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataKaryawan = KaryawanModel::orderBy('karyawan_id', 'desc')->get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'dataKaryawan' => $dataKaryawan
        ];
        return view('admin.users.karyawan', $data);
    }

    function tambahKaryawan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:owner,email',
            'password' => 'required|string|min:8',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|string'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'string' => 'Kolom :attribute hanya boleh berupa text',
            'email' => 'Kolom :attribute tidak valid',
            'unique' => 'Email telah terdaftar',
            'numeric' => 'No handphone hanya boleh berupa angka',
            'min' => 'Kata sandi tidak boleh kurang dari 8 karakter'
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'password' => 'Kata sandi',
            'no_hp' => 'No handphone',
            'alamat' => 'Alamat',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {

            $dataKaryawan = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'no_hp' => $request->input('no_hp'),
                'alamat' => $request->input('alamat'),
                'password' => Hash::make($request->input('password')),
                'created_at' => date('Y-m-d H:i:s')
            ];

            $insert = KaryawanModel::insert($dataKaryawan);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan karyawan baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan karyawan baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function updateKaryawan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'karyawan_id' => 'required|numeric',
            'status' => 'required|numeric',
            'name' => 'required|string',
            'email' => 'required|email|unique:owner,email',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|string'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'string' => 'Kolom :attribute hanya boleh berupa text',
            'email' => 'Kolom :attribute tidak valid',
            'unique' => 'Email telah terdaftar',
            'numeric' => 'No handphone hanya boleh berupa angka',
            'min' => 'Kata sandi tidak boleh kurang dari 8 karakter'
        ], [
            'name' => 'Nama',
            'email' => 'Email',
            'no_hp' => 'No handphone',
            'alamat' => 'Alamat',
            'karyawan_id' => 'ID Karyawan',
            'status' => 'Status karyawan'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        if (!empty($request->input('password'))) { // jika user mengganti password
            $validatorPassword = Validator::make($request->all(), [
                'password' => 'required|string|min:8',
            ], [
                'password.required' => 'Kata sandi tidak boleh kosong',
                'password.string' => 'Kata sandi hanya boleh mengandung huruf dan angka',
                'password.min' => 'Kata sandi tidak boleh kurang dari 8 karakter',
            ]);

            if ($validatorPassword->fails()) {
                return redirect()->back()->with('failed', $validatorPassword->errors()->first());
            }

            $dataKaryawan = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'no_hp' => $request->input('no_hp'),
                'status' => $request->input('status'),
                'alamat' => $request->input('alamat'),
                'password' => Hash::make($request->input('password')),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $dataKaryawan = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'no_hp' => $request->input('no_hp'),
                'status' => $request->input('status'),
                'alamat' => $request->input('alamat'),
                'password' => Hash::make($request->input('password')),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }

        try {

            $update = KaryawanModel::where('karyawan_id', $request->input('karyawan_id'))->update($dataKaryawan);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah data karyawan');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah data karyawan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function hapusKaryawan($karyawanId)
    {
        try {
            $delete = KaryawanModel::where('karyawan_id', $karyawanId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus karyawan');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus karyawan');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
