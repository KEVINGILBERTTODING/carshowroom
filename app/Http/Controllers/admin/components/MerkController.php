<?php

namespace App\Http\Controllers\admin\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\MerkModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MerkController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMerk = MerkModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataMerk' => $dataMerk,
            'dataApp' => $dataApp
        ];

        return view('admin.components.merk', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merk' => 'required|string',
        ], [
            'merk.required' => 'Nama merk tidak boleh kosong',
            'merk.string' => 'Nama merk hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'merk' => $request->input('merk'),
                'created_at' => date('Y-m-d H:i:s')

            ];
            $insert = MerkModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan merk baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan merk baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($merkId)
    {
        if ($merkId == null || $merkId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = MerkModel::where('merk_id', $merkId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus merk');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus merk');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merk_id' => 'required|integer',
            'merk' => 'required|string',
        ], [
            'merk_id.required' => 'Terjadi kesalahan',
            'merk_id.integer' => 'Terjadi kesalahan',
            'merk.required' => 'Nama merk tidak boleh kosong',
            'merk.string' => 'Nama merk hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'merk' => $request->input('merk'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $update = MerkModel::where('merk_id', $request->input('merk_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah merk');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah merk');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
