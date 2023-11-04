<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index()
    {
        $dataAdmin = Admin::where('admin_id', session('admin_id'))->first();
        $data = [
            'dataAdmin' => $dataAdmin
        ];
        return view('admin.main.index', $data);
    }
}
