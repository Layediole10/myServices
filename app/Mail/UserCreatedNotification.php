<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $register;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $register)
    {
        $this->register = $register;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('layediole88@gmail.com')
            ->view('admin.email.sendEmail');
    }
}
