<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $details;
    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        $params = $this->details;                
        return $this->subject($params['subject'])->from($params['from'])->view('includes.mail');        
    }
}
