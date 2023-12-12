<x-mail::message>
# Booking {{ $booking->booking_status }}

Your booking on {{ $booking->date }} has been {{ $booking->booking_status }}.

<x-mail::button :url="route('application.show', [$booking->id, $notificationId])">
View Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
