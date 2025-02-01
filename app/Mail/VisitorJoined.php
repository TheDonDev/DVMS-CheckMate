<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content; // Import Content
use Illuminate\Mail\Mailables\Envelope; // Import Envelope
use Illuminate\Queue\SerializesModels;

class VisitorJoined extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // To hold the visitor's data
    public $visitNumber; // To hold the visitor number

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @param string $visitNumber
     */
    public function __construct(array $data, string $visitNumber)
    {
        $this->data = $data; // Assign the visitor data to the property
        $this->visitNumber = $visitNumber; // Assign the visit number
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Visitor Joined',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.visitor_joined',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->view('emails.visitor_joined')
                    ->with([
                        'firstName' => $this->data['first_name'],
                        'lastName' => $this->data['last_name'],
                        'designation' => $this->data['designation'],
                        'email' => $this->data['email'],
                        'phone' => $this->data['phone'],
                        'organization' => $this->data['organization'],
                        'visitNumber' => $this->visitNumber,
                    ]);
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
