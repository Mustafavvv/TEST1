<?php

namespace App\Listeners;

use SCart\Core\Events\OrderUpdateStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProcessOrderUpdateStatus
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderUpdateStatus  $event
     * @return void
     */
    public function handle(OrderUpdateStatus $event)
    {
        $order = $event->order;
        // \Log::error($order);
        //Add notice (from SC 8.1)
        sc_notice_add('sc_order_update_status', $order->id);
    }
}
