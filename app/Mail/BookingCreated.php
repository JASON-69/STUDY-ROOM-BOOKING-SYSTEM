<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingCreated extends Mailable 
{
    use Queueable, SerializesModels;

    public Booking $booking;
    public ?string $notificationId = null;

    /**
     * Create a new message instance.
     */
    public function __construct(Booking $booking, ?string $notificationId = null)
    {
        $this->booking = $booking;
        $this->notificationId = $notificationId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Created',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.BookingCreated',
            with: [
                'booking' => $this->booking,
                'notificationId' => $this->notificationId,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
