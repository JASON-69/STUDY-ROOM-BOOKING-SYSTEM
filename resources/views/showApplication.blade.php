@extends('layouts.card')

@section('card-name')
    {{ __('Application Form') }}
@endsection

@section('card-content')
    @include('components.inputField', [
        'inputName' => 'brief_description',
        'inputType' => 'option',
        'inputLabel' => 'Brief Description',
        'inputOptions' => App\Enums\BriefDescription::values(),
        'inputDefault' => $booking->brief_description,
        'disabled' => true,
    ])

    @include('components.inputField', [
        'inputName' => 'name',
        'inputType' => 'text',
        'inputLabel' => 'Student / Staff Name',
        'inputDefault' => $booking->user->name,
        'disabled' => true,
    ])

    @include('components.inputField', [
        'inputName' => 'username',
        'inputType' => 'text',
        'inputLabel' => 'Matric / Staff ID',
        'inputDefault' => $booking->user->username,
        'disabled' => true,
    ])

    @include('components.inputField', [
        'inputName' => 'purpose',
        'inputType' => 'text',
        'inputLabel' => 'Purpose',
        'disabled' => true,
        'inputDefault' => $booking->purpose,
    ])

    @include('components.inputField', [
        'inputName' => 'contact_number',
        'inputType' => 'text',
        'inputLabel' => 'Contact Number',
        'inputDefault' => $booking->user->mobileNumber,
        'disabled' => true,
    ])
    <hr>
    <div class="row mb-3">
        <label for="start_date" class="col-md-2 col-form-label text-md-end">Start Date</label>

        <div class="col-md-4">
            <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror"
                name="start_date" value="{{ $booking->start_date->format('Y-m-d') }}" autocomplete="start_date" disabled>

            @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <label for="end_date" class="col-md-2 col-form-label text-md-end">End Date</label>

        <div class="col-md-4">
            <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror"
                name="end_date" value="{{ $booking->end_date->format('Y-m-d') }}" autocomplete="end_date" disabled>

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
                name="start_time" value="{{ $booking->start_time->format('H:i') }}" autocomplete="start_time" disabled>

            @error('start_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <label for="end_time" class="col-md-2 col-form-label text-md-end">End Time</label>

        <div class="col-md-4">
            <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror"
                name="end_time" value="{{ $booking->end_time->format('H:i') }}" autocomplete="end_time" disabled>

            @error('end_time')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <hr>

    @if (auth()->user()->is_admin)
        <div class="d-flex mb-0 justify-content-md-center justify-content-end">
            <button type="button" class="btn btn-danger mx-2" onclick="reject();">
                <i class="bi bi-x-circle-fill"></i>
                {{ __('Reject') }}
            </button>

            <button type="button" class="btn btn-success" onclick="approve();">
                <i class="bi bi-check-circle-fill"></i>
                {{ __('Approve') }}
            </button>
        </div>

        @section('scripts')
            <script>
                function approve() {
                    document.querySelector('#approve-form').submit();
                }

                function reject() {
                    document.querySelector('#reject-form').submit();
                }
            </script>
        @endsection
        <form method="POST" action="{{ route('application.approve', $booking->id) }}" id="approve-form" class="d-none">
            @csrf
        </form>
        <form method="POST" action="{{ route('application.reject', $booking->id) }}" id="reject-form" class="d-none">
            @csrf
        </form>
    @endif

    @if (!auth()->user()->is_admin)
        <div class="d-flex mb-0 justify-content-md-center justify-content-end">
            <button type="button" class="btn btn-danger mx-2" id="button-cancel">
                {{ __('Back') }}
            </button>

            <a type="button" class="btn btn-success" href="{{ route('application.edit', $booking->id) }}">
                {{ __('Edit') }}
            </a>
        </div>
    @endif
@endsection

@section('scripts')
<script>
    function clear() {
        window.location.href = "{{ route('home') }}";
    }

    document.querySelector('#button-cancel').addEventListener('click', clear);
</script>
@endsection