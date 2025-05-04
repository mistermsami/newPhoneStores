<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderStatus;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderCompleteController extends Controller
{
    public function __invoke(Request $request)
    {
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier') {
        $orders = Order::where('order_status', OrderStatus::COMPLETE)
            ->latest()
            ->with('customer')
            ->get();
        }
        else {
            $orders = Order::where('order_status', OrderStatus::COMPLETE)
            ->latest()
            ->where("user_id", auth()->id())
            ->with('customer')
            ->get();
        }

        return view('orders.complete-orders', [
            'orders' => $orders
        ]);
    }
}
