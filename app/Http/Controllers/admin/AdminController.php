<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use Illuminate\Http\Request;
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
            return redirect()->route('adminProfile')->with('failed', $validator->errors());
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
}
