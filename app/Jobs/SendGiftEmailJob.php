<?php

namespace App\Jobs;

use App\Mail\GiftCertificateSend;
use App\Models\GiftCertificate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendGiftEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $giftIds;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($giftIds)
    {
        $this->giftIds = $giftIds;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $gifts = GiftCertificate::whereIn('id', $this->giftIds)->get();
        foreach ($gifts as $gift) {
            $email = new GiftCertificateSend($gift);
            Mail::to($gift->recipient_email)->send($email);
        }
    }
}
