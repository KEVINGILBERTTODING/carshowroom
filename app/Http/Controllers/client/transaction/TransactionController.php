<?php

namespace App\Http\Controllers\client\transaction;

use App\Http\Controllers\Controller;
use App\Models\AdminNotificationModel;
use App\Models\AppModel;
use App\Models\BankAccountModel;
use App\Models\FInanceModel;
use App\Models\MobilModel;
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
            'mimes' => ':attribute tidak boleh kosong',
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
            return redirect()->route('mobil')->with('success', 'Selamat transaksi Anda sedang kami proses');
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
}
