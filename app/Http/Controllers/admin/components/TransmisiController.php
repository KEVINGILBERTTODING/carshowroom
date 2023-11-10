<?php

namespace App\Http\Controllers\admin\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\CreditModel;
use App\Models\TransactionModel;
use App\Models\TransmisiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransmisiController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataTransmisi = TransmisiModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataTransmisi' => $dataTransmisi,
            'dataApp' => $dataApp
        ];

        return view('admin.components.transmisi', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transmisi' => 'required|string',
        ], [
            'transmisi.required' => 'Jenis transmisi tidak boleh kosong',
            'transmisi.string' => 'Jenis transmisi hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'transmisi' => $request->input('transmisi'),
                'created_at' => date('Y-m-d H:i:s')

            ];
            $insert = TransmisiModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan jenis transmisi baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan jenis transmisi baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($transmisiId)
    {
        if ($transmisiId == null || $transmisiId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = TransmisiModel::where('transmisi_id', $transmisiId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus jenis transmisi');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus jenis transmisi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transmisi_id' => 'required|integer',
            'transmisi' => 'required|string',
        ], [
            'transmisi_id.required' => 'Terjadi kesalahan',
            'transmisi_id.integer' => 'Terjadi kesalahan',
            'transmisi.required' => 'Jenis transmisi tidak boleh kosong',
            'transmisi.string' => 'Jenis transmisi hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'transmisi' => $request->input('transmisi'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $update = TransmisiModel::where('transmisi_id', $request->input('transmisi_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah jenis transmisi');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah jenis transmisi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
