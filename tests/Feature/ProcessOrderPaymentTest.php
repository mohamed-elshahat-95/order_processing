<?php

namespace Tests\Feature;

use App\Jobs\ProcessOrderPayment;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessOrderPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_order_status_changes()
    {
        $order = Order::create([
            'user_id' => 1,
            'amount' => 100.00,
            'status' => 'pending',
        ]);

        ProcessOrderPayment::dispatch($order->id);

        $this->artisan('queue:work --once');

        $order->refresh();

        $this->assertTrue(in_array($order->status, ['completed', 'failed']));
    }
}