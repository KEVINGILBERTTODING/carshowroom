<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AppModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $dataApp = AppModel::where('app_id', 1)->first();
        $data = [
            'dataAdmin' => $dataAdmin,
            'dataApp' => $dataApp
        ];
        return view('admin.main.index', $data);
    }
}
