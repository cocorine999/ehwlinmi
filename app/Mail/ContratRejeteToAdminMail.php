<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContratRejeteToAdminMail extends Mailable
{
    use Queueable, SerializesModels;
    
    protected $data;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("branlycaele1@gmail.com")->subject('Contrat Rejeté')
                    ->cc('branlycaele@gmail.com')
                    ->cc('adetoutou2014@gmail.com')
                    ->view('email.contrat_rejete_to_admins')->with('data', $this->data);
    }
}
