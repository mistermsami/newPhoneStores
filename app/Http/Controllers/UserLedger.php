<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class UserLedger extends Controller
{
    public function index(){
        if (auth()->user()->role === 'supplier' or auth()->user()->role !== 'supplier') {
			// dd("asd");
			$orders = Order::all()->count();
		} else {
			$orders = Order::where('user_id', auth()->id())->count();
		}
        return view('ledger.userledger', [
			'orders' => $orders
		]);
    }
}
