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

    public function __construct($visitorDetails, $visitNumber)
    {
        $this->visitorDetails = $visitorDetails;
        $this->visitNumber = $visitNumber;
    }

    public function build()
    {
        return $this->view('emails.host_visit_notification')
                    ->with([
                        'visitorDetails' => $this->visitorDetails,
                        'visitNumber' => $this->visitNumber,
                    ]);
    }
}
