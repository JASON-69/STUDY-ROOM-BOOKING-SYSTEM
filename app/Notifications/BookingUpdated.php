<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use App\Mail\BookingUpdated as BookingUpdatedMail;

class BookingUpdated extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public Booking $booking;
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): Mailable
    {
        return (new BookingUpdatedMail($this->booking, $this->id))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toDatabase(object $notifiable): array
    {
        return [
            'booking_id' => $this->booking->id,
            'booking_status' => $this->booking->booking_status,
        ];
    }
}
