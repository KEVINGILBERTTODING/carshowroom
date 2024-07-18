<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Models\AdminNotificationModel;
use App\Models\AppModel;
use App\Models\BankAccountModel;
use App\Models\CreditModel;
use App\Models\FInanceModel;
use App\Models\DetailMobil;

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

    function getAllBankAcc()
    {
        try {
            $bankAcc = BankAccountModel::get();
            return response([
                'message' => 'success',
                'data' => $bankAcc
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Terjadi kesalahan',

            ], 500);
        }
    }

    function insertTransaction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evidence' => 'required|mimes:png,jpg,jpeg|max:5000',
            'mobil_id' => 'required|numeric',

            'total_pembayaran' => 'required|numeric',


        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'numeric' => 'Kolom :attribute hanya boleh berupa angka',
            'string' => 'Kolom :attribute hanya boleh berupa huruf dan angka',
            'mimes' => ':attribute memiliki format yang tidak valid',
            'max' => ':attribute tidak boleh lebih dari 5 MB'
        ], [
            'mobil_id' => 'mobil',

            'evidence' => 'Bukti pembayaran'
        ]);
        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 404);
        }

        $userId = $request->user_id;

        $transaksiId = 'TRX-USR-' . $userId . '-' . Carbon::now()->format('Y-m-d-H-i-s');

        if ($request->hasFile('evidence')) {
            $fileEvidence = $request->file('evidence');
            $fileNameEvidence = 'EVD-' . $transaksiId . '.' . $fileEvidence->getClientOriginalExtension();
            $fileEvidence->move('data/evidence', $fileNameEvidence);
        }





        $dataTransaksi = [
            'transaksi_id' => $transaksiId,
            'mobil_id' => $request->input('mobil_id'),
            'user_id' => $userId,
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

            TransactionModel::insert($dataTransaksi);
            AdminNotificationModel::insert($dataNotifAdmin);
            DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
            DB::commit();

            return response([
                'message' => 'success'

            ], 200);
            return redirect()->route('detailTransaksi', Crypt::encrypt($transaksiId))->with('success', 'Transaksi anda sedang kami proses, anda akan menerima notifikasi jika proses pengecekan telah selesai.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return response([
                'message' => 'Terjadi kesalahan server'

            ], 500);
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
            'user_id' => 'required',
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
            'user_id' => 'Pengguna',
            'total_pembayaran' => 'Total Pembayaran'
        ]);
        if ($validator->fails()) {
            return response([
                'message' =>  $validator->errors()->first()
            ], 400);
        }

        // cek ketersediaan mobil
        $checkMobil = MobilModel::where('mobil_id', $request->input('mobil_id'))->first();
        $checkDetailMobil = DetailMobil::where('mobil_id', $request->mobil_id)->first();
        if ($checkMobil && $checkDetailMobil['status_mobil'] != 1) {
            return response([
                'message' =>  'Mobil tidak tersedia'
            ], 400);
        }


        // validasi inputan file kredit
        if (!$request->hasFile('ktp_suami') && !$request->hasFile('ktp_istri')) {
            return response([
                'message' =>  'File KTP tidak boleh kosong'
            ], 400);
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

            return response([
                'message' =>  $validatorFileCredit->errors()->first()
            ], 400);
        }

        $userId = $request->user_id;

        $transaksiId = 'TRX-USR-' . $userId . '-' . Carbon::now()->format('Y-m-d-H-i-s');

        // upload file kredit
        if ($request->hasFile('ktp_suami')) {
            $fileKtpSuami = $request->file('ktp_suami');
            $fileName = 'KTP-suami-' . $userId . '-' . Carbon::now()->format('Y-m-d-H-i-s') .  '.' . $fileKtpSuami->getClientOriginalExtension();
            $fileKtpSuami->move('data/credit', $fileName);
            $dataKredit['ktp_suami'] = $fileName;
        }

        if ($request->hasFile('ktp_istri')) {
            $fileKtpIstri = $request->file('ktp_istri');
            $fileNameIstri = 'KTP-istri-' . $userId . '-' . Carbon::now()->format('Y-m-d-H-i-s') .  '.' . $fileKtpIstri->getClientOriginalExtension();
            $fileKtpIstri->move('data/credit', $fileNameIstri);
            $dataKredit['ktp_istri'] = $fileNameIstri;
        }

        if ($request->hasFile('kk')) {
            $fileKk = $request->file('kk');
            $fileNameKk = 'KK-' . $userId . '-' . Carbon::now()->format('Y-m-d-H-i-s') .  '.' . $fileKk->getClientOriginalExtension();
            $fileKk->move('data/credit', $fileNameKk);
            $dataKredit['kk'] = $fileNameKk;
        }

        $dataTransaksi = [
            'transaksi_id' => $transaksiId,
            'mobil_id' => $request->input('mobil_id'),
            'user_id' => $userId,
            'payment_method' => 2,
            'total_pembayaran' => $request->input('total_pembayaran'),
            'status' => 2,
            'created_at' => date('Y-m-d H:i:s')
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
            DetailMobil::where('mobil_id', $request->input('mobil_id'))->update($dataMobil);
            NotificationAdminModel::insert($dataNotifAdmin);

            DB::commit();

            return response([
                'message' => 'Selamat, pengajuan kredit Anda sedang dalam proses kami. Mohon bersabar, kami akan memberikan update paling lambat dalam 7 hari kerja.'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response([
                'message' =>  $th->getMessage()
            ], 500);
        }
    }

    function getHistoryTransaction($userId, $status)
    {

        $transactionModel = new TransactionModel();
        $dataTransactions = $transactionModel->getClientTransactionStatus($status, $userId);
        try {
            if ($dataTransactions) {
                return response([
                    'message' => 'success',
                    'data' => $dataTransactions
                ], 200);
            } else {
                return response([
                    'message' => 'error',
                ], 404);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => 'Server error',
            ], 500);
        }
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

        try {
            $transaksiModel = new TransactionModel();
            $dataTransaction = $transaksiModel->clientDetailTransaction($transactionId);


            if ($dataTransaction['review_id'] == null) {
                $dataTransaction['review_id'] = 'undefined';
            }
            return response([
                'message' => 'success',
                'data' => $dataTransaction
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Terjadi kesalahan server',
            ], 500);
        }
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
