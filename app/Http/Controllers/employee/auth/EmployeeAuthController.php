<?php

namespace App\Http\Controllers\employee\auth;

use App\Http\Controllers\Controller;
use App\Models\EmployeeModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class EmployeeAuthController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
    function index()
    {
        return view('employee.auth.login');
    }

    function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string'
            ], [
                'email.required' => 'Email tidak boleh kosong',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password tidak boleh kosong',
                'password.string' => 'Password hanya boleh berupa huruf dan angka',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('failed', $validator->errors()->first())->withInput();
            }

            $email = $request->input('email');
            $password = $request->input('password');
            $validate = EmployeeModel::where('email', $email)->first();
            if ($validate) {
                if (Hash::check($password, $validate['password'])) {
                    if ($validate['status'] != 1) {
                        return redirect()->back()->with('failed', 'Akun Anda telah di non aktifkan oleh Admin');
                    }
                    $request = session()->put('login', true);
                    $request = session()->put('role', 'employee');
                    $request = session()->put('karyawan_id', $validate['karyawan_id']);
                    return redirect()->route('karyawanDashboard');
                } else {
                    return redirect()->back()->with('failed', 'Kata sandi salah')->withInput();
                }
            } else {
                return redirect()->back()->with('failed', 'Email tidak terdaftar')->withInput();
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan')->withInput();
        }
    }

    function logOutEmployee()
    {
        session()->flush();
        return redirect()->route('karyawan');
    }
}
