@extends('layouts.card')

@section('card-name')
    {{ __('Application Form') }}
@endsection

@section('card-content')
    <form method="POST" action="{{ route('application.store') }}">
        @csrf

        @include('components.inputField', [
            'inputName' => 'brief_description',
            'inputType' => 'option',
            'inputLabel' => 'Brief Description',
            'inputOptions' => App\Enums\BriefDescription::values(),
        ])

        @include('components.inputField', [
            'inputName' => 'name',
            'inputType' => 'text',
            'inputLabel' => 'Student / Staff Name',
            'inputDefault' => auth()->user()->name,
            'readonly' => true,
        ])

        @include('components.inputField', [
            'inputName' => 'username',
            'inputType' => 'text',
            'inputLabel' => 'Matric / Staff ID',
            'inputDefault' => auth()->user()->username,
            'readonly' => true,
        ])

        @include('components.inputField', [
            'inputName' => 'purpose',
            'inputType' => 'text',
            'inputLabel' => 'Purpose',
            'required' => true,
            'autofocus' => true,
        ])

        @include('components.inputField', [
            'inputName' => 'contact_number',
            'inputType' => 'text',
            'inputLabel' => 'Contact Number',
            'inputDefault' => auth()->user()->mobileNumber,
            'readonly' => true,
        ])
        <hr>
        <div class="row mb-3">
            <label for="start_date" class="col-md-2 col-form-label text-md-end">Start Date</label>

            <div class="col-md-4">
                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror"
                    name="start_date" value="{{ $date ?? old('start_date') }}" autocomplete="start_date" required>

                @error('start_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label for="end_date" class="col-md-2 col-form-label text-md-end">End Date</label>

            <div class="col-md-4">
                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror"
                    name="end_date" value="{{ $date ?? old('end_date') }}" autocomplete="end_date" required>

                @error('end_date')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="start_time" class="col-md-2 col-form-label text-md-end">Start Time</label>

            <div class="col-md-4">
                <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror"
                    name="start_time" value="{{ old('start_time') }}" autocomplete="start_time" required>

                @error('start_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <label for="end_time" class="col-md-2 col-form-label text-md-end">End Time</label>

            <div class="col-md-4">
                <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror"
                    name="end_time" value="{{ old('end_time') }}" autocomplete="end_time" required>

                @error('end_time')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <hr>

        <div class="alert alert-primary d-flex align-items-center alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill flex-shrink-0 me-md-2 me-3"></i>
            <div>
                Booking must be reserve before 3 days. No urgent bookings
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="d-flex mb-0 justify-content-md-center justify-content-end">
            <button class="btn btn-secondary">
                {{ __('Cancel') }}
            </button>

            <button type="submit" class="btn btn-primary mx-2">
                {{ __('Save') }}
            </button>
        </div>
    </form>
@endsection
