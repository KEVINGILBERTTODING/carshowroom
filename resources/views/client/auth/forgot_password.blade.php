@extends('layouts.admin.auth.t_login')

@section('title')
    <title>Reset Kata Sandi</title>
@endsection


@section('content')
    <div class="col-lg-5 col-12">
        <div id="auth-left">

            <h1 class="auth-title">Lupa Kata Sandi</h1>
            <p class="auth-subtitle mb-5">Masukkan email Anda.</p>

            <form action="{{ route('sendResetPasswordTokenUser') }}" method="POST">
                @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" name="email" required type="email" class="form-control form-control-xl"
                        placeholder="Email">
                    <div class="form-control-icon">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif


                @if (session('failed'))
                    <div class="alert alert-danger">{{ session('failed') }}</div>
                @endif

                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Kirim</button>
            </form>

        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">

        </div>
    </div>
@endsection
