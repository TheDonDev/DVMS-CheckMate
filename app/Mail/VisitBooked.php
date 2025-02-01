<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitBooked extends Mailable
{
    use Queueable, SerializesModels;

    public $visitorDetails;
    public $visitNumber;

    public function __construct($visitorDetails, $visitNumber)
    {
        $this->visitorDetails = $visitorDetails;
        $this->visitNumber = $visitNumber;
    }

    public function build()
    {
        return $this->view('emails.visit_booked')
                    ->with([
                        'visitorDetails' => $this->visitorDetails,
                        'visitNumber' => $this->visitNumber,
                    ]);
    }
}
