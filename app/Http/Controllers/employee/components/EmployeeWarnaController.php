<?php

namespace App\Http\Controllers\employee\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\EmployeeModel;
use App\Models\WarnaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeWarnaController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $dataKaryawan = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataWarna = WarnaModel::get();
        $data = [
            'dataKaryawan' => $dataKaryawan,
            'dataWarna' => $dataWarna,
            'dataApp' => $dataApp
        ];

        return view('employee.components.warna', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warna' => 'required|string',
        ], [
            'warna.required' => 'Nama warna tidak boleh kosong',
            'warna.string' => 'Nama warna hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'warna' => $request->input('warna'),
                'created_at' => date('Y-m-d H:i:s')

            ];
            $insert = WarnaModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan warna baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan warna baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($warnaId)
    {
        if ($warnaId == null || $warnaId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = WarnaModel::where('warna_id', $warnaId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus warna');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus warna');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'warna_id' => 'required|integer',
            'warna' => 'required|string',
        ], [
            'warna_id.required' => 'Terjadi kesalahan',
            'warna_id.integer' => 'Terjadi kesalahan',
            'warna.required' => 'Nama warna tidak boleh kosong',
            'warna.string' => 'Nama warna hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'warna' => $request->input('warna'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $update = WarnaModel::where('warna_id', $request->input('warna_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah warna');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah warna');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
