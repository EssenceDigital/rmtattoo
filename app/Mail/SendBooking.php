<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;

class SendBooking extends Mailable
{
    use Queueable, SerializesModels;
    public $messageDetails;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $messageDetails)
    {
        $this->messageDetails = $messageDetails;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from($this->messageDetails['from'], 'rmt.website.no.reply')
              ->subject('RMT Website | Booking Request')
              ->view('emails.booking');

        return $this;
    }
}
