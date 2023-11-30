<?php

namespace App\Http\Controllers\admin\components;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\BodyModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BodyController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataBody = BodyModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataBody' => $dataBody,
            'dataApp' => $dataApp
        ];

        return view('admin.components.body', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|string',
        ], [
            'body.required' => 'Jenis body tidak boleh kosong',
            'body.string' => 'Jenis body hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'body' => $request->input('body'),
                'created_at' => date('Y-m-d H:i:s')

            ];
            $insert = BodyModel::insert($data);
            if ($insert) {
                return redirect()->back()->with('success', 'Berhasil menambahkan jenis body baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan jenis body baru');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
    function hapus($bodyId)
    {
        if ($bodyId == null || $bodyId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = BodyModel::where('body_id', $bodyId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus jenis body');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus jenis body');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body_id' => 'required|integer',
            'body' => 'required|string',
        ], [
            'body_id.required' => 'Terjadi kesalahan',
            'body_id.integer' => 'Terjadi kesalahan',
            'body.required' => 'Jenis body tidak boleh kosong',
            'body.string' => 'Jenis body hanya boleh mengandung huruf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'body' => $request->input('body'),
                'updated_at' => date('Y-m-d H:i:s')

            ];
            $update = BodyModel::where('body_id', $request->input('body_id'))->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Berhasil mengubah jenis body');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah jenis body');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
