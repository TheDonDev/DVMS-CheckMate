<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HostVisitNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $visitorDetails;
    public $visitNumber;
    public $host;

    public function __construct($visitorDetails, $visitNumber, $host)
    {
        $this->visitorDetails = $visitorDetails;
        $this->visitNumber = $visitNumber;
        $this->host = $host;
    }

    public function build()
    {
        return $this->view('emails.visit_booked')
                    ->with([
                        'visitorDetails' => $this->visitorDetails,
                        'visitNumber' => $this->visitNumber,
                        'host' => $this->host,
                    ]);
    }
}