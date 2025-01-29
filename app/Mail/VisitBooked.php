<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $visitorDetails;
    public $visitorNumber;

    public function __construct($visitorDetails, $visitorNumber)
    {
        $this->visitorDetails = $visitorDetails;
        $this->visitorNumber = $visitorNumber;
    }

    public function build()
    {
        return $this->view('emails.visit_booked')
                    ->with([
                        'visitorDetails' => $this->visitorDetails,
                        'visitorNumber' => $this->visitorNumber,
                    ]);
    }
}
