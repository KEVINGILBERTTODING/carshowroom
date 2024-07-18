<?php

namespace App\Http\Controllers\api\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\DetailMobil;
use App\Models\CreditModel;
use App\Models\EmployeeModel;
use App\Models\FInanceModel;
use App\Models\MobilModel;
use App\Models\NotificationModel;
use App\Models\OwnerModel;
use App\Models\PelangganModel;
use App\Models\TransactionModel;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;
use function PHPSTORM_META\type;

class TransactionController extends Controller
{
    function allTransactions($status)
    {


        try {
            $transactionModel = new TransactionModel();
            $dataTransactions = $transactionModel->getAllTransactionByStatus($status);

            $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
                ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
                ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
                ->where('detail_mobil.status_mobil', $status)->get();
            $dataFinance = FInanceModel::where('status', 1)->get();

            $data = [

                'dataTransactions' => $dataTransactions,
                'dataMobil' => $dataMobil,
                'dataFinance' => $dataFinance
            ];

            return response([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'status' => 'Server error'
            ], 500);
        }
    }

    function allTransactionSuccess()
    {

        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getAllTransactionByStatus(1);
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->where('detail_mobil.status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'dataFinance' => $dataFinance
        ];

        return view('admin.transactions.success_transaction', $data);
    }


    function allTransactionProcess()
    {

        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getAllTransactionByStatus(2);
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->where('detail_mobil.status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'dataFinance' => $dataFinance
        ];

        return view('admin.transactions.process_transaction', $data);
    }

    function allTransactionProcessFinance()
    {

        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getAllTransactionByStatus(3);
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->where('detail_mobil.status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'dataFinance' => $dataFinance
        ];

        return view('admin.transactions.process_finance', $data);
    }
    function allTransactionFailed()
    {

        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getAllTransactionByStatus(0);
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->where('detail_mobil.status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'dataFinance' => $dataFinance
        ];

        return view('admin.transactions.failed_transaction', $data);
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
            'biaya_pengiriman' => 'nullable|numeric'

        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute hanya boleh berupa angka',
            'string' => 'Kolom :attribute hanya boleh berupa huruf dan angka'
        ], [
            'mobil_id' => 'mobil',
            'nama_lengkap' => 'nama lengkap',
            'no_hp' => 'no Handphone',
            'alamat' => 'alamat',
            'payment_method' => 'metode pembayaran',
            'biaya_pengiriman' => 'Biaya pengiriman'
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
                    DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);

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
                    DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
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
                    DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);


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

                    DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);

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
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp,
            'dataTransaksi' => $dataTransaction
        ];

        return view('admin.transactions.detail_transaction', $data);
    }


    function downloadFile($type, $fileName)
    {
        if ($type == 'credit') {
            $path = public_path() . "/data/credit/" . $fileName;
        } else if ($type == 'evidence') {
            $path = public_path() . "/data/evidence/" . $fileName;
        } else if ($type == 'car') {
            $path = public_path() . "/data/cars/" . $fileName;
        }



        if (file_exists($path)) {
            // Determine the appropriate content type based on the file extension.
            $fileExtension = pathinfo($path, PATHINFO_EXTENSION);
            $contentType = $this->getContentType($fileExtension);

            if ($contentType) {
                // Set the content type header.


                $headers = [
                    'Content-Type: ' . $contentType,
                ];

                ob_end_clean();

                // Return the file for download.
                return response()->download($path, $fileName, $headers);
            }
        } else {
            return response([
                'message' => 'Server error'
            ], 500);
        }
    }

    function downloadBuktiPembayaran($fileName)
    {
        $path = public_path() . "/data/evidence/" . $fileName;


        if (file_exists($path)) {
            // Determine the appropriate content type based on the file extension.
            $fileExtension = pathinfo($path, PATHINFO_EXTENSION);
            $contentType = $this->getContentType($fileExtension);

            if ($contentType) {
                // Set the content type header.


                $headers = [
                    'Content-Type: ' . $contentType,
                ];

                ob_end_clean();

                // Return the file for download.
                return response()->download($path, $fileName, $headers);
            }
        } else {
            return abort(404);
        }
    }

    // Function to determine the content type based on the file extension.
    private function getContentType($fileExtension)
    {
        switch ($fileExtension) {
            case 'pdf':
                return 'application/pdf';
            case 'jpg':
            case 'png':
            case 'jpeg':
                return 'image/jpeg';
                // Add more cases for other file types if needed.
            default:
                return false; // Unknown file type.
        }
    }

    function updateStatusTransaksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric',
            'user_id' => 'required|numeric',
            'mobil_id' => 'required|numeric',
            'transaksi_id' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'Gagal mengubah status transaksi'
            ], 400);
        }

        // cek status transaksi
        if ($request->input('status') == 1) { // transaksi selesai
            $validatorongkir = Validator::make($request->all(), [
                'biaya_pengiriman' => 'required'
            ], [
                'biaya_pengiriman.required' => 'Biaya pengiriman tidak boleh kosong',
            ]);

            if ($validatorongkir->fails()) {
                return response([
                    'message' => $validatorongkir->errors()->first()
                ], 400);
            }

            $dataMobil = [
                'status_mobil' => 0,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $dataMainTransaksi = [
                'status' => 1,
                'biaya_pengiriman' => preg_replace('/[^0-9]/', '',  $request->input('biaya_pengiriman')),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')

            ];

            $dataOtherTransaksi = [
                'status' => 0,
                'alasan' => 'Mohon maaf mobil telah laku terjual, terima kasih',
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            // cek apakah transaksi user atau pelanggan
            if ($request->input('user_id') != 0) { // jika users

                $datNotif = [
                    'type' => 1,
                    'user_id' => $request->input('user_id'),
                    'transaksi_id' => $request->input('transaksi_id'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];


                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);
                        TransactionModel::where('mobil_id', $request->input('mobil_id'))
                            ->where('status', '<>', 0)
                            ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                            ->update($dataOtherTransaksi);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();

                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'failed', 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'failed', 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            } else {

                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        TransactionModel::where('mobil_id', $request->input('mobil_id'))
                            ->where('status', '<>', 0)
                            ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                            ->update($dataOtherTransaksi);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'failed', 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'failed', 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            }
        }



        if ($request->input('status') == 2) { // transaksi proses

            $dataMobil = [
                'status_mobil' => 2,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $dataMainTransaksi = [
                'status' => 2,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $dataOtherTransaksi = [
                'status' => 0,
                'alasan' => 'Mohon maaf mobil telah di pesan oleh pelanggan lain, terima kasih',
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            // cek apakah transaksi user atau pelanggan
            if ($request->input('user_id') != 0) { // jika users

                $datNotif = [
                    'type' => 2,
                    'user_id' => $request->input('user_id'),
                    'transaksi_id' => $request->input('transaksi_id'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];


                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);
                        TransactionModel::where('mobil_id', $request->input('mobil_id'))
                            ->where('status', '<>', 0)
                            ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                            ->update($dataOtherTransaksi);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            } else {

                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        TransactionModel::where('mobil_id', $request->input('mobil_id'))
                            ->where('status', '<>', 0)
                            ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                            ->update($dataOtherTransaksi);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            }
        }

        if ($request->input('status') == 3) { // proses finance

            $dataMobil = [
                'status_mobil' => 2,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $dataMainTransaksi = [
                'status' => 3,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $dataOtherTransaksi = [
                'status' => 0,
                'alasan' => 'Mohon maaf mobil telah di pesan oleh pelanggan lain, terima kasih',
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            // cek apakah transaksi user atau pelanggan
            if ($request->input('user_id') != 0) { // jika users

                $datNotif = [
                    'type' => 3,
                    'user_id' => $request->input('user_id'),
                    'transaksi_id' => $request->input('transaksi_id'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];


                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);
                        TransactionModel::where('mobil_id', $request->input('mobil_id'))
                            ->where('status', '<>', 0)
                            ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                            ->update($dataOtherTransaksi);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();

                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            } else {

                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        TransactionModel::where('mobil_id', $request->input('mobil_id'))
                            ->where('status', '<>', 0)
                            ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                            ->update($dataOtherTransaksi);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            }
        }

        if ($request->input('status') == 0) { // tidak valid

            $dataMobil = [
                'status_mobil' => 1,
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $dataMainTransaksi = [
                'status' => 0,
                'alasan' => $request->input('alasan'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];



            // cek apakah transaksi user atau pelanggan
            if ($request->input('user_id') != 0) { // jika users

                $datNotif = [
                    'type' => 0,
                    'user_id' => $request->input('user_id'),
                    'transaksi_id' => $request->input('transaksi_id'),
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];


                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);

                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        NotificationModel::insert($datNotif);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();

                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            } else {

                $checkTransaction = TransactionModel::where('mobil_id', $request->input('mobil_id'))
                    ->where('status', '<>', 0)
                    ->where('transaksi_id', '<>', $request->input('transaksi_id'))
                    ->first();
                // cek apa ada transaksi yang memilki mobil_id yang sama
                if ($checkTransaction != null) {
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);

                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                } else {
                    // jika transaksi tidak ada
                    DB::beginTransaction();
                    try {
                        DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
                        TransactionModel::where('transaksi_id', $request->input('transaksi_id'))->update($dataMainTransaksi);
                        DB::commit();
                        return response([
                            'message' => 'Berhasil mengubah status transaksi'
                        ], 200);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response([
                            'message' => 'Gagal mengubah status transaksi'
                        ], 400);
                    }
                }
            }
        }
    }

    function hapusTrasaksi($transaksiId, $paymentMethod)
    {

        if ($paymentMethod == 2) { // jika kredit
            DB::beginTransaction();
            try {
                TransactionModel::where('transaksi_id', $transaksiId)->delete();
                CreditModel::where('transaksi_id', $transaksiId)->delete();
                DB::commit();
                return response([
                    'message' => 'Berhasil menghapus data transaksi'
                ], 200);
            } catch (\Throwable $th) {
                return response([
                    'message' => 'Gagal menghapus data transaksi'
                ], 400);
            }
        } else {
            try {
                TransactionModel::where('transaksi_id', $transaksiId)->delete();
                return response([
                    'message' => 'Berhasil menghapus data transaksi'
                ], 200);
            } catch (\Throwable $th) {
                return response([
                    'message' => 'Gagal menghapus data transaksi'
                ], 400);
            }
        }
    }

    function filterTransaksi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric',
            'date_from' => 'required|date',
            'date_end' => 'required|date'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute tidak valid',
            'date' => 'Kolom :attribute tanggal tidak valid'
        ], [
            'status' => 'status transaksi',
            'date_from' => 'tanggal dari',
            'date_end' => 'tanggal akhir'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }
        $dateFrom = $request->input('date_from');
        $dateEnd = $request->input('date_end');
        $status = $request->input('status');

        try {

            $transactionModel = new TransactionModel();
            $dataTransactions = $transactionModel->filterTransaksi($dateFrom, $dateEnd, $status);
            if (!$dataTransactions->isEmpty()) {

                return response([
                    'message' => 'success',
                    'data' =>  $dataTransactions,
                ], 200);
            } else {
                return response([
                    'message' => 'Tidak ada transaksi',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => 'Server error',
            ], 500);
        }
    }

    function downloadReportPdf(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric',
            'date_from' => 'required|date',
            'date_end' => 'required|date',
            'role' => 'required|numeric',
            'user_id' => 'required|numeric'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute tidak valid',
            'date' => 'Kolom :attribute tanggal tidak valid'
        ], [
            'status' => 'status transaksi',
            'date_from' => 'tanggal dari',
            'role' => 'role',
            'user_id' => 'User',
            'date_end' => 'tanggal akhir'
        ]);

        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 400);
        }
        $dateFrom = $request->input('date_from');
        $dateEnd = $request->input('date_end');
        $status = $request->input('status');
        $role = $request->role;
        $userId = $request->user_id;
        try {
            if ($role == 2) { // admin
                $dataAdmin = Admin::where('admin_id', $userId)->first();
            } elseif ($role == 3) { // owner
                $dataAdmin = OwnerModel::where('owner_id', $userId)->first();
            } else { // karyawan
                $dataAdmin = EmployeeModel::where('karyawan_id', $userId)->first();
            }

            $dataApp = AppModel::where('app_id', 1)->first();
            $transactionModel = new TransactionModel();
            $dataTransactions = $transactionModel->filterTransaksi($dateFrom, $dateEnd, $status);
            $main_logo = public_path('data/app/img/' . $dataApp['logo']);
            if ($dataAdmin && !$dataTransactions->isEmpty()) {
                $data = [
                    'dataAdmin' => $dataAdmin,
                    'dataApp' => $dataApp,
                    'dataTransactions' => $dataTransactions,
                    'dateFrom' => $dateFrom,
                    'dateEnd' => $dateEnd,
                    'status' => $status,
                    'logo' => $main_logo,
                    'dateNow' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $pdf = FacadePdf::loadView('admin/transactions/report/report_transaction', $data);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Laporan_transaksi_' . $dateFrom . '-' . $dateEnd . '.pdf');
            } else {
                return response([
                    'message' => 'Error'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => 'Server error'
            ], 500);
        }
    }

    function downloadReportSuccessPdf(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric',
            'date_from' => 'required|date',
            'date_end' => 'required|date'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute tidak valid',
            'date' => 'Kolom :attribute tanggal tidak valid'
        ], [
            'status' => 'status transaksi',
            'date_from' => 'tanggal dari',
            'date_end' => 'tanggal akhir'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }
        $dateFrom = $request->input('date_from');
        $dateEnd = $request->input('date_end');
        $status = $request->input('status');
        try {
            if (session('role') == 'admin') {
                $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
            } elseif (session('role') == 'employee') {
                $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
            } else {
                $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
            }

            $dataApp = AppModel::where('app_id', 1)->first();
            $totalPemasukan = TransactionModel::where('status', 1)
                ->whereBetween('created_at', [$dateFrom, $dateEnd])
                ->sum('total_pembayaran');

            $transactionModel = new TransactionModel();
            $dataTransactions = $transactionModel->filterTransaksi($dateFrom, $dateEnd, $status);
            $totalKeuntungan = $transactionModel->totalProfitFilter($dateFrom, $dateEnd);
            $main_logo = public_path('data/app/img/' . $dataApp['logo']);
            if ($dataAdmin && !$dataTransactions->isEmpty()) {
                $data = [
                    'dataAdmin' => $dataAdmin,
                    'dataApp' => $dataApp,
                    'dataTransactions' => $dataTransactions,
                    'dateFrom' => $dateFrom,
                    'dateEnd' => $dateEnd,
                    'status' => $status,
                    'logo' => $main_logo,
                    'total_pemasukan' => $totalPemasukan,
                    'total_keuntungan' => $totalKeuntungan,
                    'dateNow' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $pdf = FacadePdf::loadView('admin/transactions/report/report_transaction_success', $data);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Laporan_transaksi_' . $dateFrom . '-' . $dateEnd . '.pdf');
            } else {
                return redirect()->back()->with('failed', 'Tidak ada data transaksi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function getDetailTransaksiUser($userId, $namaLengkap)
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $namaLengkap = $namaLengkap;
        $dataTransactions = $transactionModel->getTransactionByUser($userId);
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->where('detail_mobil.status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'dataFinance' => $dataFinance,
            'nama_lengkap' => $namaLengkap
        ];

        return view('admin.users.history_user_transaction', $data);
    }

    function getDetailTransaksiPelanggan($pelangganId, $namaLengkap)
    {
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getTransactionByPelanggan($pelangganId);
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->where('detail_mobil.status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'nama_lengkap' => $namaLengkap,
            'dataFinance' => $dataFinance
        ];

        return view('admin.users.history_pelanggan_transaction', $data);
    }

    function downloadReportTransactionMonth()
    {

        try {
            $yearNow = Carbon::now()->format('Y');
            $monthNow = Carbon::now()->format('m');
            if (session('role') == 'admin') {
                $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
            } elseif (session('role') == 'employee') {
                $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
            } else {
                $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
            }

            $dataApp = AppModel::where('app_id', 1)->first();
            $transactionModel = new TransactionModel();
            $dataTransactions = $transactionModel->getTransactionsMonth($yearNow, $monthNow);
            $main_logo = public_path('data/app/img/' . $dataApp['logo']);
            if ($dataAdmin && !$dataTransactions->isEmpty()) {
                $data = [
                    'dataAdmin' => $dataAdmin,
                    'dataApp' => $dataApp,
                    'dataTransactions' => $dataTransactions,
                    'logo' => $main_logo,
                    'dateNow' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $pdf = FacadePdf::loadView('admin/transactions/report/report_transaction_month', $data);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Laporan_transaksi_' . date('F_Y') . '.pdf');
            } else {
                return redirect()->back()->with('failed', 'Tidak ada data transaksi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function downloadReportProfit(Request $request)
    {


        try {
            $yearNow = Carbon::now()->format('Y');
            $dataAdmin = Admin::where('admin_id', $request->admin_id)->first();

            $dataApp = AppModel::where('app_id', 1)->first();
            $transactionModel = new TransactionModel();

            if ($request->is_filter == 1) {
                $dataPemasukanPerBulan = $transactionModel->totalPemasukanMonth($request->month);
                $dataKeuntunganPerBulan = $transactionModel->totalProfitMonth($request->month);

                $main_logo = public_path('data/app/img/' . $dataApp['logo']);

                $data = [
                    'dataAdmin' => $dataAdmin,
                    'dataApp' => $dataApp,
                    'month' => $request->month,
                    'dataPemasukan' => $dataPemasukanPerBulan,
                    'dataKeuntungan' => $dataKeuntunganPerBulan,
                    'logo' => $main_logo,
                    'dateNow' => Carbon::now()->format('Y-m-d H:i:s')
                ];


                $pdf = FacadePdf::loadView('admin.transactions.report.report_transaction_profit_month', $data);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('Laporan_pemasukan_keuntungan_' . $request->month . '.pdf');
            }

            // jika bukan filter
            $dataPemasukanPerTahun = $transactionModel->totalPemasukanYear($yearNow);
            $dataKeuntunganPerTahun = $transactionModel->totalKeuntunganYear($yearNow);

            $main_logo = public_path('data/app/img/' . $dataApp['logo']);

            $data = [
                'dataAdmin' => $dataAdmin,
                'dataApp' => $dataApp,
                'month' => $request->month,
                'dataPemasukan' => $dataPemasukanPerTahun,
                'dataKeuntungan' => $dataKeuntunganPerTahun,
                'logo' => $main_logo,
                'dateNow' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $pdf = FacadePdf::loadView('admin.transactions.report.report_transaction_profit', $data);
            $pdf->setPaper('A4', 'landscape');
            return $pdf->download('Laporan_pemasukan_keuntungan_' . now()->format('m-Y') . '.pdf');
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 500);
        }
    }

    function historyTransaction($userId)
    {
        $userId = Crypt::decrypt($userId);
        if (session('role') == 'admin') {
            $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        } elseif (session('role') == 'employee') {
            $dataAdmin = EmployeeModel::where('karyawan_id', session('karyawan_id'))->first();
        } else {
            $dataAdmin = OwnerModel::where('owner_id', session('owner_id'))->first();
        }

        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getClientAllTransactions($userId);
        $dataUser = User::select('users.user_id', 'users.nama_lengkap')->where('user_id', $userId)->first();
        $dataMobil = MobilModel::select('mobil.*', 'merk.merk', 'detail_mobil.*')
            ->join('merk', 'mobil.merk_id', '=', 'merk.merk_id')
            ->join('detail_mobil', 'mobil.mobil_id', '=', 'detail_mobil.mobil_id')
            ->where('detail_mobil.status_mobil', 1)->get();
        $dataFinance = FInanceModel::where('status', 1)->get();

        $data = [
            'dataApp' => $dataApp,
            'dataAdmin' => $dataAdmin,
            'dataTransactions' => $dataTransactions,
            'dataMobil' => $dataMobil,
            'dataFinance' => $dataFinance,
            'dataUser' => $dataUser
        ];

        return view('admin.users.history_user_transaction', $data);
    }
}
