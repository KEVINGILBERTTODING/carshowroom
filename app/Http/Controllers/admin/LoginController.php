<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    function index()
    {
        return view('admin.auth.login');
    }

    function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            if ($validator->fails()) {
                return redirect('/admin')->with('failed', $validator->errors()->first());
            }

            $email = $request->input('email');
            $password = $request->input('password');
            $validate = Admin::where('email', $email)->first();
            if ($validate) {
                if (Hash::check($password, $validate['password'])) {
                    return redirect('dashboard_admin');
                } else {
                    return redirect('/admin')->with('failed', 'Kata sandi salah');
                }
            } else {
                return redirect('/admin')->with('failed', 'Email belum terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect('/admin')->with('failed', $th->getMessage());
        }
    }
}
