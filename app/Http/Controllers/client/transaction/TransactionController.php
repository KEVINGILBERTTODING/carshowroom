<?php

namespace App\Http\Controllers\client\transaction;

use App\Http\Controllers\Controller;
use App\Models\AdminNotificationModel;
use App\Models\AppModel;
use App\Models\BankAccountModel;
use App\Models\CreditModel;
use App\Models\FInanceModel;
use App\Models\MobilModel;
use App\Models\NotificationAdminModel;
use App\Models\TransactionModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    function createNewTransaction($mobilId)
    {
        if (session('client') != true) {
            return redirect()->route('/')->with('failed', 'Anda harus login terlebih dahulu');
        }
        if ($mobilId == 0) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan.');
        }
        $mobilId = Crypt::decrypt($mobilId);
        try {
            $dataApp = AppModel::first();
            $dataBank = BankAccountModel::get();
            $mobilModel = new MobilModel();
            $dataUser = User::where('user_id', session('user_id'))->first();
            $dataMobil = $mobilModel->getDetailMobilClient($mobilId);

            // validasi apakah mobil masih tersedia
            if ($dataMobil['status_mobil'] != 1) {
                return redirect()->route('mobil')->with('failed', 'Terjadi kesalahan');
            }



            $data = [
                'dataApp' => $dataApp,
                'bankAccount' => $dataBank,
                'dataMobil' => $dataMobil,
                'dataUser' => $dataUser,
            ];


            return view('client.transaction.create_transaction', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function getBankAccountById($bankId)
    {
        try {
            $data = BankAccountModel::where('bank_id', $bankId)->first();
            return response([
                'status' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'status' => 'failed',

            ], 500);
        }
    }

    function insertTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evidence' => 'required|mimes:png,jpg,jpeg|max:5000',
            'mobil_id' => 'required|numeric',
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|string',
            'total_pembayaran' => 'required|numeric',


        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute hanya boleh berupa angka',
            'string' => 'Kolom :attribute hanya boleh berupa huruf dan angka',
            'mimes' => ':attribute memiliki format yang tidak valid',
            'max' => ':attribute tidak boleh lebih dari 5 MB'
        ], [
            'mobil_id' => 'mobil',
            'nama_lengkap' => 'nama lengkap',
            'no_hp' => 'no Handphone',
            'alamat' => 'alamat',
            'evidence' => 'Bukti pembayaran'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first())->withInput();
        }

        $transaksiId = 'TRX-USR-' . session('user_id') . '-' . Carbon::now()->format('Y-m-d-H-i-s');

        if ($request->hasFile('evidence')) {
            $fileEvidence = $request->file('evidence');
            $fileNameEvidence = 'EVD-' . $transaksiId . '.' . $fileEvidence->getClientOriginalExtension();
            $fileEvidence->move('data/evidence', $fileNameEvidence);
        }

        $dataUsers = [

            'nama_lengkap' => $request->input('nama_lengkap'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $dataTransaksi = [
            'transaksi_id' => $transaksiId,
            'mobil_id' => $request->input('mobil_id'),
            'user_id' => session('user_id'),
            'payment_method' => 3,
            'total_pembayaran' => $request->input('total_pembayaran'),
            'status' => 2,
            'bukti_pembayaran' => $fileNameEvidence,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dataMobil = [
            'status_mobil' => 2,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $dataNotifAdmin = [
            'transaksi_id' => $transaksiId,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        DB::beginTransaction();
        try {
            User::where('user_id', session('user_id'))->update($dataUsers);
            TransactionModel::insert($dataTransaksi);
            AdminNotificationModel::insert($dataNotifAdmin);
            MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
            DB::commit();
            return redirect()->route('detailTransaksi', Crypt::encrypt($transaksiId))->with('success', 'Transaksi anda sedang kami proses, anda akan menerima notifikasi jika proses pengecekan telah selesai.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('failed', 'Terjadi kesalahan')->withInput();
        }
    }

    function pengajuanKredit($mobilId, $financeId)
    {
        if (session('client') != true) {
            return redirect()->route('/')->with('failed', 'Anda harus login terlebih dahulu');
        }

        if ($mobilId == 0 || $financeId == 0) {
            return redirect()->route('/')->with('failed', 'Terjadi kesalahan');
        }

        $mobilId = Crypt::decrypt($mobilId);
        $financeId = Crypt::decrypt($financeId);
        try {
            $dataApp = AppModel::first();

            $mobilModel = new MobilModel();
            $dataFinance = FInanceModel::where('finance_id', $financeId)->first();
            $dataUser = User::where('user_id', session('user_id'))->first();
            $dataMobil = $mobilModel->getDetailMobilClient($mobilId);

            // validasi apakah mobil masih tersedia
            if ($dataMobil['status_mobil'] != 1) {
                return redirect()->route('mobil')->with('failed', 'Terjadi kesalahan');
            }

            $data = [
                'dataApp' => $dataApp,
                'dataMobil' => $dataMobil,
                'dataUser' => $dataUser,
                'dataFinance' => $dataFinance
            ];

            return view('client.transaction.create_credit', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function insertPengajuanKredit(Request $request)
    {
        $rules = [];
        $messages = [];
        $dataKredit = [];

        $validator = Validator::make($request->all(), [
            'kk' => 'required|mimes:png,jpg,jpeg|max:3000',
            'mobil_id' => 'required|numeric',
            'finance_id' => 'required|numeric',
            'nama_lengkap' => 'required|string',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|string',
            'total_pembayaran' => 'required|numeric',


        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute hanya boleh berupa angka',
            'string' => 'Kolom :attribute hanya boleh berupa huruf dan angka',
            'mimes' => ':attribute memiliki format yang tidak valid',
            'max' => ':attribute tidak boleh lebih dari 3 MB'
        ], [
            'mobil_id' => 'Mobil',
            'finance_id' => 'Finance',
            'kk' => 'Kartu Keluarga',
            'nama_lengkap' => 'Nama Lengkap',
            'no_hp' => 'No Handphone',
            'alamat' => 'Alamat',
            'total_pembayaran' => 'Total Pembayaran'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first())->withInput();
        }

        // cek ketersediaan mobil
        $checkMobil = MobilModel::where('mobil_id', $request->input('mobil_id'))->first();
        if ($checkMobil && $checkMobil['status_mobil'] != 1) {
            return redirect()->route('mobil')->with('failed', 'Mobil tidak tersedia');
        }


        // validasi inputan file kredit
        if (!$request->hasFile('ktp_suami') && !$request->hasFile('ktp_istri')) {
            return redirect()->back()->withInput()->with('failed', 'File KTP tidak boleh kosong');
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


        $validatorFileCredit = Validator::make($request->all(), $rules, $messages);
        if ($validatorFileCredit->fails()) {
            return redirect()->back()->with('failed', $validatorFileCredit->errors()->first());
        }


        $transaksiId = 'TRX-USR-' . session('user_id') . '-' . Carbon::now()->format('Y-m-d-H-i-s');

        // upload file kredit
        if ($request->hasFile('ktp_suami')) {
            $fileKtpSuami = $request->file('ktp_suami');
            $fileName = 'KTP-suami-' . session('user_id') . '-' . Carbon::now()->format('Y-m-d-H-i-s') .  '.' . $fileKtpSuami->getClientOriginalExtension();
            $fileKtpSuami->move('data/credit', $fileName);
            $dataKredit['ktp_suami'] = $fileName;
        }

        if ($request->hasFile('ktp_istri')) {
            $fileKtpIstri = $request->file('ktp_istri');
            $fileNameIstri = 'KTP-istri-' . session('user_id') . '-' . Carbon::now()->format('Y-m-d-H-i-s') .  '.' . $fileKtpIstri->getClientOriginalExtension();
            $fileKtpIstri->move('data/credit', $fileNameIstri);
            $dataKredit['ktp_istri'] = $fileNameIstri;
        }

        if ($request->hasFile('kk')) {
            $fileKk = $request->file('kk');
            $fileNameKk = 'KK-' . session('user_id') . '-' . Carbon::now()->format('Y-m-d-H-i-s') .  '.' . $fileKk->getClientOriginalExtension();
            $fileKk->move('data/credit', $fileNameKk);
            $dataKredit['kk'] = $fileNameKk;
        }

        $dataTransaksi = [
            'transaksi_id' => $transaksiId,
            'mobil_id' => $request->input('mobil_id'),
            'user_id' => session('user_id'),
            'payment_method' => 2,
            'total_pembayaran' => $request->input('total_pembayaran'),
            'status' => 2,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $dataUser = [
            'nama_lengkap' => $request->input('nama_lengkap'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
        ];

        $dataMobil = [
            'status_mobil' => 2, // process
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $dataNotifAdmin = [
            'transaksi_id' => $transaksiId,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        // data Kredit
        $dataKredit['transaksi_id'] = $transaksiId;
        $dataKredit['finance_id'] = $request->input('finance_id');
        $dataKredit['created_at'] = date('Y-m-d H:i:s');

        DB::beginTransaction();
        try {
            TransactionModel::insert($dataTransaksi);
            CreditModel::insert($dataKredit);
            MobilModel::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
            NotificationAdminModel::insert($dataNotifAdmin);
            User::where('user_id', session('user_id'))->update($dataUser);
            DB::commit();
            return redirect()->route('detailTransaksi', Crypt::encrypt($transaksiId))->with('success', 'Selamat, pengajuan kredit Anda sedang dalam proses kami. Mohon bersabar, kami akan memberikan update paling lambat dalam 7 hari kerja.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function getTransactionSuccess()
    {

        $dataUser = User::where('user_id', session('user_id'))->first();
        $transactionModel = new TransactionModel();
        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getClientTransactionStatus(1, session('user_id'));

        $data = [
            'dataApp' => $dataApp,
            'dataUser' => $dataUser,
            'dataTransactions' => $dataTransactions,

        ];

        return view('client.dashboard.transaction.success_transaction', $data);
    }

    function getTransactionProcess()
    {

        $dataUser = User::where('user_id', session('user_id'))->first();
        $transactionModel = new TransactionModel();
        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getClientTransactionStatus(2, session('user_id'));

        $data = [
            'dataApp' => $dataApp,
            'dataUser' => $dataUser,
            'dataTransactions' => $dataTransactions,

        ];

        return view('client.dashboard.transaction.process_transaction', $data);
    }

    function getTransactionProcessFinance()
    {

        $dataUser = User::where('user_id', session('user_id'))->first();
        $transactionModel = new TransactionModel();
        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getClientTransactionStatus(3, session('user_id'));

        $data = [
            'dataApp' => $dataApp,
            'dataUser' => $dataUser,
            'dataTransactions' => $dataTransactions,

        ];

        return view('client.dashboard.transaction.process_finance_transaction', $data);
    }

    function getTransactionFailed()
    {

        $dataUser = User::where('user_id', session('user_id'))->first();
        $transactionModel = new TransactionModel();
        $dataApp = AppModel::where('app_id', 1)->first();
        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getClientTransactionStatus(0, session('user_id'));

        $data = [
            'dataApp' => $dataApp,
            'dataUser' => $dataUser,
            'dataTransactions' => $dataTransactions,

        ];

        return view('client.dashboard.transaction.failed_transactions', $data);
    }

    function detailTransaction($transactionId)
    {
        $transactionId = Crypt::decrypt($transactionId);
        $transaksiModel = new TransactionModel();
        $dataTransaction = $transaksiModel->clientDetailTransaction($transactionId);
        $dataUser = User::where('user_id', session('user_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();

        if ($dataTransaction['review_id'] == null) {
            $dataTransaction['review_id'] = 'undefined';
        }
        $data = [
            'dataUser' => $dataUser,
            'dataApp' => $dataApp,
            'dataTransaksi' => $dataTransaction
        ];

        return view('client.dashboard.transaction.detail_transaction', $data);
    }
    function downloadFileCredit($fileName)
    {
        $path = public_path() . "/data/credit/" . $fileName;


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
}
