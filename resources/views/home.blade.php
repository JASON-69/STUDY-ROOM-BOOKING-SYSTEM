@extends('layouts.card')

@section('card-name')
    <h5>
        {{ __('Dashboard') }}
    </h5>
@endsection

@section('card-content')
    @if (session('success'))
        <div class="alert alert-success fade show alert-dismissible" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-2">
            <label class="col-form-label">Name :</label>
        </div>
        <div class="col-md-2">
            <label class="col-form-label">{{ auth()->user()->name }}</label>
        </div>
        <div class="col-md-2">
            <label class="col-form-label">Matric Number :</label>
        </div>
        <div class="col-md-2">
            <label class="col-form-label">{{ auth()->user()->username }}</label>
        </div>
        <div class="col-md-2">
            <label class="col-form-label">Mobile Number :</label>
        </div>
        <div class="col-md-2">
            <label class="col-form-label">{{ auth()->user()->mobileNumber }}</label>
        </div>
    </div>

    <hr>
    <h4>
        <div class="d-flex justify-content-center">
            History
        </div>
    </h4>
    <hr>
    <table class="table table-hover table-bordered table-striped text-center">
        <thead class="table-secondary">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Date</th>
                <th scope="col">Time</th>
                <th scope="col">Purpose</th>
                <th scope="col">Status</th>
                @if (auth()->user()->is_admin)
                    <th scope="col">Booked By</th>
                    <th scope="col">Acttion</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($bookings as $booking)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $booking->date }}</td>
                    <td>{{ $booking->time }}</td>
                    <td>{{ $booking->purpose }}</td>
                    <td>{{ $booking->booking_status }}</td>
                    @if (auth()->user()->is_admin)
                        <td>{{ $booking->user->name }}</td>
                        <td>
                            <a href="{{ route('application.edit', $booking->id) }}" class="btn btn-primary">Edit</a> 
                            <a href="{{ route('application.destroy', $booking->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
