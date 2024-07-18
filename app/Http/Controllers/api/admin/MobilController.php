<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\DetailGambar;
use App\Models\DetailMobil;
use App\Models\AppModel;
use App\Models\BahanBakarModel;
use App\Models\BodyModel;
use App\Models\CreditModel;
use App\Models\EmployeeModel;
use App\Models\FInanceModel;
use App\Models\KapasitasMesinModel;
use App\Models\KapasitasPenumpangModel;
use App\Models\MerkModel;
use App\Models\MobilModel;
use App\Models\OwnerModel;
use App\Models\PelangganModel;
use App\Models\ReviewModel;
use App\Models\TangkiModel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\TransactionModel;
use App\Models\TransmisiModel;
use App\Models\WarnaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function getDataTambahMobil()
    {

        try {

            $dataMerk = MerkModel::get();
            $dataBody = BodyModel::get();
            $dataWarna = WarnaModel::get();
            $dataKapasitasMesin = KapasitasMesinModel::get();
            $dataBahanBakar = BahanBakarModel::get();
            $dataTransmisi  = TransmisiModel::get();
            $dataKapasitasPenumpang = KapasitasPenumpangModel::get();
            $dataTangki = TangkiModel::get();

            $data = [
                'dataMerk' => $dataMerk,
                'dataBody' => $dataBody,
                'dataWarna' => $dataWarna,
                'dataKapasitasMesin' => $dataKapasitasMesin,
                'dataBahanBakar' => $dataBahanBakar,
                'dataTransmisi' => $dataTransmisi,
                'dataKapasitasPenumpang' => $dataKapasitasPenumpang,
                'dataTangki' => $dataTangki
            ];
            return response([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Server error',

            ], 500);
        }
    }

    public function insertMobil(Request $request)
    {
        // // Inisialisasi array data
        $data = [];

        // // Inisialisasi rules validasi untuk setiap input gambar
        $rules = [];
        $messages = [];

        $validatorData = Validator::make($request->all(), [
            'merk_id' => 'required|numeric',
            'body_id' => 'required|numeric',
            'nama_model' => 'required|string',
            'no_plat' => 'required|string',
            'no_mesin' => 'required|string',
            'no_rangka' => 'required|string',
            'tahun' => 'required|numeric',
            'warna_id' => 'required|numeric',
            'km_id' => 'required|numeric',
            'bahan_bakar_id' => 'required|numeric',
            'transmisi_id' => 'required|numeric',
            'kp_id' => 'required|numeric',
            'km' => 'required|string',
            'tangki_id' => 'required|numeric',
            'harga_beli' => 'required|string',
            'biaya_perbaikan' => 'required|string',
            'harga_jual' => 'required|string',
            'diskon' => 'nullable|string',
            'tanggal_masuk' => 'nullable',
            'deskripsi' => 'required|string',
            'url_youtube' => 'string|nullable',
            'url_facebook' => 'string|nullable',
            'url_instagram' => 'string|nullable',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'string' => 'Kolom :attribute harus berupa teks.',
        ], [
            'merk_id' => 'Merk mobil',
            'body_id' => 'Jenis body mobil',
            'nama_model' => 'Model mobil',
            'no_plat' => 'Nomor plat',
            'no_mesin' => 'Nomor mesin',
            'no_rangka' => 'Nomor rangka',
            'tahun' => 'Tahun pembuatan',
            'warna_id' => 'Warna mobil',
            'km_id' => 'Kapasitas mesin',
            'bahan_bakar_id' => 'Jenis bahan bakar',
            'transmisi_id' => 'Jenis transmisi',
            'kp_id' => 'Kapasitas penumpang',
            'km' => 'Jarak yang telah ditempuh',
            'tangki_id' => 'Kapasitas tangki',
            'harga_beli' => 'Harga Beli',
            'biaya_perbaikan' => 'Biaya Perbaikan',
            'harga_jual' => 'Harga Jual',
            'deskripsi' => 'Deskripsi',
            'url_youtube' => 'Link Youtube',
            'url_instagram' => 'Link Instagram',
            'url_facebook' => 'Link Facebook',
        ]);

        if ($validatorData->fails()) {
            return response([
                'message' => $validatorData->errors()->first()
            ], 400);
        }

        for ($i = 1; $i <= 6; $i++) {
            $field = 'gambar' . $i;

            if ($request->hasFile($field)) {
                $rules[$field] = 'image|mimes:jpeg,png,jpg,gif|max:5048'; // Gantilah sesuai dengan kebutuhan Anda
                $messages[$field . '.image'] = 'Field ' . $field . ' harus berupa gambar';
                $messages[$field . '.mimes'] = 'Field ' . $field . ' format gambar tidak valid';
                $messages[$field . '.max'] = 'Field ' . $field . ' ukuran gambar tidak boleh lebih dari 5 MB';
            }
        }

        // Validasi request
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 400);
        }


        $dataGambar = [];

        // // Proses penyimpanan gambar
        for ($i = 1; $i <= 6; $i++) {
            $field = 'gambar' . $i;

            if ($request->hasFile($field)) {
                $fileGambar = $request->file($field);
                $fileName = $field . '_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileGambar->getClientOriginalExtension();
                $fileGambar->move('data/cars', $fileName);
                $dataGambar[$field] = $fileName;
            }
        }


        $data['merk_id'] = $request->input('merk_id');
        $data['body_id'] = $request->input('body_id');
        $data['nama_model'] = $request->input('nama_model');
        $data['no_plat'] = $request->input('no_plat');
        $data['no_mesin'] = $request->input('no_mesin');
        $data['no_rangka'] = $request->input('no_rangka');
        $data['tahun'] = $request->input('tahun');
        $data['warna_id'] = $request->input('warna_id');
        $data['km_id'] = $request->input('km_id');
        $data['bahan_bakar_id'] = $request->input('bahan_bakar_id');
        $data['transmisi_id'] = $request->input('transmisi_id');
        $data['kp_id'] = $request->input('kp_id');
        $data['km'] = preg_replace('/[^0-9]/', '', $request->km);
        $data['nama_pemilik'] = $request->input('nama_pemilik');
        $data['tangki_id'] = $request->input('tangki_id');

        $data['created_at'] = date('Y-m-d H:i:s');

        $dataDetailMobil['harga_beli'] = preg_replace('/[^0-9]/', '', $request->harga_beli);
        $dataDetailMobil['biaya_perbaikan'] =  preg_replace('/[^0-9]/', '', $request->biaya_perbaikan);
        $dataDetailMobil['harga_jual'] =  preg_replace('/[^0-9]/', '', $request->harga_jual);
        $dataDetailMobil['tgl_masuk'] = $request->input('tanggal_masuk');
        $dataDetailMobil['diskon'] =  preg_replace('/[^0-9]/', '', $request->diskon);
        $dataDetailMobil['deskripsi'] = $request->input('deskripsi');
        $dataDetailMobil['url_youtube'] = $request->input('url_youtube');
        $dataDetailMobil['url_facebook'] = $request->input('url_facebook');
        $dataDetailMobil['url_instagram'] = $request->input('url_instagram');

        try {
            DB::beginTransaction();
            $insertMobil = MobilModel::create($data);
            $mobilId = $insertMobil->mobil_id;
            $dataGambar['mobil_id'] = $mobilId;
            $dataDetailMobil['mobil_id'] = $mobilId;

            DetailGambar::create($dataGambar);
            DetailMobil::create($dataDetailMobil);


            DB::commit();
            return response([
                'message' => 'success',
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Gagal menambahkan mobil baru',
            ], 400);
        }
    }

    function seluruhMobil()
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMobil = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->select('mobil.*', 'merk.merk', 'detail_gambar.*', 'detail_mobil.*')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->join('detail_gambar', 'mobil.mobil_id', '=', 'detail_gambar.mobil_id')
            ->orderBy('mobil.mobil_id', 'desc')
            ->get();
        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataMobil' => $dataMobil
        ];

        return view('admin.car.all_car', $data);
    }

    function mobilDiPesan()
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMobil = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->select('mobil.*', 'merk.merk')
            ->where('mobil.status_mobil', 2)
            ->orderBy('mobil.mobil_id', 'desc')
            ->get();
        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataMobil' => $dataMobil
        ];

        return view('admin.car.car_booked', $data);
    }

    function mobilTerjual()
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMobil = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->select('mobil.*', 'merk.merk')
            ->where('mobil.status_mobil', 0)
            ->orderBy('mobil.mobil_id', 'desc')
            ->get();
        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataMobil' => $dataMobil
        ];

        return view('admin.car.car_soldout', $data);
    }

    function mobilTersedia()
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMobil = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->select('mobil.*', 'merk.merk')
            ->where('mobil.status_mobil', 1)
            ->orderBy('mobil.mobil_id', 'desc')
            ->get();
        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataMobil' => $dataMobil
        ];

        return view('admin.car.car_available', $data);
    }

    function hapus($mobilId)
    {
        if ($mobilId == null && $mobilId == 0) {
            return response([
                'message' => 'Terjadi kesalahan'
            ], 400);
        }
        try {
            $delete = MobilModel::where('mobil_id', $mobilId)->delete();
            $deleteGambar =  DetailGambar::where('mobil_id', $mobilId)->delete();
            $deleteDetailMobil =  DetailMobil::where('mobil_id', $mobilId)->delete();
            if ($delete && $deleteGambar && $deleteDetailMobil) {
                return response([
                    'message' => 'success', 'Berhasil menghapus data mobil'
                ], 200);
            } else {
                return response([
                    'message' => 'Gagal menghapus data mobil'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    function ajaxGetDetailMobil($mobilId)
    {
        $data = MobilModel::where('mobil_id', $mobilId)->first();
        return response()->json($data);
    }

    function adminDetailMobil($mobil_id)
    {
        try {
            $mobilModel = new MobilModel();
            $dataMobil = $mobilModel->getDetailMobil($mobil_id);
            return response([
                'message' => 'success',
                'data' => $dataMobil
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Server error'
            ], 500);
        }
    }
    function ubahMobil($mobil_id)
    {
        $mobilModel = new MobilModel();
        $detailMobil = $mobilModel->getDetailMobil($mobil_id);
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMerk = MerkModel::get();
        $dataBody = BodyModel::get();
        $dataWarna = WarnaModel::get();
        $dataKapasitasMesin = KapasitasMesinModel::get();
        $dataBahanBakar = BahanBakarModel::get();
        $dataTransmisi  = TransmisiModel::get();
        $dataKapasitasPenumpang = KapasitasPenumpangModel::get();
        $dataTangki = TangkiModel::get();
        $dataMobil = MobilModel::where('mobil_id', $mobil_id)->first();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'dataMerk' => $dataMerk,
            'dataBody' => $dataBody,
            'dataWarna' => $dataWarna,
            'dataKapasitasMesin' => $dataKapasitasMesin,
            'dataBahanBakar' => $dataBahanBakar,
            'dataTransmisi' => $dataTransmisi,
            'dataKapasitasPenumpang' => $dataKapasitasPenumpang,
            'dataTangki' => $dataTangki,
            'dataMobil' => $dataMobil,
            'detailMobil' => $detailMobil,
            'dataFinance' => $dataFinance
        ];
        return view('admin.car.update_car', $data);
    }

    public function updateMobil(Request $request)
    {
        // // Inisialisasi array data
        $data = [];

        // // Inisialisasi rules validasi untuk setiap input gambar
        $rules = [];
        $messages = [];



        $validatorData = Validator::make($request->all(), [
            'mobil_id' => 'required|numeric',
            'merk_id' => 'required|numeric',
            'body_id' => 'required|numeric',
            'nama_model' => 'required|string',
            'no_plat' => 'required|string',
            'no_mesin' => 'required|string',
            'no_rangka' => 'required|string',
            'tahun' => 'required|numeric',
            'warna_id' => 'required|numeric',
            'km_id' => 'required|numeric',
            'bahan_bakar_id' => 'required|numeric',
            'transmisi_id' => 'required|numeric',
            'kp_id' => 'required|numeric',
            'km' => 'required|string',
            'tangki_id' => 'required|numeric',
            'harga_beli' => 'required|string',
            'diskon' => 'string|nullable',
            'biaya_perbaikan' => 'required|string',
            'harga_jual' => 'required|string',
            'tanggal_masuk' => 'nullable',
            'deskripsi' => 'required|string',
            'url_youtube' => 'nullable|string',
            'url_instagram' => 'nullable|string',
            'url_facebook' => 'nullable|string',
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong.',
            'numeric' => 'Kolom :attribute harus berupa angka.',
            'string' => 'Kolom :attribute harus berupa teks.',
        ], [
            'mobil_id' => 'Mobil',
            'merk_id' => 'Merk mobil',
            'body_id' => 'Jenis body mobil',
            'nama_model' => 'Model mobil',
            'no_plat' => 'Nomor plat',
            'no_mesin' => 'Nomor mesin',
            'no_rangka' => 'Nomor rangka',
            'tahun' => 'Tahun pembuatan',
            'warna_id' => 'Warna mobil',
            'km_id' => 'Kapasitas mesin',
            'bahan_bakar_id' => 'Jenis bahan bakar',
            'transmisi_id' => 'Jenis transmisi',
            'kp_id' => 'Kapasitas penumpang',
            'km' => 'Jarak yang telah ditempuh',
            'tangki_id' => 'Kapasitas tangki',
            'harga_beli' => 'Harga Beli',
            'biaya_perbaikan' => 'Biaya Perbaikan',
            'harga_jual' => 'Harga Jual',
            'deskripsi' => 'Deskripsi',
            'url_youtube' => 'Link Youtube'
        ]);

        if ($validatorData->fails()) {
            return response([
                'message' => $validatorData->errors()->first()
            ], 400);
        }

        for ($i = 1; $i <= 6; $i++) {
            $field = 'gambar' . $i;

            if ($request->hasFile($field)) {
                $rules[$field] = 'image|mimes:jpeg,png,jpg,gif|max:5048'; // Gantilah sesuai dengan kebutuhan Anda
                $messages[$field . '.image'] = 'Field ' . $field . ' harus berupa gambar';
                $messages[$field . '.mimes'] = 'Field ' . $field . ' format gambar tidak valid';
                $messages[$field . '.max'] = 'Field ' . $field . ' ukuran gambar tidak boleh lebih dari 5 MB';
            }
        }

        // Validasi request
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $dataGambar = [];
        $dataDetailMobil = [];


        // // Proses penyimpanan gambar
        for ($i = 1; $i <= 6; $i++) {
            $field = 'gambar' . $i;

            if ($request->hasFile($field)) {
                $fileGambar = $request->file($field);
                $fileName = $field . '_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileGambar->getClientOriginalExtension();
                $fileGambar->move('data/cars', $fileName);
                $dataGambar[$field] = $fileName;
            }
        }

        $data['merk_id'] = $request->input('merk_id');
        $data['body_id'] = $request->input('body_id');
        $data['nama_model'] = $request->input('nama_model');
        $data['no_plat'] = $request->input('no_plat');
        $data['no_mesin'] = $request->input('no_mesin');
        $data['no_rangka'] = $request->input('no_rangka');
        $data['tahun'] = $request->input('tahun');
        $data['warna_id'] = $request->input('warna_id');
        $data['km_id'] = $request->input('km_id');
        $data['bahan_bakar_id'] = $request->input('bahan_bakar_id');
        $data['transmisi_id'] = $request->input('transmisi_id');
        $data['kp_id'] = $request->input('kp_id');
        $data['km'] = preg_replace('/[^0-9]/', '', $request->km);
        $data['nama_pemilik'] = $request->input('nama_pemilik');
        $data['tangki_id'] = $request->input('tangki_id');

        $data['updated_at'] = date('Y-m-d H:i:s');



        $dataDetailMobil['harga_beli'] = preg_replace('/[^0-9]/', '', $request->harga_beli);
        $dataDetailMobil['biaya_perbaikan'] =  preg_replace('/[^0-9]/', '', $request->biaya_perbaikan);
        $dataDetailMobil['harga_jual'] =  preg_replace('/[^0-9]/', '', $request->harga_jual);
        $dataDetailMobil['tgl_masuk'] = $request->input('tanggal_masuk');
        $dataDetailMobil['diskon'] =  preg_replace('/[^0-9]/', '', $request->diskon);
        $dataDetailMobil['deskripsi'] = $request->input('deskripsi');
        $dataDetailMobil['url_youtube'] = $request->input('url_youtube');
        $dataDetailMobil['url_facebook'] = $request->input('url_facebook');
        $dataDetailMobil['url_instagram'] = $request->input('url_instagram');
        $dataDetailMobil['updated_at'] = date('Y-m-d H:i:s');




        try {
            $updateMobil = MobilModel::where('mobil_id', $request->input('mobil_id'))->update($data);
            $updateGambar = DetailGambar::where('mobil_id', $request->input('mobil_id'))->update($dataGambar);
            $updateDetailMobil = DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataDetailMobil);
            if ($updateMobil) {
                return response([
                    'message' => 'success'
                ], 200);
            } else {
                return response([
                    'message' => 'Gagal mengubah data mobil'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 500);
            // return redirect()->back()->with('failed', $th->getMessage())->withInput();
        }
    }

    function setStatusMobilTersedia(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobil_id' => 'required|numeric',
            'status' => 'required|numeric'
        ], [
            'required' => 'Terjadi kesalahan',
            'numeric' => 'Terjadi kesalahan'
        ], [
            'mobil_id' => 'Mobil',
            'status' => 'Status'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
        $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
            ->where('status', '<>', 0)->first();
        if ($checkTransaction == null) {
            try {
                $dataStatus = [
                    'status_mobil' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $update = MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataStatus);
                if ($update) {
                    return redirect()->back()->with('success', 'Berhasil mengubah status mobil');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah status mobil');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        } else {
            DB::beginTransaction();
            try {
                $dataTransaction = [
                    'status' => 0,
                    'alasan' => $request->input('alasan'),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
                TransactionModel::where('mobil_id', $request->input('mobil_id'))->update($dataTransaction);

                $dataStatus = [
                    'status_mobil' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataStatus);
                DB::commit();
                return redirect()->back()->with('success', 'Berhasil mengubah status mobil');
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        }
    }

    function setStatusMobilTerjual(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobil_id' => 'required|numeric',
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|string',
            'payment_method' => 'required|numeric',
            'diskon' => 'required|numeric',
            'harga_jual' => 'required|numeric',

        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute hanya boleh berupa angka',
            'string' => 'Kolom :attribute hanya boleh berupa huruf dan angka'
        ], [
            'mobil_id' => 'mobil',
            'nama_lengkap' => 'nama lengkap',
            'no_hp' => 'no Handphone',
            'alamat' => 'alamat',
            'payment_method' => 'metode pembayaran'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        // cek apa ada transaksi
        $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
            ->where('status', '<>', 0)->first();
        if ($checkTransaction == null) {
            // cek methode pembayaran yang digunakan
            if ($request->input('payment_method') == 2) { // jika kredit

                $rules = [];
                $messages = [];
                $dataKredit = [];

                // jika file ktp tidak ada
                if (!$request->hasFile('ktp_suami') && !$request->hasFile('ktp_istri')) {
                    return redirect()->back()->with('failed', 'KTP suami dan KTP istri tidak boleh kosong');
                }

                // validasi rules file
                if ($request->hasFile('ktp_suami')) {
                    $rules['ktp_suami'] = 'image|mimes:jpeg,png,jpg|max:3000';
                    $messages['ktp_suami' . '.image'] = 'File KTP suami harus berupa gambar';
                    $messages['ktp_suami' . '.mimes'] = 'Format gambar KTP suami tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
                    $messages['ktp_suami' . '.max'] = 'Ukuran gambar KTP suami tidak boleh lebih dari 3 MB';
                }

                if ($request->hasFile('ktp_istri')) {
                    $rules['ktp_istri'] = 'image|mimes:jpeg,png,jpg|max:3000';
                    $messages['ktp_istri' . '.image'] = 'File KTP istri harus berupa gambar';
                    $messages['ktp_istri' . '.mimes'] = 'Format gambar KTP istri tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
                    $messages['ktp_istri' . '.max'] = 'Ukuran gambar KTP istri tidak boleh lebih dari 3 MB';
                }

                if ($request->hasFile('kk')) {
                    $rules['kk'] = 'image|mimes:jpeg,png,jpg|max:3000';
                    $messages['kk' . '.image'] = 'File kartu keluarga harus berupa gambar';
                    $messages['kk' . '.mimes'] = 'Format gambar kartu keluarga tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
                    $messages['kk' . '.max'] = 'Ukuran gambar kartu keluarga tidak boleh lebih dari 3 MB';
                }

                $rules['finance_id'] = 'required';
                $messages['finance_id' . '.required'] = 'Anda belum memilih finance';





                $validatorFileCredit = Validator::make($request->all(), $rules, $messages);
                if ($validatorFileCredit->fails()) {
                    return redirect()->back()->with('failed', $validatorFileCredit->errors()->first());
                }

                $pelangganId = 'PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $transaksiId = 'TRX-PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $totalPembayaran = $request->input('harga_jual') - $request->input('diskon');


                // upload file kredit
                if ($request->hasFile('ktp_suami')) {
                    $fileKtpSuami = $request->file('ktp_suami');
                    $fileName = 'KTP-suami-' . $pelangganId .  '.' . $fileKtpSuami->getClientOriginalExtension();
                    $fileKtpSuami->move('data/credit', $fileName);
                    $dataKredit['ktp_suami'] = $fileName;
                }

                if ($request->hasFile('ktp_istri')) {
                    $fileKtpIstri = $request->file('ktp_istri');
                    $fileNameIstri = 'KTP-istri-' . $pelangganId .  '.' . $fileKtpIstri->getClientOriginalExtension();
                    $fileKtpIstri->move('data/credit', $fileNameIstri);
                    $dataKredit['ktp_istri'] = $fileNameIstri;
                }

                if ($request->hasFile('kk')) {
                    $fileKk = $request->file('kk');
                    $fileNameKk = 'KK-' . $pelangganId .  '.' . $fileKk->getClientOriginalExtension();
                    $fileKk->move('data/credit', $fileNameKk);
                    $dataKredit['kk'] = $fileNameKk;
                }



                $dataPelanggan = [
                    'pelanggan_id' => $pelangganId,
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'alamat' => $request->input('alamat'),
                    'no_hp' => $request->input('no_hp'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $dataTransaksi = [
                    'transaksi_id' => $transaksiId,
                    'mobil_id' => $request->input('mobil_id'),
                    'pelanggan_id' => $pelangganId,
                    'payment_method' => 2,
                    'total_pembayaran' => $totalPembayaran,
                    'status' => 2,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $dataMobil = [
                    'status_mobil' => 2,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                // data Kredit
                $dataKredit['transaksi_id'] = $transaksiId;
                $dataKredit['finance_id'] = $request->input('finance_id');
                $dataKredit['created_at'] = date('Y-m-d H:i:s');

                DB::beginTransaction();
                try {
                    PelangganModel::insert($dataPelanggan);
                    TransactionModel::insert($dataTransaksi);
                    CreditModel::insert($dataKredit);
                    MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);

                    DB::commit();
                    return redirect()->back()->with('success', 'Berhasil mengubah status mobil');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal mengubah status mobil');
                }
            } else { // jika metode pembayaran cash
                $validatorOngkir = Validator::make($request->all(), [
                    'biaya_pengiriman' => 'required|numeric'
                ], [
                    'biaya_pengiriman.required' => 'Biaya pengiriman tidak boleh kosong',
                    'biaya_pengiriman.numeric' => 'Biaya pengiriman hanya boleh mengandung angka'
                ]);

                if ($validatorOngkir->fails()) {
                    return redirect()->back()->with('failed', $validatorOngkir->errors()->first());
                }

                $pelangganId = 'PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $transaksiId = 'TRX-PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $totalPembayaran = $request->input('harga_jual') - $request->input('diskon');

                $dataPelanggan = [
                    'pelanggan_id' => $pelangganId,
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'alamat' => $request->input('alamat'),
                    'no_hp' => $request->input('no_hp'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $dataTransaksi = [
                    'transaksi_id' => $transaksiId,
                    'mobil_id' => $request->input('mobil_id'),
                    'pelanggan_id' => $pelangganId,
                    'payment_method' => 1,
                    'biaya_pengiriman' => $request->input('biaya_pengiriman'),
                    'total_pembayaran' => $totalPembayaran,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $dataMobil = [
                    'status_mobil' => 0,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                DB::beginTransaction();
                try {
                    PelangganModel::insert($dataPelanggan);
                    TransactionModel::insert($dataTransaksi);
                    MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);

                    DB::commit();
                    return redirect()->back()->with('success', 'Berhasil mengubah status mobil');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal mengubah status mobil');
                }
            }
        } else {
            if ($request->input('payment_method') == 2) { // jika kredit
                $rules = [];
                $messages = [];
                $dataKredit = [];

                // jika file ktp tidak ada
                if (!$request->hasFile('ktp_suami') && !$request->hasFile('ktp_istri')) {
                    return redirect()->back()->with('failed', 'KTP suami dan KTP istri tidak boleh kosong');
                }

                // validasi rules file
                if ($request->hasFile('ktp_suami')) {
                    $rules['ktp_suami'] = 'image|mimes:jpeg,png,jpg|max:3000';
                    $messages['ktp_suami' . '.image'] = 'File KTP suami harus berupa gambar';
                    $messages['ktp_suami' . '.mimes'] = 'Format gambar KTP suami tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
                    $messages['ktp_suami' . '.max'] = 'Ukuran gambar KTP suami tidak boleh lebih dari 3 MB';
                }

                if ($request->hasFile('ktp_istri')) {
                    $rules['ktp_istri'] = 'image|mimes:jpeg,png,jpg|max:3000';
                    $messages['ktp_istri' . '.image'] = 'File KTP istri harus berupa gambar';
                    $messages['ktp_istri' . '.mimes'] = 'Format gambar KTP istri tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
                    $messages['ktp_istri' . '.max'] = 'Ukuran gambar KTP istri tidak boleh lebih dari 3 MB';
                }

                if ($request->hasFile('kk')) {
                    $rules['kk'] = 'image|mimes:jpeg,png,jpg|max:3000';
                    $messages['kk' . '.image'] = 'File kartu keluarga harus berupa gambar';
                    $messages['kk' . '.mimes'] = 'Format gambar kartu keluarga tidak valid, pastikan file memiliki format .jpg, .png atau .jpeg';
                    $messages['kk' . '.max'] = 'Ukuran gambar kartu keluarga tidak boleh lebih dari 3 MB';
                }


                $rules['finance_id'] = 'required';
                $messages['finance_id' . '.required'] = 'Anda belum memilih finance';

                $validatorFileCredit = Validator::make($request->all(), $rules, $messages);
                if ($validatorFileCredit->fails()) {
                    return redirect()->back()->with('failed', $validatorFileCredit->errors()->first());
                }

                $pelangganId = 'PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $transaksiId = 'TRX-PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $totalPembayaran = $request->input('harga_jual') - $request->input('diskon');


                // upload file kredit
                if ($request->hasFile('ktp_suami')) {
                    $fileKtpSuami = $request->file('ktp_suami');
                    $fileName = 'KTP-suami-' . $pelangganId .  '.' . $fileKtpSuami->getClientOriginalExtension();
                    $fileKtpSuami->move('data/credit', $fileName);
                    $dataKredit['ktp_suami'] = $fileName;
                }

                if ($request->hasFile('ktp_istri')) {
                    $fileKtpIstri = $request->file('ktp_istri');
                    $fileNameIstri = 'KTP-istri-' . $pelangganId .  '.' . $fileKtpIstri->getClientOriginalExtension();
                    $fileKtpIstri->move('data/credit', $fileNameIstri);
                    $dataKredit['ktp_istri'] = $fileNameIstri;
                }

                if ($request->hasFile('kk')) {
                    $fileKk = $request->file('kk');
                    $fileNameKk = 'KK-' . $pelangganId .  '.' . $fileKk->getClientOriginalExtension();
                    $fileKk->move('data/credit', $fileNameKk);
                    $dataKredit['kk'] = $fileNameKk;
                }


                $dataPelanggan = [
                    'pelanggan_id' => $pelangganId,
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'alamat' => $request->input('alamat'),
                    'no_hp' => $request->input('no_hp'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $dataTransaksi = [
                    'transaksi_id' => $transaksiId,
                    'mobil_id' => $request->input('mobil_id'),
                    'pelanggan_id' => $pelangganId,
                    'payment_method' => 2,
                    'total_pembayaran' => $totalPembayaran,
                    'status' => 2,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $dataTransaksi2 = [
                    'status' => 0,
                    'alasan' => 'Mohon maaf mobil yang Anda pesan telah laku terjual, Terima kasih',
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $dataMobil = [
                    'status_mobil' => 2,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                // data Kredit
                $dataKredit['transaksi_id'] = $transaksiId;
                $dataKredit['finance_id'] = $request->input('finance_id');
                $dataKredit['created_at'] = date('Y-m-d H:i:s');

                DB::beginTransaction();
                try {
                    PelangganModel::insert($dataPelanggan);
                    TransactionModel::insert($dataTransaksi);
                    CreditModel::insert($dataKredit);
                    TransactionModel::where('mobil_id', $request->input('mobil_id'))
                        ->where('status', 2)
                        ->update($dataTransaksi2);
                    MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);


                    DB::commit();
                    return redirect()->back()->with('success', 'Berhasil mengubah status mobil');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal mengubah status mobil');
                }
            } else { // jika metode pembayaran cash

                $pelangganId = 'PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $transaksiId = 'TRX-PLG-' . Carbon::now()->format('Y-m-d-H-i-s');
                $totalPembayaran = $request->input('harga_jual') - $request->input('diskon');

                $dataPelanggan = [
                    'pelanggan_id' => $pelangganId,
                    'nama_lengkap' => $request->input('nama_lengkap'),
                    'alamat' => $request->input('alamat'),
                    'no_hp' => $request->input('no_hp'),
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $dataTransaksi = [
                    'transaksi_id' => $transaksiId,
                    'mobil_id' => $request->input('mobil_id'),
                    'pelanggan_id' => $pelangganId,
                    'payment_method' => 1,
                    'total_pembayaran' => $totalPembayaran,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $dataTransaksi2 = [
                    'status' => 0,
                    'alasan' => 'Mohon maaf mobil yang Anda pesan telah laku terjual, Terima kasih',
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $dataMobil = [
                    'status_mobil' => 0,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                DB::beginTransaction();
                try {

                    PelangganModel::insert($dataPelanggan);
                    TransactionModel::insert($dataTransaksi);
                    TransactionModel::where('mobil_id', $request->input('mobil_id'))
                        ->where('status', 2)
                        ->update($dataTransaksi2);

                    MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);

                    DB::commit();
                    return redirect()->back()->with('success', 'Berhasil mengubah status mobil');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal mengubah status mobil');
                }
            }
        }
    }

    function downloadReportCars(Request $request)
    {

        try {
            $role = $request->role;
            $status = $request->status;
            $userId = $request->user_id;

            if ($role == 2) { // admin
                $dataAdmin = Admin::where('admin_id', $userId)->first();
            } else {
                $dataAdmin = OwnerModel::where('owner_id', $userId)->first();
            }

            $dataApp = AppModel::where('app_id', 1)->first();
            if ($status == 3) { // semua mobil
                $dataMobil  = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                    ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
                    ->select('mobil.*', 'merk.merk', 'detail_mobil.*')
                    ->orderBy('mobil.mobil_id', 'desc')
                    ->get();
            } else {
                $dataMobil  = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                    ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
                    ->select('mobil.*', 'merk.merk', 'detail_mobil.*')
                    ->where('detail_mobil.status_mobil', $status)
                    ->orderBy('mobil.mobil_id', 'desc')
                    ->get();
            }


            $main_logo = public_path('data/app/img/' . $dataApp['logo']);
            if ($dataAdmin && !$dataMobil->isEmpty()) {
                $data = [
                    'dataAdmin' => $dataAdmin,
                    'dataApp' => $dataApp,
                    'dataMobil' => $dataMobil,
                    'logo' => $main_logo,
                    'dateNow' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $pdf = FacadePdf::loadView('admin/car/report/report_cars', $data);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Laporan_mobil_' . date('F_Y') . '.pdf');
            } else {
                return response([
                    'message' => 'Tidak ada data mobil'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => 'Server error'
            ], 500);
        }
    }
    function tampilMobil()
    {
        $mobilModel = new MobilModel();


        try {
            $dataApp = AppModel::where('app_id', 1)->first();
            $dataMerk = MerkModel::get();
            $dataTransmisi = TransmisiModel::get();
            $dataBody = BodyModel::get();
            $dataBahanBakar = BahanBakarModel::get();
            $dataMobil = $mobilModel->clientGetCar()->paginate(9);
            $dataFinance = FInanceModel::first();

            if ($dataFinance != null) {
                foreach ($dataMobil as $dm) {

                    // bunga cicilan
                    $persentaseBunga = $dataFinance['bunga'];
                    $bunga = $persentaseBunga / 100;

                    // dp
                    $persentaseDp = $dataFinance['uang_muka'];
                    $dp = ($dm->harga_jual - $dm->diskon) * ($persentaseDp / 100);
                    $totalPinjaman = ($dm->harga_jual - $dm->diskon) - $dp;



                    $totalCicilan = $this->showTotalCicilan($totalPinjaman, $bunga, 36);
                    $dm->total_cicilan = $totalCicilan;
                }
            }


            $data = [
                'dataApp' => $dataApp,
                'dataMobil' => $dataMobil,
                'dataMerk' => $dataMerk,
                'dataTransmisi' => $dataTransmisi,
                'dataBody' => $dataBody,
                'dataBahanBakar' => $dataBahanBakar,

            ];


            return view('client.cars.index', $data);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    function showTotalCicilan($totalPinjaman, $bunga, $bulan)
    {
        $emi = $totalPinjaman * ($bunga * pow((1 + $bunga), $bulan)) / (pow((1 + $bunga), $bulan) - 1);
        return $emi;
    }

    function detailMobilCLient($mobilId)
    {
        $mobilModel = new MobilModel();
        $mobilId = Crypt::decrypt($mobilId);

        try {
            $dataMobil = $mobilModel->getDetailMobilClient($mobilId);
            if ($dataMobil == null) {
                return redirect()->back()->with('failed', 'Mobil tidak tersedia');
            }
            $dataApp = AppModel::first();
            $dataFinance = FInanceModel::first();
            $dataAllFinance = FInanceModel::get();
            $dataReview  = ReviewModel::select(
                'review.review_text',
                'review.star',
                'review.image1',
                'review.image2',
                'review.created_at',
                'review.image3',
                'review.image4',
                'users.nama_lengkap',
                'users.sign_in',
                'users.profile_photo'
            )
                ->leftJoin('users', 'review.user_id', '=', 'users.user_id')
                ->where('review.mobil_id', $mobilId)
                ->where('review.status', 1)

                ->first();

            if ($dataFinance != null) {
                $persentaseBunga = $dataFinance['bunga'];
                $bunga = $persentaseBunga / 100;
                // bunga cicilan
                $persentaseBunga = $dataFinance['bunga'];
                $bunga = $persentaseBunga / 100;

                // dp
                $persentaseDp = $dataFinance['uang_muka'];
                $dp = ($dataMobil['harga_jual'] - $dataMobil['diskon']) * ($persentaseDp / 100);
                $totalPinjaman = ($dataMobil['harga_jual'] - $dataMobil['diskon']) - $dp;



                $totalCicilan = $this->showTotalCicilan($totalPinjaman, $bunga, 36);
                $dataMobil['total_cicilan'] = $totalCicilan;
            }


            $data = [
                'dataApp' => $dataApp,
                'dataMobil' => $dataMobil,
                'dataFinance' => $dataFinance,
                'dataReview' => $dataReview,
                'dataAllFinance' => $dataAllFinance
            ];

            return view('client.cars.car_detail', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Mobil tidak tersedia');
        }
    }
    function cariMobil(Request $request)
    {

        $mobilModel = new MobilModel();
        $keyword = $request->keyword;


        try {
            $dataApp = AppModel::where('app_id', 1)->first();
            $dataMerk = MerkModel::get();
            $dataTransmisi = TransmisiModel::get();
            $dataBody = BodyModel::get();
            // $dataBahanBakar = BahanBakarModel::get();
            $dataMobil = $mobilModel->searchCar($keyword)->paginate(9);
            $dataFinance = FInanceModel::first();

            if ($dataFinance != null) {
                foreach ($dataMobil as $dm) {

                    // bunga cicilan
                    $persentaseBunga = $dataFinance['bunga'];
                    $bunga = $persentaseBunga / 100;

                    // dp
                    $persentaseDp = $dataFinance['uang_muka'];
                    $dp = ($dm->harga_jual - $dm->diskon) * ($persentaseDp / 100);
                    $totalPinjaman = ($dm->harga_jual - $dm->diskon) - $dp;



                    $totalCicilan = $this->showTotalCicilan($totalPinjaman, $bunga, 36);
                    $dm->total_cicilan = $totalCicilan;
                }
            }


            $data = [
                'dataApp' => $dataApp,
                'dataMobil' => $dataMobil,
                'dataMerk' => $dataMerk,
                'dataTransmisi' => $dataTransmisi,
                'dataBody' => $dataBody,
                //'dataBahanBakar' => $dataBahanBakar,

            ];


            return view('client.cars.index', $data);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    function filterMobil(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'merkId' => 'required|numeric',
            'bodyId' => 'required|numeric',
            'transmisiId' => 'required|numeric',
            //'bahanBakarId' => 'required|numeric',
        ], [
            'required' => 'Terjadi kesalahan',
            'numeric' => 'Terjadi kesalahan'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        $mobilModel = new MobilModel();
        $merk = $request->merkId;
        $body = $request->bodyId;
        //$bahanBakarId = $request->bahanBakarId; //kiri penamaan biasa beba (buat isi line 1212) knan ambil name di view
        $transmisi = $request->transmisiId;
        $priceFrom = preg_replace('/[^0-9]/', '', $request->priceFrom);
        $priceEnd = preg_replace('/[^0-9]/', '', $request->priceEnd);


        try {
            $dataApp = AppModel::where('app_id', 1)->first();
            $dataMerk = MerkModel::get();
            $dataTransmisi = TransmisiModel::get();
            $dataBody = BodyModel::get();
            //$dataBahanBakar = BahanBakarModel::get();
            $dataMobil = $mobilModel->filterCar($merk, $body, $transmisi, $priceFrom, $priceEnd)->paginate(9); //tambah $bahanBakarId
            $dataFinance = FInanceModel::first();

            if ($dataFinance != null) {
                foreach ($dataMobil as $dm) {

                    // bunga cicilan
                    $persentaseBunga = $dataFinance['bunga'];
                    $bunga = $persentaseBunga / 100;

                    // dp
                    $persentaseDp = $dataFinance['uang_muka'];
                    $dp = ($dm->harga_jual - $dm->diskon) * ($persentaseDp / 100);
                    $totalPinjaman = ($dm->harga_jual - $dm->diskon) - $dp;



                    $totalCicilan = $this->showTotalCicilan($totalPinjaman, $bunga, 36);
                    $dm->total_cicilan = $totalCicilan;
                }
            }


            $data = [
                'dataApp' => $dataApp,
                'dataMobil' => $dataMobil,
                'dataMerk' => $dataMerk,
                'dataTransmisi' => $dataTransmisi,
                'dataBody' => $dataBody,
                //'dataBahanBakar' => $dataBahanBakar,


            ];


            return view('client.cars.index', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Tidak ada mobil yang sesuai');
        }
    }
}
