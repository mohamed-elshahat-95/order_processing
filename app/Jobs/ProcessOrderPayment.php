<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessOrderPayment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $orderId;

    public function __construct($orderId)
    {
        $this->orderId = $orderId;
    }

    public function handle()
    {
        $order = Order::find($this->orderId);
        if (!$order) {
            return;
        }

        $order->status = 'processing';
        $order->save();

        sleep(2);

        if (rand(0, 1)) {
            $order->status = 'completed';
            Log::info("Order {$this->orderId} processed successfully.");
        } else {
            $order->status = 'failed';
            Log::error("Order {$this->orderId} failed to process.");
        }

        $order->save();
    }
}