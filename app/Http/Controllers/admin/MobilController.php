<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use Illuminate\Http\Request;

class MobilController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }

    function tambahMobil()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();

        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp
        ];
        return view('admin.car.add_car', $data);
    }
}
