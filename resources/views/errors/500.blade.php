@extends('layouts.error.t_error')
@section('content')
    <div class="error-page container">
        <div class="col-md-8 col-12 offset-md-2">
            <div class="text-center">
                <img class="img-error" src="./assets/compiled/svg/error-500.svg" alt="Not Found">
                <h1 class="error-title">Sistem Error</h1>
                <p class="fs-5 text-gray-600">Situs web saat ini tidak dapat diakses. Coba lagi nanti atau hubungi
                    Pengembang.</p>
                <a href="{{ route('/') }}" class="btn btn-lg btn-outline-primary mt-3">Halaman Awal</a>
            </div>
        </div>
    </div>
@endsection
