<?php

namespace App\Http\Controllers\client\main;

use App\Http\Controllers\Controller;
use App\Models\AppModel;
use Illuminate\Http\Request;

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
}
