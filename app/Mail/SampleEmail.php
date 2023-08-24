<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SampleEmail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public  $subject;
    public  $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $subject, string $message)
    {
        $this->subject = $subject;
        $this->message = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject=$this->subject;
        $msg=$this->message;
        return $this->view('emails.sample',compact("subject","msg")); // Create a view file in resources/views/emails/welcome.blade.ph
    }
}
