<?php

namespace App\Mail;

use App\Models\GiftCertificate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GiftCertificateSend extends Mailable
{
    use Queueable, SerializesModels;

    public $gift;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(GiftCertificate $gift)
    {
        $this->gift = $gift;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->gift->client_email, $this->gift->client_name)
                    ->subject('Gehwol Gift Certificate!')
                    ->view('emails.gift_certificate');
    }
}
