<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class NewRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $company;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $company)
    {
        $this->name = $name;
        $this->company = $company;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.newregistration');
    }
}
