<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Str;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{

    public function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
    }
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
            $validate = Admin::where('email', $email)->first();
            if ($validate) {
                if (Hash::check($password, $validate['password'])) {
                    $request = session()->put('login', true);
                    $request = session()->put('role', 'admin');
                    $request = session()->put('admin_id', $validate['admin_id']);
                    return redirect()->route('adminDashboard');
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

    function logOutAdmin()
    {
        session()->flush();
        return redirect()->route('admin');
    }
    function forgotPassword()
    {
        return view('admin.auth.forgot_password');
    }

    function sendResetPasswordToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $validateEmail = Admin::where('email', $request->input('email'))->first();
            if ($validateEmail) {
                $pwToken = Str::random(6);
                $adminId = $validateEmail['admin_id'];
                $dataAdmin = [
                    'token_password' => $pwToken,
                ];
                $update = Admin::where('admin_id', $adminId)->update($dataAdmin);
                if (!$update) {
                    return redirect()->back()->with('failed', 'Gagal megirim token');
                }



                try {
                    $dataUser = [
                        'name' => $validateEmail['name'],
                        'token' => $pwToken,
                        'admin_id' => $adminId
                    ];
                    $validateEmail->notify(new EmailNotification($dataUser));
                    return redirect()->route('indexTokenAdmin', Crypt::encrypt($adminId));
                } catch (\Exception $exception) {
                    // Handle kegagalan pengiriman email
                    $errorMessage = $exception->getMessage();
                    return redirect()->back()->with('error', 'Gagal mengirim email. Kesalahan: ' . $errorMessage);
                }
            } else {
                return redirect()->back()->with('failed', 'Email tidak terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }

    function indexToken($adminId)
    {
        $data = [
            'admin_id' => Crypt::decrypt($adminId),
        ];
        return view('admin.auth.token', ['data' => $data]);
    }

    function tokenValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'admin_id' => 'required|integer'
        ], [
            'token.required' => 'Token tidak boleh kosong',
            'token.string' => 'Token tidak valid',
            'admin_id.required' => 'Terjadi kesalahan',
            'admin_id.integer' => 'Terjadi kesalahan'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        $validationToken = Admin::where('admin_id', $request->admin_id)->first();
        if ($validationToken) {
            if ($validationToken['token_password'] == $request->token) {
                return redirect()->route('indexNewPasswordAdmin', Crypt::encrypt($request->admin_id));
            } else {
                return redirect()->back()->with('failed', 'Token salah');
            }
        } else {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function indexNewPassword($adminId)
    {
        $data = [
            'admin_id' => Crypt::decrypt($adminId),
        ];
        return view('admin.auth.new_password', ['data' => $data]);
    }

    function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'admin_id' => 'required|numeric',
            'password' => 'required|string|min:8'
        ], [
            'admin_id.required' => 'Terjadi kesalahan',
            'admin_id.numeric' => 'Terjadi kesalahan',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.string' => 'Kata sandi hanya boleh berupa huruf dan angka',
            'password.min' => 'Kata sandi tidak boleh mengandung kurang dari 8 karakter'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        $dataAdmin = [
            'password' => Hash::make($request->password),
            'token_password' => null

        ];
        $update = Admin::where('admin_id', $request->admin_id)->update($dataAdmin);
        if ($update) {
            return redirect()->route('admin')->with('success', 'Berhasil reset kata sandi');
        } else {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
