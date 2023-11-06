<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\BahanBakarModel;
use App\Models\BodyModel;
use App\Models\KapasitasMesinModel;
use App\Models\KapasitasPenumpangModel;
use App\Models\MerkModel;
use App\Models\MobilModel;
use App\Models\TangkiModel;
use App\Models\TransmisiModel;
use App\Models\WarnaModel;
use Illuminate\Http\Request;
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
                $fileName = $field . '_' . time() . '.' . $fileGambar->getClientOriginalExtension();
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
}
