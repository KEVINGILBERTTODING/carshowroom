<?php

namespace App\Http\Controllers\client\invoice;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\TransactionModel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    function download($transactionId)
    {
        try {


            $dataApp = AppModel::latest()->first();
            $main_logo = public_path('data/app/img/' . $dataApp['logo']);
            $imgStempel = public_path('data/stempel/' . $dataApp['img_stempel']);
            $transaksiModel = new TransactionModel();
            $dataTransaction = $transaksiModel->clientDetailTransaction($transactionId);

            if ($dataTransaction != null) {
                $data = [

                    'dataApp' => $dataApp,
                    'logo' => $main_logo,
                    'imgStempel' => $imgStempel,
                    'dataTransaksi' => $dataTransaction,
                    'dateNow' => Carbon::now()->format('Y-m-d H:i:s')
                ];
                // return view('client.dashboard.invoice.invoice', $data);

                $pdf = FacadePdf::loadView('client.dashboard.invoice.invoice', $data);
                $pdf->setPaper('A4', 'potrait');

                return $pdf->download('Invoice_' . date('F_Y') . '.pdf');
            } else {
                return redirect()->back()->with('failed', 'Tidak ada data mobil');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }
}
