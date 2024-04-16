<?php

namespace App\Http\Controllers\api\client;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use App\Models\BahanBakarModel;
use App\Models\BodyModel;
use App\Models\CreditModel;
use App\Models\EmployeeModel;
use App\Models\FInanceModel;
use App\Models\KapasitasMesinModel;
use App\Models\KapasitasPenumpangModel;
use App\Models\MerkModel;
use App\Models\MobilModel;
use App\Models\OwnerModel;
use App\Models\PelangganModel;
use App\Models\ReviewModel;
use App\Models\TangkiModel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use App\Models\TransactionModel;
use App\Models\TransmisiModel;
use App\Models\WarnaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }


    function getAllFinance()
    {
        try {
            $dataFinance = FInanceModel::get();
            return response([
                'message' => 'success',
                'data' => $dataFinance
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'failed',

            ], 500);
        }
    }

    function detailFinance($financeId)
    {
        $dataFinance = FInanceModel::where('finance_id', $financeId)->first();
        if ($dataFinance == null) {
            return response([
                'message' => 'error',
            ], 404);
        }
        return response([
            'message' => 'success',
            'data' => $dataFinance
        ], 200);
    }
}
