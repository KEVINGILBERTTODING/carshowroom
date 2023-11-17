<?php

namespace App\Http\Controllers\client\main;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\FInanceModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    function index()
    {
        if (session('login') == true && session('role') == 'admin') {
            return redirect()->route('adminDashboard');
        }

        $dataApp =  AppModel::where('app_id', 1)->first();
        $data = [
            'dataApp' => $dataApp
        ];
        return view('client.main.index', $data);
    }

    function finance()
    {

        try {
            $dataApp =  AppModel::where('app_id', 1)->first();
            $dataFinance = FInanceModel::where('status', 1)->get();
            $data = [
                'dataApp' => $dataApp,
                'dataFinance' => $dataFinance
            ];
            return view('client.finance.finance', $data);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }

    function detailFinance($financeId)
    {
        $financeId = Crypt::decrypt($financeId);
        $dataApp =  AppModel::where('app_id', 1)->first();
        $dataFinance = FInanceModel::where('finance_id', $financeId)->first();
        if ($dataFinance == null) {
            return redirect()->route('dataFinance');
        }
        $data = [
            'dataApp' => $dataApp,
            'dataFinance' => $dataFinance
        ];
        return view('client.finance.detail_finance', $data);
    }


    function aboutUs()
    {
        $dataApp =  AppModel::where('app_id', 1)->first();
        $data = [
            'dataApp' => $dataApp
        ];
        return view('client.about.about', $data);
    }
}
