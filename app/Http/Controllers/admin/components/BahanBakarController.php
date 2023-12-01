<?php

namespace App\Http\Controllers\admin\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\BahanBakarModel;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BahanBakarController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } else {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $dataBahanBakar = BahanBakarModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataBahanBakar' => $dataBahanBakar,
            'dataApp' => $dataApp
        ];

        return view('admin.components.bahan_bakar', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bahan_bakar' => 'required|string',
        ], [
            'bahan_bakar.required' => 'Nama bahan_bakar tidak boleh kosong',
            'bahan_bakar.string' => 'Nama bahan_bakar hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'bahan_bakar' => $request->input('bahan_bakar'),
                'created_at' => date('Y-m-d H:i:s')

            ];
            $insert = BahanBakarModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan jenis bahan bakar baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan bahan jenis bakar baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($bahanBakarId)
    {
        if ($bahanBakarId == null || $bahanBakarId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = BahanBakarModel::where('bahan_bakar_id', $bahanBakarId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus bahan bakar');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus bahan bakar');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bahan_bakar_id' => 'required|integer',
            'bahan_bakar' => 'required|string',
        ], [
            'bahan_bakar_id.required' => 'Terjadi kesalahan',
            'bahan_bakar_id.integer' => 'Terjadi kesalahan',
            'bahan_bakar.required' => 'Jenis bahan bakar tidak boleh kosong',
            'bahan_bakar.string' => 'Jenis bahan bakar hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'bahan_bakar' => $request->input('bahan_bakar'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $update = BahanBakarModel::where('bahan_bakar_id', $request->input('bahan_bakar_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah jenis bahan bakar');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah jenis bahan bakar');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
