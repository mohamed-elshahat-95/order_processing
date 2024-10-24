<?php

namespace App\Console\Commands;

use App\Models\Customers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class FillRedis extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill-customers:redis';

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
        $customers = Customers::get();
        foreach ($customers as $customer) {
            Redis::set('customer_id_'.$customer->id, $customer);
        }
        $this->info('Done...');
    }
}
