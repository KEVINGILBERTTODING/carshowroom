<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\FInanceModel;
use App\Models\MobilModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CreditController extends Controller
{
    function credit($mobilId, $financeId)
    {

        try {

            $mobilModel = new MobilModel();
            $dataMobil = $mobilModel->getDetailMobilClient($mobilId);
            $dataFinance = FInanceModel::where('finance_id', $financeId)->first();



            // Cek apakah mobil masih tersedia
            if ($dataMobil == null || $dataMobil['status_mobil'] != 1) {
                return response([
                    'message' => 'Mobil tidak tersedia'
                ], 404);
            }

            // cek finance apa tersedia
            if ($dataFinance == null || $dataFinance['status'] != 1) {
                return response([
                    'message' => 'Finance tidak tersedia'
                ], 404);
            }



            // dp Min
            $persentaseDpMin = $dataFinance['uang_muka'];
            $dpMin = ($dataMobil['harga_jual'] - $dataMobil['diskon']) * ($persentaseDpMin / 100);

            // dpmax
            $persentaseDpMax = 50;
            $dpMax = ($dataMobil['harga_jual'] - $dataMobil['diskon']) * ($persentaseDpMax / 100);




            $data = [


                'totalMinDp' => $dpMin,
                'totalMaxDp' => $dpMax
            ];

            return response([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Server Error'
            ], 500);
        }
    }

    function showTotalCicilan($totalPinjaman, $bunga, $bulan)
    {
        $emi = $totalPinjaman * ($bunga * pow((1 + $bunga), $bulan)) / (pow((1 + $bunga), $bulan) - 1);
        return $emi;
    }

    function countCredit(Request $request)
    {
        $financeId = $request->input('finance_id');
        $totalPembayaran = $request->input('total_pembayaran');
        $totalDp = $request->input('total_dp');
        $durasiPinjaman = $request->input('durasi');

        try {
            $dataFinance = FInanceModel::where('finance_id', $financeId)->first();
            $totalTagihan = $totalPembayaran - $totalDp;
            // hitung total biaya admin
            $persenAdmin = $dataFinance['biaya_administrasi'];
            $biayaAdmin = $totalTagihan  * ($persenAdmin / 100);

            // hitung total biaya asuransi
            $persenAsuransi = $dataFinance['biaya_asuransi'];
            $biayaAsuransi = $totalTagihan  * ($persenAsuransi / 100);

            // hitung total biaya provisi
            $persenProvisi = $dataFinance['biaya_provisi'];
            $biayaProvisi = $totalTagihan  * ($persenProvisi / 100);

            // hitung total bunga
            $persentaseBunga = $dataFinance['bunga'];
            $bunga = $persentaseBunga / 100;

            // hitung total cicilan perbulan
            $totalCicilan = $this->showTotalCicilan($totalTagihan, $bunga, $durasiPinjaman);

            $data = [
                'biaya_admin' => $biayaAdmin,
                'biaya_asuransi' => $biayaAsuransi,
                'biaya_provisi' => $biayaProvisi,
                'totalCicilan' => $totalCicilan
            ];
            return response([
                'message' => 'success',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'error',

            ], 500);
        }
    }
}
