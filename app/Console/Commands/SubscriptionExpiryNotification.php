<?php

namespace App\Console\Commands;

use App\Jobs\SendSubscriptionExpireMessageJob;
use App\Models\Customers;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SubscriptionExpiryNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:SubscriptionExpiryNotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expired_customers = Customers::where('subscription_end_date', '<', now())->get();
        foreach ($expired_customers as $customer) {
            $expire_date = Carbon::createFromFormat('Y-m-d', $customer->subscription_end_date)->toDateString();
            dispatch(new SendSubscriptionExpireMessageJob($customer, $expire_date));
        }
    }
}
