@extends('layout.app')

@section('content')
    <div class="bg-stripes"></div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h1>{{ __('auth.incorrect_login_attempt') }}</h1>
                    </div>
                    <div class="card-body text-center">
                        <button class="form-control btn btn-primary" onclick="document.location.href='{{ route('google-auth') }}'">{{ __('auth.incorrect_login_attempt_button') }}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
