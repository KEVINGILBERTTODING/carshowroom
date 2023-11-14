<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\BahanBakarModel;
use App\Models\BodyModel;
use App\Models\CreditModel;
use App\Models\FInanceModel;
use App\Models\KapasitasMesinModel;
use App\Models\KapasitasPenumpangModel;
use App\Models\MerkModel;
use App\Models\MobilModel;
use App\Models\PelangganModel;
use App\Models\TangkiModel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\TransactionModel;
use App\Models\TransmisiModel;
use App\Models\WarnaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function tambahMobil()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMerk = MerkModel::get();
        $dataBody = BodyModel::get();
        $dataWarna = WarnaModel::get();
        $dataKapasitasMesin = KapasitasMesinModel::get();
        $dataBahanBakar = BahanBakarModel::get();
        $dataTransmisi  = TransmisiModel::get();
        $dataKapasitasPenumpang = KapasitasPenumpangModel::get();
        $dataTangki = TangkiModel::get();

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
            'dataTangki' => $dataTangki
        ];
        return view('admin.car.add_car', $data);
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
            'harga_beli' => 'required|numeric',
            'biaya_perbaikan' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'tanggal_masuk' => 'nullable',
            'deskripsi' => 'required|string',
            'url_youtube' => 'required|string'
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
            'url_youtube' => 'Link Youtube'
        ]);

        if ($validatorData->fails()) {
            return redirect()->back()->with('failed', $validatorData->errors()->first())->withInput();
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
            return redirect()->back()->with('failed', $validator->errors()->first())->withInput();
        }


        // // Proses penyimpanan gambar
        for ($i = 1; $i <= 6; $i++) {
            $field = 'gambar' . $i;

            if ($request->hasFile($field)) {
                $fileGambar = $request->file($field);
                $fileName = $field . '_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileGambar->getClientOriginalExtension();
                $fileGambar->move('data/cars', $fileName);
                $data[$field] = $fileName;
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
        $data['km'] = $request->input('km');
        $data['nama_pemilik'] = $request->input('nama_pemilik');
        $data['tangki_id'] = $request->input('tangki_id');
        $data['harga_beli'] = $request->input('harga_beli');
        $data['biaya_perbaikan'] = $request->input('biaya_perbaikan');
        $data['harga_jual'] = $request->input('harga_jual');
        $data['tgl_masuk'] = $request->input('tanggal_masuk');
        $data['diskon'] = $request->input('diskon');
        $data['deskripsi'] = $request->input('deskripsi');
        $data['url_youtube'] = $request->input('url_youtube');
        $data['created_at'] = date('Y-m-d H:i:s');

        try {
            $insertMobil = MobilModel::insert($data);
            if ($insertMobil) {
                return redirect()->back()->with('success', 'Berhasil menambahkan mobil baru');
            } else {
                return redirect()->back()->with('failed', 'Gagal menambahkan mobil baru')->withInput();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput();
        }
    }

    function seluruhMobil()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $dataMobil = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->select('mobil.*', 'merk.merk')
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
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
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
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
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
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
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
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
        try {
            $delete = MobilModel::where('mobil_id', $mobilId)->delete();
            if ($delete) {
                return redirect()->back()->with('success', 'Berhasil menghapus data mobil');
            } else {
                return redirect()->back()->with('failed', 'Gagal menghapus data mobil');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function ajaxGetDetailMobil($mobilId)
    {
        $data = MobilModel::where('mobil_id', $mobilId)->first();
        return response()->json($data);
    }

    function adminDetailMobil($mobil_id)
    {
        $mobilModel = new MobilModel();
        $dataMobil = $mobilModel->getDetailMobil($mobil_id);
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataMobil' => $dataMobil
        ];

        return view('admin.car.detail_mobil', $data);
    }

    function ubahMobil($mobil_id)
    {
        $mobilModel = new MobilModel();
        $detailMobil = $mobilModel->getDetailMobil($mobil_id);
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
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
            'harga_beli' => 'required|numeric',
            'biaya_perbaikan' => 'required|numeric',
            'harga_jual' => 'required|numeric',
            'tanggal_masuk' => 'nullable',
            'deskripsi' => 'required|string',
            'url_youtube' => 'required|string'
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
            return redirect()->back()->with('failed', $validatorData->errors()->first())->withInput();
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
            return redirect()->back()->with('failed', $validator->errors()->first())->withInput();
        }


        // // Proses penyimpanan gambar
        for ($i = 1; $i <= 6; $i++) {
            $field = 'gambar' . $i;

            if ($request->hasFile($field)) {
                $fileGambar = $request->file($field);
                $fileName = $field . '_' . Carbon::now()->format('Y-m-d-H-i-s') . '.' . $fileGambar->getClientOriginalExtension();
                $fileGambar->move('data/cars', $fileName);
                $data[$field] = $fileName;
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
        $data['km'] = $request->input('km');
        $data['nama_pemilik'] = $request->input('nama_pemilik');
        $data['tangki_id'] = $request->input('tangki_id');
        $data['harga_beli'] = $request->input('harga_beli');
        $data['biaya_perbaikan'] = $request->input('biaya_perbaikan');
        $data['harga_jual'] = $request->input('harga_jual');
        $data['tgl_masuk'] = $request->input('tanggal_masuk');
        $data['diskon'] = $request->input('diskon');
        $data['deskripsi'] = $request->input('deskripsi');
        $data['url_youtube'] = $request->input('url_youtube');
        $data['updated_at'] = date('Y-m-d H:i:s');

        try {
            $updateMobil = MobilModel::where('mobil_id', $request->input('mobil_id'))->update($data);
            if ($updateMobil) {
                return redirect()->back()->with('success', 'Berhasil mengubah data mobil ');
            } else {
                return redirect()->back()->with('failed', 'Gagal mengubah data mobil ')->withInput();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage())->withInput();
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

                $validatorFileCredit = Validator::make($request->all(), $rules, $messages);
                if ($validatorFileCredit->fails()) {
                    return redirect()->back()->with('failed', $validator->errors()->first());
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

                $validatorFileCredit = Validator::make($request->all(), $rules, $messages);
                if ($validatorFileCredit->fails()) {
                    return redirect()->back()->with('failed', $validator->errors()->first());
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

    function downloadReportCars($status)
    {

        try {

            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
            $dataApp = AppModel::where('app_id', 1)->first();
            if ($status == 3) { // semua mobil
                $dataMobil  = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                    ->select('mobil.*', 'merk.merk')
                    ->orderBy('mobil.mobil_id', 'desc')
                    ->get();
            } else {
                $dataMobil  = MobilModel::join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                    ->select('mobil.*', 'merk.merk')
                    ->where('mobil.status_mobil', $status)
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
                return redirect()->back()->with('failed', 'Tidak ada data mobil');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
