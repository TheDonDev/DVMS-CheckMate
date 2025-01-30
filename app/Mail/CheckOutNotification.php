<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CheckOutNotification extends Mailable
{
    use Queueable, SerializesModels;


    public $visit;
    public $host;

    public function __construct($visit, $host)
    {
        $this->visit = $visit;
        $this->host = $host;
    }

    public function build()
    {
        return $this->view('emails.checkout')
                    ->with([
                        'visitNumber' => $this->visit->visit_number,
                        'hostName' => $this->host->name,
                    ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Check Out Notification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
