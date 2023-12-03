@extends('layouts.card')

@section('card-name')
    {{ __('Login') }}
@endsection

@section('card-content')
    <form method="POST" action="{{ route('login') }}">
        @csrf

        @include('components.inputField', [
            ($inputName = 'username'),
            ($inputType = 'text'),
            ($inputLabel = 'Student ID/Email'),
            ($required = true),
            ($autofocus = true),
        ])

        @include('components.inputField', [
            ($inputName = 'password'),
            ($inputType = 'password'),
            ($inputLabel = 'Password'),
            ($required = true),
        ])

        @include('components.inputField', [
            ($inputName = 'remember'),
            ($inputType = 'checkbox'),
            ($inputLabel = 'Remember Me'),
        ])

        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
@endsection
