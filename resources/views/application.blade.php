@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Application Form') }}</div>

                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf

                            @include('components.inputField', [
                                'inputName' => 'name',
                                'inputType' => 'text',
                                'inputLabel' => 'Name',
                                'required' => true,
                                'autofocus' => true
                            ])

                            @include('components.inputField', [
                                'inputName' => 'password',
                                'inputType' => 'password',
                                'inputLabel' => 'Password',
                                'required' => true,
                            ])

                            @include('components.inputField', [
                                'inputName' => 'remember',
                                'inputType' => 'checkbox',
                                'inputLabel' => 'Remember Me',
                            ])

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button class="btn btn-secondaryb">
                                        {{ __('Cancel')}}
                                    </button>

                                    <button type="submit" class="btn btn-primary mx-2">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
