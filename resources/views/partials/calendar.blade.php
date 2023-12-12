@isset($bookings)
    @if ($bookings->contains('booking_status', App\Enums\BookingStatusEnum::BOOKED->value))
        <span class="badge bg-primary" data-bs-id="{{ $bookings->pluck('id')->toJson() }}"
            data-bs-name="{{ $bookings->pluck('user.name')->toJson() }}"
            data-bs-date="{{ $bookings->pluck('date')->toJson() }}" data-bs-time="{{ $bookings->pluck('time')->toJson() }}"
            data-bs-status="{{ $bookings->pluck('booking_status')->toJson() }}">
            [day]
        </span>
    @elseif($bookings->contains('booking_status', App\Enums\BookingStatusEnum::APPROVED->value))
        <span class="badge bg-success" data-bs-id="{{ $bookings->pluck('id')->toJson() }}"
            data-bs-name="{{ $bookings->pluck('user.name')->toJson() }}"
            data-bs-date="{{ $bookings->pluck('date')->toJson() }}" data-bs-time="{{ $bookings->pluck('time')->toJson() }}"
            data-bs-status="{{ $bookings->pluck('booking_status')->toJson() }}">
            [day]
        </span>
    @elseif($bookings->contains('booking_status', App\Enums\BookingStatusEnum::REJECTED->value))
        <span class="badge bg-danger" data-bs-id="{{ $bookings->pluck('id')->toJson() }}"
            data-bs-name="{{ $bookings->pluck('user.name')->toJson() }}"
            data-bs-date="{{ $bookings->pluck('date')->toJson() }}"
            data-bs-time="{{ $bookings->pluck('time')->toJson() }}"
            data-bs-status="{{ $bookings->pluck('booking_status')->toJson() }}">
            [day]
        </span>
    @endif
@endisset
