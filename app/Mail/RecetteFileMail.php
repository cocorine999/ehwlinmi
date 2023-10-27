<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecetteFileMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $path;
    protected $filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($filename)
    {
        #$this->path = $path;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->attach(storage_path().'/app/'.$this->filename)->subject('RECETTES EHWHLINMI')->view('email.recettes');
    }
}
