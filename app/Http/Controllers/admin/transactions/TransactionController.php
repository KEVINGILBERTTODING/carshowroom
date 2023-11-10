<?php

namespace App\Http\Controllers\admin\transactions;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\CreditModel;
use App\Models\FInanceModel;
use App\Models\MobilModel;
use App\Models\PelangganModel;
use App\Models\TransactionModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    function allTransactions()
    {

        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getAllTransactionByStatus(4);
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->where('status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'dataFinance' => $dataFinance
        ];

        return view('admin.transactions.all_transactions', $data);
    }

    function tambahTransaksi(Request $request)
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
                    'status_mobil' => 2, // process
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
                    return redirect()->back()->with('success', 'Berhasil menambahkan transaksi baru');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal menambahkan transaksi baru');
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
                    return redirect()->back()->with('success', 'Berhasil menambahkan transaksi baru');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal menambahkan transaksi baru');
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
                    'alasan' => 'Mohon maaf mobil yang Anda pesan telah dipesan oleh pelanggan lain, Terima kasih',
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
                    return redirect()->back()->with('success', 'Berhasil menambahkan transaksi baru');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal menambahkan transaksi baru');
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
                    return redirect()->back()->with('success', 'Berhasil menambahkan transaksi baru');
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return redirect()->back()->with('failed', 'Gagal menambahkan transaksi baru');
                }
            }
        }
    }

    function detailTransaction($transactionId)
    {
        $transaksiModel = new TransactionModel();
        $dataTransaction = $transaksiModel->adminDetailTransaction($transactionId);
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'dataTransaksi' => $dataTransaction
        ];

        return view('admin.transactions.detail_transaction', $data);
    }
}
