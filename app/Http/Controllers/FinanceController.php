<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\FInanceModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataFinance = FInanceModel::get();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataFinance' => $dataFinance,
            'dataApp' => $dataApp
        ];

        return view('admin.finance.finance', $data);
    }

    function tambah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_finance' => 'required|string',
            'telepon' => 'required|string',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            'bunga' => 'required|numeric',
            'biaya_administrasi' => 'required|numeric',
            'biaya_asuransi' => 'required|numeric',
            'uang_muka' => 'required|numeric',
            'biaya_provisi' => 'required|numeric',
        ], [
            'nama_finance.required' => 'Nama perusahaan tidak boleh kosong',
            'nama_finance.string' => 'Nama perusahaan hanya boleh mengandung huruf',
            'telepon.required' => 'Nomor telepon tidak boleh kosong',
            'telepon.string' => 'Nomor telepon perusahaan hanya boleh mengandung huruf dan angka',
            'logo.required' => 'Gambar logo perusahaan tidak boleh kosong',
            'logo.mimes' => 'Format gambar logo perusahaan tidak valid',
            'logo.image' => 'Gambar logo perusahaan tidak valid',
            'logo.max' => 'Ukuran gambar logo tidak boleh lebih dari 5 MB',
            'bunga.required' => 'Bunga kredit tidak boleh kosong',
            'bunga.numeric' => 'Bunga kredit hanya boleh berupa angka',
            'biaya_asuransi.required' => 'Biaya Asuransi tidak boleh kosong',
            'biaya_asuransi.numeric' => 'Biaya Asuransi hanya boleh berupa angka',
            'biaya_administrasi.required' => 'Biaya administrasi tidak boleh kosong',
            'biaya_administrasi.numeric' => 'Biaya administrasi hanya boleh berupa angka',
            'uang_muka.required' => 'Uang muka tidak boleh kosong',
            'uang_muka.numeric' => 'Uang muka hanya boleh berupa angka',
            'biaya_provisi.required' => 'Biaya Provisi tidak boleh kosong',
            'biaya_provisi.numeric' => 'Biaya hanya boleh berupa angka',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        if (!$request->hasFile('logo')) {
            return redirect()->back()->with('failed', 'Gambar logo perusahaan tidak boleh kosong');
        } else {
            try {
                $fileImage = $request->file('logo');
                $fileName = 'Finance_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileImage->getClientOriginalExtension();
                $fileImage->move('data/finance/img', $fileName);
                $data = [
                    'nama_finance' => $request->input('nama_finance'),
                    'deskripsi' => $request->input('deskripsi'),
                    'url_website' => $request->input('url_website'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_instagram' => $request->input('url_instagram'),
                    'telepon' => $request->input('telepon'),
                    'email' => $request->input('email'),
                    'bunga' => $request->input('bunga'),
                    'biaya_asuransi' => $request->input('biaya_asuransi'),
                    'biaya_administrasi' => $request->input('biaya_administrasi'),
                    'uang_muka' => $request->input('uang_muka'),
                    'biaya_provisi' => $request->input('biaya_provisi'),
                    'image' => $fileName,
                    'created_at' => date('Y-m-d H:i:s')

                ];
                $insert = FInanceModel::insert($data);
                if ($insert) {
                    return redirect()->back()->with('success', 'Berhasil menambahkan perusahaan finance baru');
                } else {
                    return redirect()->back()->with('failed', 'Gagal menambahkan perusahaan finance baru');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        }
    }
    function hapus($financeId)
    {
        if ($financeId == null || $financeId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }

        try {
            $delete = FInanceModel::where('finance_id', $financeId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus data finance');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus data finance');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function ubah(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'finance_id' => 'required|numeric',
            'nama_finance' => 'required|string',
            'telepon' => 'required|string',
            'bunga' => 'required|numeric',
            'biaya_administrasi' => 'required|numeric',
            'biaya_asuransi' => 'required|numeric',
            'uang_muka' => 'required|numeric',
            'biaya_provisi' => 'required|numeric',
        ], [
            'finance_id.required' => 'Terjadi kesalahan',
            'finance_id.numeric' => 'Terjadi kesalahan',
            'nama_finance.required' => 'Nama perusahaan tidak boleh kosong',
            'nama_finance.string' => 'Nama perusahaan hanya boleh mengandung huruf',
            'telepon.required' => 'Nomor telepon tidak boleh kosong',
            'telepon.string' => 'Nomor telepon perusahaan hanya boleh mengandung huruf dan angka',
            'bunga.required' => 'Bunga kredit tidak boleh kosong',
            'bunga.numeric' => 'Bunga kredit hanya boleh berupa angka',
            'biaya_asuransi.required' => 'Biaya Asuransi tidak boleh kosong',
            'biaya_asuransi.numeric' => 'Biaya Asuransi hanya boleh berupa angka',
            'biaya_administrasi.required' => 'Biaya administrasi tidak boleh kosong',
            'biaya_administrasi.numeric' => 'Biaya administrasi hanya boleh berupa angka',
            'uang_muka.required' => 'Uang muka tidak boleh kosong',
            'uang_muka.numeric' => 'Uang muka hanya boleh berupa angka',
            'biaya_provisi.required' => 'Biaya Provisi tidak boleh kosong',
            'biaya_provisi.numeric' => 'Biaya hanya boleh berupa angka',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        if ($request->hasFile('logo')) {
            $validator = Validator::make($request->all(), [
                'logo' => 'required|image|mimes:png,jpg,jpeg|max:5000'
            ], [
                'logo.required' => 'Gambar logo perusahaan tidak boleh kosong',
                'logo.mimes' => 'Format gambar logo perusahaan tidak valid',
                'logo.image' => 'Gambar logo perusahaan tidak valid',
                'logo.max' => 'Ukuran gambar logo tidak boleh lebih dari 5 MB',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('failed', $validator->errors()->first());
            }

            try {
                $fileImage = $request->file('logo');
                $fileName = 'Finance_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileImage->getClientOriginalExtension();
                $fileImage->move('data/finance/img', $fileName);
                $data = [
                    'nama_finance' => $request->input('nama_finance'),
                    'deskripsi' => $request->input('deskripsi'),
                    'url_website' => $request->input('url_website'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_instagram' => $request->input('url_instagram'),
                    'telepon' => $request->input('telepon'),
                    'email' => $request->input('email'),
                    'bunga' => $request->input('bunga'),
                    'biaya_asuransi' => $request->input('biaya_asuransi'),
                    'biaya_administrasi' => $request->input('biaya_administrasi'),
                    'uang_muka' => $request->input('uang_muka'),
                    'biaya_provisi' => $request->input('biaya_provisi'),
                    'image' => $fileName,
                    'updated_at' => date('Y-m-d H:i:s')

                ];
                $update = FInanceModel::where('finance_id', $request->input('finance_id'))->update($data);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data finance');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data finance');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        } else {
            try {

                $data = [
                    'nama_finance' => $request->input('nama_finance'),
                    'deskripsi' => $request->input('deskripsi'),
                    'url_website' => $request->input('url_website'),
                    'url_facebook' => $request->input('url_facebook'),
                    'url_instagram' => $request->input('url_instagram'),
                    'telepon' => $request->input('telepon'),
                    'email' => $request->input('email'),
                    'bunga' => $request->input('bunga'),
                    'biaya_asuransi' => $request->input('biaya_asuransi'),
                    'biaya_administrasi' => $request->input('biaya_administrasi'),
                    'uang_muka' => $request->input('uang_muka'),
                    'biaya_provisi' => $request->input('biaya_provisi'),
                    'updated_at' => date('Y-m-d H:i:s')

                ];
                $update = FInanceModel::where('finance_id', $request->input('finance_id'))->update($data);

                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah data finance');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah data finance ');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        }
    }
}
