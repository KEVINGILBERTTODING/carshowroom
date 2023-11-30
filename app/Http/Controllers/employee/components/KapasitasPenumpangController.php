<?php

namespace App\Http\Controllers\admin\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\KapasitasPenumpangModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KapasitasPenumpangController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataKapasitasPenumpang = KapasitasPenumpangModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataMerk' => $dataKapasitasPenumpang,
            'dataApp' => $dataApp
        ];

        return view('admin.components.kapasitas_penumpang', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kapasitas' => 'required|string',
        ], [
            'kapasitas.required' => 'Nama kapasitas tidak boleh kosong',
            'kapasitas.string' => 'Nama kapasitas hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'kapasitas' => $request->input('kapasitas'),
                'created_at' => date('Y-m-d H:i:s')

            ];
            $insert = KapasitasPenumpangModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan kapasitas baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan kapasitas baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($kapasitasId)
    {
        if ($kapasitasId == null || $kapasitasId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = KapasitasPenumpangModel::where('kp_id', $kapasitasId)->delete();
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
            'kp_id' => 'required|integer',
            'kapasitas' => 'required|string',
        ], [
            'kp_id.required' => 'Terjadi kesalahan',
            'kp_id.integer' => 'Terjadi kesalahan',
            'kapasitas.required' => 'Nama kapasitas tidak boleh kosong',
            'kapasitas.string' => 'Nama kapasitas hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'kapasitas' => $request->input('kapasitas'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $update = KapasitasPenumpangModel::where('kp_id', $request->input('kp_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah kapasitas');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah kapasitas');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
