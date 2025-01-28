<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VisitBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $visitorData; // To hold visitor data
    public $visitorNumber; // To hold the generated visitor number

    /**
     * Create a new message instance.
     *
     * @param array $visitorData
     * @param string $visitorNumber
     */
    public function __construct(array $visitorData, string $visitorNumber)
    {
        $this->visitorData = $visitorData;
        $this->visitorNumber = $visitorNumber;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Visit Booked',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.visit_booked',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.visit_booked')
                    ->with([
                        'firstName' => $this->visitorData['first_name'],
                        'visitorNumber' => $this->visitorNumber,
                    ]);
    }
}