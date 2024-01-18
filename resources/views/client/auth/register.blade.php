@extends('layouts.admin.auth.t_login')

@section('title')
    <title>Daftar</title>
@endsection


@section('content')
    <div class="col-lg-5 col-12">
        <div id="auth-left">

            <h1 class="auth-title">Daftar</h1>
            <p class="auth-subtitle mb-5">Masukkan data Anda.</p>

            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="email" required type="email" class="form-control form-control-xl"
                        placeholder="Email">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="nama_lengkap" required type="text" class="form-control form-control-xl"
                        placeholder="Nama lengkap">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" name="password" required class="form-control form-control-xl"
                        placeholder="Kata sandi">
                    <div class="form-control-icon">
                        <i class="bi bi-lock"></i>
                    </div>
                </div>


                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif


                @if (session('failed'))
                    <div class="alert alert-danger">{{ session('failed') }}</div>
                @endif

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Daftar</button>

            </form>


            <div class="text-center mt-5 text-lg fs-4">

                <p><a class="font-bold" href="{{ route('client.sign-in') }}">Telah memiliki akun?</a>.</p>
            </div>

        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
@endsection
