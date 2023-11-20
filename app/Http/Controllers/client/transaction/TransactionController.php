<?php

namespace App\Http\Controllers\client\transaction;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\BankAccountModel;
use App\Models\MobilModel;
use Illuminate\Http\Request;

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
        try {
            $dataApp = AppModel::first();
            $dataBank = BankAccountModel::get();
            $mobilModel = new MobilModel();
            $dataMobil = $mobilModel->getDetailMobilClient($mobilId);
            $data = [
                'dataApp' => $dataApp,
                'bankAccount' => $dataBank,
                'dataMobil' => $dataMobil
            ];


            return view('client.transaction.create_transaction', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('Terjadi kesalahan');
        }
    }
}
