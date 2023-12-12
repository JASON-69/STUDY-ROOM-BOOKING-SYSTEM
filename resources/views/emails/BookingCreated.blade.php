<x-mail::message>
# Booking Created

The Booking has been created by {{ $booking->user->name }} to use on {{ $booking->date }}.
Please review the booking and approve or reject it.

<x-mail::button :url="route('application.show', [$booking->id, $notificationId])">
View Booking
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
