<?php

namespace App\Http\Controllers\api\auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\OwnerModel;
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

                $dataUser = [
                    'email' => $validateEmail['email'],
                    'user_id' => $validateEmail['user_id'],
                    'profile_photo' => $validateEmail['profile_photo'],
                    'nama_lengkap' => $validateEmail['nama_lengkap'],
                    'role' => 1 // user
                ];
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
                    'data' => $dataUser
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

                        return response()->json([
                            'status' => 'success',
                            'message' => 'User registered, session updated',
                            'data' =>  [
                                'email' => $validateEmail2['email'],
                                'user_id' => $validateEmail2['user_id'],
                                'profile_photo' => $validateEmail2['profile_photo'],
                                'nama_lengkap' => $validateEmail2['nama_lengkap'],
                                'role' => 1 // user
                            ]
                        ]);
                    } else {
                        return response([
                            'status' => 'error',
                            'message' => 'Terjadi kesalahan'
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
            return response([
                'message' => $validator->errors()->first()
            ], 400);
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
                return response([
                    'message' => 'success',

                ], 201);
            } else {
                return response([
                    'message' => 'Terjadi kesalahan',

                ], 401);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => 'Terjadi kesalahan server',

            ], 500);
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
            return response([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $email = $request->input('email');
        $password = $request->input('password');
        try {
            $validateEmail = User::where('email', $email)->where('sign_in', 'email')->first();
            $validateAdmin = Admin::where('email', $email)->first();
            $validateOwner = OwnerModel::where('email', $email)->first();
            if ($validateEmail) {
                if ($validateEmail['status'] == 0) { // tidak aktif
                    return response([
                        'message' => 'Akun telah di blokir'
                    ], 401);
                }

                if (Hash::check($password, $validateEmail['password'])) {
                    return response([
                        'message' => 'succes',
                        'data' => [
                            'email' => $validateEmail['email'],
                            'user_id' => $validateEmail['user_id'],
                            'profile_photo' => $validateEmail['profile_photo'],
                            'nama_lengkap' => $validateEmail['nama_lengkap'],
                            'role' => 1 // user
                        ]
                    ], 201);
                } else {
                    return response([
                        'message' => 'Kata sandi salah'
                    ], 400);
                }
            } else if ($validateAdmin) {

                if (Hash::check($password, $validateAdmin['password'])) {
                    return response([
                        'message' => 'succes',
                        'data' => [
                            'email' => $validateAdmin['email'],
                            'user_id' => $validateAdmin['admin_id'],
                            'profile_photo' => $validateAdmin['photo_profile'],
                            'nama_lengkap' => $validateAdmin['name'],
                            'role' => 2 // admin
                        ]
                    ], 201);
                } else {
                    return response([
                        'message' => 'Kata sandi salah'
                    ], 400);
                }
            } elseif ($validateOwner) {
                if (Hash::check($password, $validateOwner['password'])) {
                    return response([
                        'message' => 'succes',
                        'data' => [
                            'email' => $validateOwner['email'],
                            'user_id' => $validateOwner['owner_id'],
                            'profile_photo' => $validateOwner['photo_profile'],
                            'nama_lengkap' => $validateOwner['name'],
                            'role' => 3 // owner
                        ]
                    ], 201);
                } else {
                    return response([
                        'message' => 'Kata sandi salah'
                    ], 400);
                }
            } else {
                return response([
                    'message' => 'Email belum terdaftar'
                ], 400);
            }
        } catch (\Throwable $th) {
            return response([
                'message' => $th->getMessage()
            ], 500);
        }
    }


    function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required|numeric',
            'old_password' => 'required|string|min:8',
            'new_password' => 'required|string|min:8'
        ], [
            'required' => ':attribute tidak boleh kosong',
            'string' => ':attribute hanya boleh berupa huruf dan angka',
            'min' => ':attribute tidak boleh kurang dari 8 karakter',
            'numeric' => ':attribute tidak valid',
        ], [
            'old_password' => 'Password lama',
            'new_password' => 'Password baru',
            'role' => 'Role'
        ]);

        if ($validator->fails()) {
            return response([
                'message' =>  $validator->errors()->first()
            ], 400);
        }
        $userId = $request->user_id;
        $role = $request->role;

        try {

            if ($role == 1) { // user
                // check password
                $validationPassword = User::select('password')->where('user_id', $userId)->first();
                if ($validationPassword && Hash::check($request->old_password, $validationPassword['password'])) {
                    $dataUser = [
                        'password' => Hash::make($request->new_password),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    $update = User::where('user_id', $request->user_id)->update($dataUser);
                    if ($update) {
                        return response([
                            'message' =>  'Berhasil mengubah kata sandi'
                        ], 200);
                    } else {
                        return response([
                            'message' =>  'Gagal mengubah kata sandi'
                        ], 400);
                    }
                } else {
                    return response([
                        'message' =>  'Kata sandi lama tidak sesuai'
                    ], 400);
                }
            } else if ($role == 2) {
                // check password
                $validationPassword = Admin::select('password')->where('admin_id', $userId)->first();
                if ($validationPassword && Hash::check($request->old_password, $validationPassword['password'])) {
                    $dataUser = [
                        'password' => Hash::make($request->new_password),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    $update = Admin::where('admin_id', $request->user_id)->update($dataUser);
                    if ($update) {
                        return response([
                            'message' =>  'Berhasil mengubah kata sandi'
                        ], 200);
                    } else {
                        return response([
                            'message' =>  'Gagal mengubah kata sandi'
                        ], 400);
                    }
                } else {
                    return response([
                        'message' =>  'Kata sandi lama tidak sesuai'
                    ], 400);
                }
            } else if ($role == 3) { // owner
                // check password
                $validationPassword = OwnerModel::select('password')->where('owner_id', $userId)->first();
                if ($validationPassword && Hash::check($request->old_password, $validationPassword['password'])) {
                    $dataUser = [
                        'password' => Hash::make($request->new_password),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    $update = OwnerModel::where('owner_id', $request->user_id)->update($dataUser);
                    if ($update) {
                        return response([
                            'message' =>  'Berhasil mengubah kata sandi'
                        ], 200);
                    } else {
                        return response([
                            'message' =>  'Gagal mengubah kata sandi'
                        ], 400);
                    }
                } else {
                    return response([
                        'message' =>  'Kata sandi lama tidak sesuai'
                    ], 400);
                }
            }
        } catch (\Throwable $th) {
            return response([
                'message' =>  'Server error'
            ], 500);
        }
    }

    function updateProfile(Request $request)
    {

        $userId = $request->user_id;
        $role = $request->role;

        if ($role == 1) { // user
            if ($request->sign_in == 'email') {
                $validator = Validator::make($request->all(), [
                    'nama_lengkap' => 'required|string',
                    'email' => 'required|string|unique:users,email,' . $request->user_id . ',user_id',
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
                    return response([
                        'message' => $validator->errors()->first()
                    ], 404);
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

                    $update = User::where('user_id', $userId)->update($data);
                    if ($update) {
                        return response([
                            'message' => 'Berhasil mengubah profile'
                        ], 200);
                    } else {
                        return response([
                            'message' => 'Gagal mengubah profile'
                        ], 404);
                    }
                } catch (\Throwable $th) {
                    return response([
                        'message' => $validator->errors()->first()
                    ], 404);
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
                    return response([
                        'message' => $validator->errors()->first()
                    ], 404);
                }

                try {
                    $data = [
                        'nama_lengkap' => $request->nama_lengkap,
                        'no_hp' => $request->no_hp,
                        'alamat' => $request->alamat,
                        'kota' => $request->kota,
                        'provinsi' => $request->provinsi,
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    $update = User::where('user_id', $userId)->update($data);
                    if ($update) {
                        return response([
                            'message' => 'Berhasil mengubah profile'
                        ], 200);
                    } else {
                        return response([
                            'message' => 'Gagal mengubah profile'
                        ], 404);
                    }
                } catch (\Throwable $th) {
                    return response([
                        'message' => 'Terjadi kesalahan server'
                    ], 500);
                }
            }
        } else if ($role == 2) { // admin
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string',
                'email' => 'required|unique:admin,email,' . $userId . ',admin_id',
                'user_id' => 'required|exists:admin,admin_id'
            ], [
                'required' => ':attribute tidak boleh kosong',
                'string' => ':attribute hanya boleh berupa huruf dan angka',
                'numeric' => ':attribute hanya boleh berupa angka',
                'unique' => ':attribute telah terdaftar',
                'exists' => 'User tidak ditemukan'
            ], [
                'nama_lengkap' => 'Nama lengkap',
                'email' => 'Email',


            ]);

            if ($validator->fails()) {
                return response([
                    'message' => $validator->errors()->first()
                ], 404);
            }

            try {
                $data = [
                    'name' => $request->nama_lengkap,
                    'email' => $request->email
                ];

                $update = Admin::where('admin_id', $userId)->update($data);
                if ($update) {
                    return response([
                        'message' => 'Berhasil mengubah profile'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Gagal mengubah profile'
                    ], 404);
                }
            } catch (\Throwable $th) {
                return response([
                    'message' => 'Terjadi kesalahan server'
                ], 500);
            }
        } else if ($role == 3) { // owner
            $validator = Validator::make($request->all(), [
                'nama_lengkap' => 'required|string',
                'email' => 'required|unique:owner,email,' . $userId . ',owner_id',
                'user_id' => 'required|exists:owner,owner_id'
            ], [
                'required' => ':attribute tidak boleh kosong',
                'string' => ':attribute hanya boleh berupa huruf dan angka',
                'numeric' => ':attribute hanya boleh berupa angka',
                'unique' => ':attribute telah terdaftar',
                'exists' => 'User tidak ditemukan'
            ], [
                'nama_lengkap' => 'Nama lengkap',
                'email' => 'Email',


            ]);

            if ($validator->fails()) {
                return response([
                    'message' => $validator->errors()->first()
                ], 404);
            }

            try {
                $data = [
                    'name' => $request->nama_lengkap,
                    'email' => $request->email
                ];

                $update = OwnerModel::where('owner_id', $userId)->update($data);
                if ($update) {
                    return response([
                        'message' => 'Berhasil mengubah profile'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Gagal mengubah profile'
                    ], 404);
                }
            } catch (\Throwable $th) {
                return response([
                    'message' => 'Terjadi kesalahan server'
                ], 500);
            }
        }
    }

    function updateProfilePhoto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:png,jpg,jpeg|max:5000',
            'role' => 'required|numeric',
        ], [
            'photo.required' => 'Gambar tidak boleh kosong',
            'photo.image' => 'Gambar tidak valid',
            'photo.mimes' => 'Format gambar tidak valid',
            'photo.max' => 'Ukuran gambar tidak boleh lebih dari 5 MB',
            'user_id.required' => 'Pengguna tidak valid',
            'user_id.exists' => 'Pengguna tidak ditemukan',
            'role.required' => 'Role tidak ditemukan'

        ]);


        if ($validator->fails()) {
            return response([
                'message' => $validator->errors()->first()
            ], 400);
        }

        $role = $request->role;


        if ($request->hasFile('photo')) {
            $userId = $request->user_id;
            $file = $request->file('photo');

            if ($role == 1) { // user
                $fileName = 'USR-' . $userId . '.' . $file->getClientOriginalExtension();
            } else if ($role == 2) { // admin
                $fileName = 'ADM-' . $userId . '.' . $file->getClientOriginalExtension();
            }

            $file->move('data/profile_photo/', $fileName);
            try {
                if ($role == 1) {
                    $data = [
                        'profile_photo' => $fileName,
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];


                    $update  = User::where('user_id', $userId)->update($data);
                } else if ($role == 2) {
                    $data = [
                        'photo_profile' => $fileName,
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];


                    $update  = Admin::where('admin_id', $userId)->update($data);
                }
                if ($update) {
                    return response([
                        'message' => 'success'
                    ], 200);
                } else {
                    return response([
                        'message' => 'Gagal mengubah foto profile'
                    ], 400);
                }
            } catch (\Throwable $th) {
                return response([
                    'message' => $th->getMessage()
                ], 500);
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

    function getUserById($userId, $role)
    {
        try {
            if ($role == 1) { /// user
                $dataUser = User::where('user_id', $userId)->first();
            } else if ($role == 2) { // admmin
                $dataUser = Admin::where('admin_id', $userId)->first();
            } else if ($role == 3) { //owner
                $dataUser = OwnerModel::where('owner_id', $userId)->first();
            }



            return response([
                'message' => 'success',
                'data' => $dataUser
            ], 200);
        } catch (\Throwable $th) {
            return response([
                'message' => 'Terjadi kesalahan',
            ], 500);
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
}
