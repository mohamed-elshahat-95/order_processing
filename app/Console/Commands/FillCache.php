<?php

namespace App\Console\Commands;

use App\Models\Customers;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FillCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fill-customers:cache';

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
            Cache::put('customer_id_'.$customer->id, $customer);
        }
        $this->info('Done...');
    }
}
