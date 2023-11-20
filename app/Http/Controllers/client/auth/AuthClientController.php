<?php

namespace App\Http\Controllers\client\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuthClientController extends Controller
{
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
}
