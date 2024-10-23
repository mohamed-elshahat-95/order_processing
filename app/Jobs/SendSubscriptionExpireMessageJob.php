<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Helpers as GlobalHelpers;

class SendSubscriptionExpireMessageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $customer;
    private $expire_date;
    /**
     * Create a new job instance.
     */
    public function __construct($customer, $expire_date)
    {
        $this->customer = $customer;
        $this->expire_date = $expire_date;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        GlobalHelpers::sendMail('emails.subscription-expiration', $this->customer->email, 'Subscription has been expired', $this->customer->toArray());
    }
}
