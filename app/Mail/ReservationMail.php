<?php

namespace App\Mail;

use App\Models\Sesion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    // Include the sesion
    public $sesion;

    // Email subject title
    public $subject = 'Nueva reserva en Muscle Planet';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Sesion $sesion)
    {
        $this->sesion = $sesion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // This is the view it takes to send the email
        return $this->view('mail.reservation');
    }
}
