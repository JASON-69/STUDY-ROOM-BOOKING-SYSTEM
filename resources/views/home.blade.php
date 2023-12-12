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

    <div class="row row-cols-2 row-cols-lg-6">
        <div class="col">
            <label class="col-form-label">Name :</label>
        </div>
        <div class="col">
            <label class="col-form-label">{{ auth()->user()->name }}</label>
        </div>
        <div class="col">
            <label class="col-form-label">Matric Number :</label>
        </div>
        <div class="col">
            <label class="col-form-label">{{ auth()->user()->username }}</label>
        </div>
        <div class="col">
            <label class="col-form-label">Mobile Number :</label>
        </div>
        <div class="col">
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
    <div class="table-responsive">
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
                    @endif
                    <th scope="col">Action</th>

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
                                <button type="button" class="btn" onclick="approve({{ $booking->id }})">
                                    <i class="bi bi-check-circle-fill"></i>
                                </button>
                                <a href="{{ route('application.show', $booking->id) }}" class="btn">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <button type="button" class="btn" onclick="reject({{ $booking->id }})">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                                <form method="POST" action="{{ route('application.approve', $booking->id) }}"
                                    id="approve-form{{ $booking->id }}" class="d-none">
                                    @csrf
                                </form>
                                <form method="POST" action="{{ route('application.reject', $booking->id) }}"
                                    id="reject-form{{ $booking->id }}" class="d-none">
                                    @csrf
                                </form>
                            </td>
                            @section('scripts')
                                <script>
                                    function approve(id) {
                                        document.querySelector(`#approve-form${id}`).submit();
                                    }

                                    function reject(id) {
                                        document.querySelector(`#reject-form${id}`).submit();
                                    }
                                </script>
                            @endsection
                        @endif
                        @if (!auth()->user()->is_admin)
                            <td>
                                <a href="{{ route('application.show', $booking->id) }}" class="btn">
                                    <i class="bi bi-eye-fill"></i>
                                </a>
                                <a href="{{ route('application.edit', $booking->id) }}" class="btn">
                                    <i class="bi bi-pencil-fill"></i>
                                </a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
