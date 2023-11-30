@extends('layouts.admin.auth.t_login')

@section('title')
    <title>Karyawan - Login</title>
@endsection


@section('content')
    <div class="col-lg-5 col-12">
        <div id="auth-left">

            <h1 class="auth-title">Masuk</h1>
            <p class="auth-subtitle mb-5">Masuk dengan data yang Anda masukkan saat pendaftaran</p>

            <form action="{{ route('loginEmployee') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="email" required type="email" class="form-control form-control-xl"
                        placeholder="Email">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" required class="form-control form-control-xl"
                        placeholder="Kata sandi">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>

                @if (session('failed'))
                    <div class="alert alert-danger">{{ session('failed') }}</div>
                @endif

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
            </form>
            {{-- <div class="text-center mt-5 text-lg fs-4">

                <p><a class="font-bold" href="auth-forgot-password.html">Lupa kata sandi?</a>.</p>
            </div> --}}
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
@endsection