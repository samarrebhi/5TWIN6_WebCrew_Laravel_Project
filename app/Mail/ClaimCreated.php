<?php

namespace App\Mail;

use App\Models\Claim;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClaimCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $claim;

    public function __construct(Claim $claim)
    {
        $this->claim = $claim;
    }

    public function build()
    {
        return $this->subject('Your Claim has been Created')
                    ->view('emails.claim_created'); // Assurez-vous d'avoir ce fichier de vue
    }
}
