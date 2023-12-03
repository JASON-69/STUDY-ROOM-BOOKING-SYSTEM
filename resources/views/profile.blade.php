@extends('layouts.card')

@section('card-name')
    {{ __('Profile') }}
@endsection

@section('card-content')
    @if (session('success'))
        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form action="{{ route('profile.update') }}" method="post">
        @csrf

        @method('PUT')

        @include('components.inputField', [
            'inputName' => 'name',
            'inputType' => 'text',
            'inputLabel' => 'Name',
            'inputDefault' => auth()->user()->name,
            'readonly' => true,
        ])

        @include('components.inputField', [
            'inputName' => 'username',
            'inputType' => 'text',
            'inputLabel' => 'Username',
            'inputDefault' => auth()->user()->username,
            'readonly' => true,
        ])

        @include('components.inputField', [
            'inputName' => 'email',
            'inputType' => 'email',
            'inputLabel' => 'Email',
            'inputDefault' => auth()->user()->email,
            'readonly' => true,
        ])

        @include('components.inputField', [
            'inputName' => 'mobileNumber',
            'inputType' => 'text',
            'inputLabel' => 'Phone Number',
            'inputDefault' => auth()->user()->mobileNumber,
            'required' => true,
            'autofocus' => true
        ])

        @include('components.inputField', [
            'inputName' => 'password',
            'inputType' => 'password',
            'inputLabel' => 'Password',
            'required' => true,
            'autofocus' => true
        ])

        @include('components.inputField', [
            'inputName' => 'password_confirmation',
            'inputType' => 'password',
            'inputLabel' => 'Confirm Password',
            'required' => true,
        ])
        
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="button" class="btn btn-secondary">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="btn btn-primary">
                    {{ __('Update') }}
                </button>
            </div>
        </div>
    </form>
@endsection
