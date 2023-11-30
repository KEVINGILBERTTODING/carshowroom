<?php

namespace App\Http\Controllers\admin\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\KapasitasMesinModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KapasitasMesinController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataKapasitasMesin = KapasitasMesinModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataMesin' => $dataKapasitasMesin,
            'dataApp' => $dataApp
        ];

        return view('admin.components.kapasitas_mesin', $data);
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
            $insert = KapasitasMesinModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan kapasitas baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan kapasitas baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($kmId)
    {
        if ($kmId == null || $kmId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = KapasitasMesinModel::where('km_id', $kmId)->delete();
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
            'km_id' => 'required|integer',
            'kapasitas' => 'required|string',
        ], [
            'km_id.required' => 'Terjadi kesalahan',
            'km_id.integer' => 'Terjadi kesalahan',
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
            $update = KapasitasMesinModel::where('km_id', $request->input('km_id'))->update($data);
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
