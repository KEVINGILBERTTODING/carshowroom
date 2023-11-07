<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\OwnerModel;
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
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp
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
            $fileName = 'Admin_' . time() . '.' . $fileImage->getClientOriginalExtension();
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
        return view('admin.owner.owner', $data);
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
}
