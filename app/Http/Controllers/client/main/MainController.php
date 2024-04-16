<?php

namespace App\Http\Controllers\client\main;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use App\Models\FInanceModel;
use App\Models\NotificationModel;
use App\Models\ReviewModel;
use App\Models\TransactionModel;
use App\Models\User;
use App\Models\VisitorModel;
use App\Models\Visitors;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    function index(Request $request)
    {
        if (session('login') == true && session('role') == 'admin') {
            return redirect()->route('adminDashboard');
        }

        if (session('login') == true && session('role') == 'employee') {
            return redirect()->route('adminDashboard');
        }

        $dataApp =  AppModel::where('app_id', 1)->first();
        //mendapatkan alamat ip pengunjung
        $clientIpAddress = $request->ip();

        //minyampan data alamat ip pengunjung
        $dataIp = [
            'ip_address' => $clientIpAddress,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        $insert = VisitorModel::insert($dataIp);

        //Menghitung Jumlah Pengunjung:
        $jumlahVisitor = VisitorModel::count();

        $dataReview  = ReviewModel::select(
            'review.review_text',
            'review.star',
            'review.image1',
            'review.image2',
            'review.created_at',
            'review.image3',
            'review.image4',
            'users.nama_lengkap',
            'users.sign_in',
            'users.profile_photo'
        )
            ->leftJoin('users', 'review.user_id', '=', 'users.user_id')
            ->where('review.status', 1)
            ->orderBy('review.review_id', 'desc')
            ->limit(10)
            ->get();

        $data = [
            'dataApp' => $dataApp,
            'dataReview' => $dataReview,
            'jumlah_visitor' => $jumlahVisitor
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
                'users.sign_in',
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

    function dashboardClient()
    {
        try {
            $dataUser = User::where('user_id', session('user_id'))->first();
            $transactionModel = new TransactionModel();
            $totalSelesaiTransaksi = $transactionModel->countTotalTransactionCustomer(session('user_id'), 1);
            $totalProsesTransaksi = $transactionModel->countTotalTransactionCustomer(session('user_id'), 2);
            $totalProsesFinanceTransaksi = $transactionModel->countTotalTransactionCustomer(session('user_id'), 3);
            $totalTidakValidTransaksi = $transactionModel->countTotalTransactionCustomer(session('user_id'), 0);
            $dataApp =  AppModel::where('app_id', 1)->first();
            $dataNotification = NotificationModel::where('user_id', session('user_id'))->orderBy('notif_id', 'desc')->get();
            $totalNotificationRead = NotificationModel::select('notif_id')->where('status', 0)->count();
            $totalNotification = NotificationModel::select('notif_id')->count();


            $data = [
                'dataUser' => $dataUser,
                'totalSelesaiTransaksi' => $totalSelesaiTransaksi,
                'totalProsesTransaksi' => $totalProsesTransaksi,
                'totalProsesFinanceTransaksi' => $totalProsesFinanceTransaksi,
                'totalTransaksiTidakValid' => $totalTidakValidTransaksi,
                'dataApp' => $dataApp,
                'dataNotification' => $dataNotification,
                'totalNotificationRead' => $totalNotificationRead,
                'totalNotification' => $totalNotification,
            ];

            return view('client.dashboard.index', $data);
        } catch (\Throwable $th) {
            return redirect()->route('/')->with('failed', 'Terjadi kesalahan');
        }
    }

    function logOut()
    {
        session()->flush();
        return redirect()->route('/');
    }

    function profile()
    {
        try {
            $dataApp = AppModel::first();
            $dataUser = User::where('user_id', session('user_id'))->first();
            $data = [
                'dataApp' => $dataApp,
                'dataUser' => $dataUser
            ];

            return view('client.profile.profile', $data);
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
 }
}
}
