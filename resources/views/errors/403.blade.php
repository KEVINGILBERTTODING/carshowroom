@extends('layouts.error.t_error')
@section('content')
    <div class="error-page container">
        <div class="col-md-8 col-12 offset-md-2">
            <div class="text-center">
                <img class="img-error" src="./assets/compiled/svg/error-403.svg" alt="Not Found">
                <h1 class="error-title">Akses dibutuhkan</h1>
                <p class="fs-5 text-gray-600">Anda tidak memiliki akses untuk melihat halaman ini.</p>
                <a href="{{ route('/') }}" class="btn btn-lg btn-outline-primary mt-3">Halaman Awal</a>
            </div>
        </div>
    </div>
@endsection
