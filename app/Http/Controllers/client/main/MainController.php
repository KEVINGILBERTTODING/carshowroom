<?php

namespace App\Http\Controllers\client\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    function index()
    {
        if (session('login') == true && session('role') == 'admin') {
            return redirect()->route('adminDashboard');
        }
        return view('client.main.index');
    }
}
