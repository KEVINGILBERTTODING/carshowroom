<?php

namespace App\Http\Controllers\client\main;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\FInanceModel;
use App\Models\ReviewModel;
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
        $dataReview  = ReviewModel::select(
            'review.review_text',
            'review.star',
            'review.image1',
            'review.image2',
            'review.created_at',
            'review.image3',
            'review.image4',
            'users.nama_lengkap',
            'users.profile_photo'
        )
            ->leftJoin('users', 'review.user_id', '=', 'users.user_id')
            ->where('review.status', 1)
            ->orderBy('review.review_id', 'desc')
            ->limit(10)
            ->get();

        $data = [
            'dataApp' => $dataApp,
            'dataReview' => $dataReview
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

    function review()
    {
        try {
            $dataApp =  AppModel::where('app_id', 1)->first();
            $dataReview  = ReviewModel::select(
                'review.review_text',
                'review.star',
                'review.image1',
                'review.image2',
                'review.created_at',
                'review.image3',
                'review.image4',
                'users.nama_lengkap',
                'users.profile_photo'
            )
                ->leftJoin('users', 'review.user_id', '=', 'users.user_id')
                ->where('review.status', 1)
                ->orderBy('review.review_id', 'desc')
                ->limit(10)
                ->get();

            $data = [
                'dataApp' => $dataApp,
                'dataReview' => $dataReview
            ];
            return view('client.review.review', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function userGuide()
    {

        try {
            $datApp = AppModel::first();
            $data = [
                'dataApp' => $datApp
            ];

            return view('client.guide.guide', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
