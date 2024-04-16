<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\EmailNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class AuthClientController extends Controller
{

    function index()
    {
        return view('client.auth.sign-in');
    }


    function daftar()
    {
        return view('client.auth.register');
    }

    function loginWithGoogle(Request $request)
    {
        $email = $request->input('email');
        $namaLengkap = $request->input('nama_lengkap');
        $profilePhoto = $request->input('profile_photo');
        try {
            $validateEmail = User::where('email', $email)->first();
            if ($validateEmail) { // jika ada maka simpan ke session
                $request = session()->put('client', true);
                $request = session()->put('user_id', $validateEmail['user_id']);
                $request =  session()->put('profile_photo', $profilePhoto);

                $data = [

                    'nama_lengkap' => $namaLengkap,
                    'profile_photo' => $profilePhoto,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                // update data baru
                User::where('user_id', $validateEmail['user_id'])->update($data);
                return response()->json([
                    'status' => 'success',
                    'message' => 'User registered, session updated',
                    'user_id' => $validateEmail['user_id'],
                ]);
            } else { // jika tidak ada daftarkan
                $data = [
                    'email' => $email,
                    'nama_lengkap' => $namaLengkap,
                    'sign_in' => 'google',
                    'profile_photo' => $profilePhoto,
                    'created_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
                try {
                    $insert = User::insert($data);
                    if ($insert) {
                        $validateEmail2 = User::where('email', $email)->first();
                        $request = session()->put('client', true);
                        $request = session()->put('user_id', $validateEmail2['user_id']);
                        return response()->json([
                            'status' => 'success',
                            'message' => 'User registered, session updated',
                            'user_id' => $validateEmail2['user_id'],
                        ]);
                    } else {
                        return response([
                            'status' => 'error',
                            'message' => 'Terjadi kesalahan1'
                        ], 500);
                    }
                } catch (\Throwable $th) {
                    return response([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan2'
                    ], 500);
                }
            }
        } catch (\Throwable $th) {
            return response([
                'status' => 'error',
                'message' => 'Terjadi kesalahan'
            ], 500);
        }
    }

    function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'nama_lengkap' => 'required|string',
            'password' => 'required|string|min:8'
        ], [
            'required' => 'Kolom :attribute tidak boleh kosong',
            'email' => 'Email tidak valid',
            'unique' => 'Email telah terdaftar',
            'string' => 'Kolom :attribute hanya boleh berupa huruf dan angka',
            'min' => 'Kata sandi tidak boleh kurang dari 8 karakter'
        ], [
            'email' => 'Email',
            'nama_lengkap' => 'Nama lengkap',
            'password' => 'Kata sandi'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {
            $data = [
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'nama_lengkap' => $request->input('nama_lengkap'),
                'sign_in' => 'email',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];

            $insert = User::insert($data);
            if ($insert) {
                return redirect()->route('/')->with('success', 'Berhasil mendaftar');
            } else {
                return redirect()->back()->with('failed', 'Gagal registrasi');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Gagal registrasi');
        }
    }

    function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.string' => 'Kata sandai hanya boleh mengandung huruf dan angka',
            'password.min' =>  'Kata sandi tidak boleh kurang dari 8 karakter'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        $email = $request->input('email');
        $password = $request->input('password');
        try {
            $validateEmail = User::where('email', $email)->where('sign_in', 'email')->first();
            if ($validateEmail) {
                if (Hash::check($password, $validateEmail['password'])) {
                    $request = session()->put('client', true);
                    $request = session()->put('user_id', $validateEmail['user_id']);
                    return redirect()->route('/')->with('success', 'Berhasil login');
                } else {
                    return redirect()->back()->with('failed', 'Kata sandi salah');
                }
            } else {
                return redirect()->back()->with('failed', 'Email belum terdaftar');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', $th->getMessage());
        }
    }


    function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute hanya boleh berupa huruf dan angka',
            'min' => ':attribute tidak boleh kurang dari 8 karakter'
        ], [
            'old_password' => 'Password lama',
            'new_password' => 'Password baru'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        try {

            // check password
            $validationPassword = User::select('password')->where('user_id', session('user_id'))->first();
            if ($validationPassword && Hash::check($request->old_password, $validationPassword['password'])) {
                $dataUser = [
                    'password' => Hash::make($request->new_password),
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $update = User::where('user_id', session('user_id'))->update($dataUser);
                if ($update) {
                    return redirect()->route('profile')->with('success', 'Berhasil mengubah kata sandi');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah kata sandi');
                }
            } else {
                return redirect()->back()->with('failed', 'Kata sandi lama salah');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function updateProfile(Request $request)
    {

        // jika user sign in via email
        if ($request->sign_in == 'email') {
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string',
                'email' => 'required|string|unique:users,email,' . session('user_id') . ',user_id',
                'no_hp' => 'required|numeric',
                'alamat' => 'required|string',
                'kota' => 'required|string',
                'provinsi' => 'required|string'
            ], [
                'required' => ':attribute tidak boleh kosong',
                'string' => ':attribute hanya boleh berupa huruf dan angka',
                'unique' => ':attribute telah digunakan',
                'numeric' => ':attribute hanya boleh berupa angka'
            ], [
                'nama_lengkap' => 'Nama lengkap',
                'email' => 'Email',
                'no_hp' => 'No handphone',
                'alamat' => 'Alamat',
                'kota' => 'Kota',
                'provinsi' => 'Provinsi'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('failed', $validator->errors()->first());
            }

            try {
                $data = [
                    'nama_lengkap' => $request->nama_lengkap,
                    'no_hp' => $request->no_hp,
                    'email' => $request->email,
                    'alamat' => $request->alamat,
                    'kota' => $request->kota,
                    'provinsi' => $request->provinsi,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $update = User::where('user_id', session('user_id'))->update($data);
                if ($update) {
                    return redirect()->route('profile')->with('success', 'Berhasil mengubah profile');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah profile');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        } else {
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string',
                'no_hp' => 'required|numeric',
                'alamat' => 'required|string',
                'kota' => 'required|string',
                'provinsi' => 'required|string'
            ], [
                'required' => ':attribute tidak boleh kosong',
                'string' => ':attribute hanya boleh berupa huruf dan angka',
                'numeric' => ':attribute hanya boleh berupa angka'
            ], [
                'nama_lengkap' => 'Nama lengkap',
                'no_hp' => 'No handphone',
                'alamat' => 'Alamat',
                'kota' => 'Kota',
                'provinsi' => 'Provinsi'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('failed', $validator->errors()->first());
            }

            try {
                $data = [
                    'nama_lengkap' => $request->nama_lengkap,
                    'no_hp' => $request->no_hp,
                    'alamat' => $request->alamat,
                    'kota'=> $request->kota,
                    'provinsi' => $request->provinsi,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];

                $update = User::where('user_id', session('user_id'))->update($data);
                if ($update) {
                    return redirect()->route('profile')->with('success', 'Berhasil mengubah profile');
                } else {
                    return redirect()->back()->with('failed', 'Gagal mengubah profile');
                }
            } catch (\Throwable $th) {
                return redirect()->back()->with('failed', 'Terjadi kesalahan');
            }
        }
    }

    function updateProfilePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:5000'
        ], [
            'photo.required' => 'Gambar tidak boleh kosong',
            'photo.image' => 'Gambar tidak valid',
            'photo.mimes' => 'Format gambar tidak valid',
            'photo.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'USR-' . session('user_id') . '.' . $file->getClientOriginalExtension();
            $file->move('data/profile_photo/', $fileName);
            try {
                $data = [
                    'profile_photo' => $fileName,
                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                ];
                $update  = User::where('user_id', session('user_id'))->update($data);
                if ($update) {
                    return redirect()->route('profile')->with('success', 'Berhasil mengubah foto profil');
                } else {
                    return redirect()->route('profile')->with('failed', 'Gagal mengubah foto profil');
                }
            } catch (\Throwable $th) {
                return redirect()->route('profile')->with('failed', 'Terjadi kesalahan');
            }
        }
    }

    function forgotPassword()
    {
        return view('client.auth.forgot_password');
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
            $validateEmail = User::where('email', $request->input('email'))->where('sign_in', 'email')
                ->where('status', 1)->first();
            if ($validateEmail) {
                $pwToken = Str::random(6);
                $userId = $validateEmail['user_id'];
                $dataUsr = [
                    'token_password' => $pwToken,
                ];
                $update = User::where('user_id', $userId)->update($dataUsr);
                if (!$update) {
                    return redirect()->back()->with('failed', 'Gagal megirim token');
                }



                try {
                    $dataUser = [
                        'name' => $validateEmail['nama_lengkap'],
                        'token' => $pwToken,
                        'user_id' => $userId
                    ];
                    $validateEmail->notify(new EmailNotification($dataUser));
                    return redirect()->route('indexTokenUser', Crypt::encrypt($userId))->with('success', 'Token berhasil dikirimkan pada email anda.');
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

    function indexToken($userId)
    {
        $data = [
            'user_id' => Crypt::decrypt($userId),
        ];
        return view('client.auth.token', ['data' => $data]);
    }

    function tokenValidation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|string',
            'user_id' => 'required|integer'
        ], [
            'token.required' => 'Token tidak boleh kosong',
            'token.string' => 'Token tidak valid',
            'user_id.required' => 'Terjadi kesalahan',
            'user_id.integer' => 'Terjadi kesalahan'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        $validationToken = User::where('user_id', $request->user_id)->first();
        if ($validationToken) {
            if ($validationToken['token_password'] == $request->token) {
                return redirect()->route('indexNewPasswordUser', Crypt::encrypt($request->user_id));
            } else {
                return redirect()->back()->with('failed', 'Token salah');
            }
        } else {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }

    function indexNewPassword($userId)
    {
        $data = [
            'user_id' => Crypt::decrypt($userId),
        ];
        return view('client.auth.new_password', ['data' => $data]);
    }

    function updatePasswordClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|numeric',
            'password' => 'required|string|min:8'
        ], [
            'user_id.required' => 'Terjadi kesalahan',
            'user_id.numeric' => 'Terjadi kesalahan',
            'password.required' => 'Kata sandi tidak boleh kosong',
            'password.string' => 'Kata sandi hanya boleh berupa huruf dan angka',
            'password.min' => 'Kata sandi tidak boleh mengandung kurang dari 8 karakter'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed', $validator->errors()->first());
        }

        $dataUser = [
            'password' => Hash::make($request->password),
            'token_password' => null

        ];
        $update = User::where('user_id', $request->user_id)->update($dataUser);
        if ($update) {
            return redirect()->route('/')->with('success', 'Berhasil reset kata sandi');
        } else {
            return redirect()->back()->with('failed', 'Terjadi kesalahan');
        }
    }
}
