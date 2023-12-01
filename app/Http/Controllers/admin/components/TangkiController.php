<?php

namespace App\Http\Controllers\admin\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\EmployeeModel;
use App\Models\TangkiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TangkiController extends Controller
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
        $dataKapasitasTangki = TangkiModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataTangki' => $dataKapasitasTangki,
            'dataApp' => $dataApp
        ];

        return view('admin.components.kapasitas_tangki', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tangki' => 'required|string',
        ], [
            'tangki.required' => 'Nama tangki tidak boleh kosong',
            'tangki.string' => 'Nama tangki hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'tangki' => $request->input('tangki'),
                'created_at' => date('Y-m-d H:i:s')

            ];
            $insert = TangkiModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan kapasitas tangki baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan kapasitas tangki baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($tangkiId)
    {
        if ($tangkiId == null || $tangkiId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = TangkiModel::where('tangki_id', $tangkiId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus kapasitas');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus kapasitas');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tangki_id' => 'required|integer',
            'tangki' => 'required|string',
        ], [
            'tangki_id.required' => 'Terjadi kesalahan',
            'tangki_id.integer' => 'Terjadi kesalahan',
            'tangki.required' => 'Nama tangki tidak boleh kosong',
            'tangki.string' => 'Nama tangki hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'tangki' => $request->input('tangki'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $update = TangkiModel::where('tangki_id', $request->input('tangki_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah tangki');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah tangki');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
