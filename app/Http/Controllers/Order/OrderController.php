<?php

namespace App\Http\Controllers\Order;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderStoreRequest;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use App\Models\ReturnProduct;
use App\Mail\StockAlert;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;
use Exception;
use Twilio\Rest\Client;

class OrderController extends Controller
{
	public function index()
	{
		if (auth()->user()->role === 'supplier' or auth()->user()->role !== 'supplier') {
			// dd("asd");
			$orders = Order::all()->count();
		} else {
			$orders = Order::where('user_id', auth()->id())->count();
		}

		return view('orders.index', [
			'orders' => $orders
		]);
	}
	public function create()
	{
		// $products = Product::where('user_id', auth()->id())->with(['category_id'])->get();
		$products = Product::with(['category_id'])->get();
		if (auth()->user()->role == 'admin' || auth()->user()->role == 'supplier') {
			$customers = Customer::get(['id', 'name']);
		} else {
			$customers = Customer::where('user_id', auth()->id())->get(['id', 'name']);
			// $customers = Customer::get(['id', 'name']);
		}
		$carts = Cart::content();
		return view('orders.create');
	}

	public function store(OrderStoreRequest $request)
	{
		$subtotal = str_replace(',', '', Cart::subtotal(2, '.', ','));
		$order = Order::create([
			'customer_id' => $request->customer_id,
			'payment_type' => $request->payment_type,
			'pay' => $request->pay,
			'note' => $request->note,
			'order_date' => Carbon::now()->format('Y-m-d'),
			'order_status' => OrderStatus::PENDING->value,
			'total_products' => Cart::count(),
			'sub_total' => $subtotal,
			//// 'vat' => Cart::tax(),
			'vat' => 0,
			'total' => $subtotal,
			'invoice_no' => IdGenerator::generate([
				'table' => 'orders',
				'field' => 'invoice_no',
				'length' => 10,
				'prefix' => 'INV-'
			]),
			// 'due' => ($request->pay),
			'due' =>  $subtotal - $request->pay,
			'user_id' => auth()->id(),
			'uuid' => Str::uuid(),
		]);

		// Create Order Details
		$contents = Cart::content();
		$oDetails = [];

		foreach ($contents as $content) {
			$oDetails['order_id'] = $order['id'];
			$oDetails['product_id'] = $content->id;
			$oDetails['quantity'] = $content->qty;
			$oDetails['unitcost'] = $content->price;
			$oDetails['total'] = $content->subtotal;
			$oDetails['created_at'] = Carbon::now();
			OrderDetails::insert($oDetails);
			// dd($oDetails);
		}

		// Delete Cart Sopping History
		Cart::destroy();
		/* customer session id remove */
		session()->forget('customer_id');
		session()->forget('customer_data');
		return redirect()
			->route('orders.index')
			->with('success', 'Order has been created!');
	}

	public function show($uuid)
	{
		$order = Order::where('uuid', $uuid)->firstOrFail();
		$order->loadMissing(['customer', 'details'])->get();
		return view('orders.show', [
			'order' => $order
		]);
	}

	public function update_payment_status($uuid, Request $request)
	{

		$order = Order::where('uuid', $uuid)->firstOrFail();
		$order->update([
			'payment_type' => $request->hidden_payment_type,
			'note' => $request->hidden_notes,
		]);

		return redirect()
			->route('orders.show', $uuid)
			->with('success', 'Payment type has been updated!');
	}

	public function update_order_payment($uuid, Request $request)
	{
		$order = Order::where('uuid', $uuid)->firstOrFail();
		$Duebill = $order->sub_total - $request->pay;
		$order->update([
			'due' => $Duebill,
			'pay' => $request->pay,
		]);
		return redirect()
			->route('orders.show', $uuid)
			->with('success', 'Payment has been updated!');
	}
	public function editsubmitedorder($id, Request $request)
	{
		// dd($request->all());
		$OrderDetails = OrderDetails::where('id', $id)->firstOrFail();
		$Order = Order::where('id', $request->order_id)->firstOrFail();
		$newunitcost = $request->unitcost;
		$newtotal = $request->quantity * $newunitcost;
		$OrderDetails->update(['quantity' => $request->quantity, 'unitcost' => $newunitcost, 'total' => $newtotal]);
		// dd($OrderDetails);
		if ($OrderDetails) {
			$AllOrderDetails = OrderDetails::where('order_id', $request->order_id)->get();
			$newTotalCost = $AllOrderDetails->sum('total');
			$Duebill = $newTotalCost - $Order->pay;
			$Order->update(['total' => $newTotalCost, 'sub_total' => $newTotalCost, 'due' => $Duebill]);
		}
		return redirect()
			->route('orders.show', $request->uuid)
			->with('success', 'Order has been Updated!');
	}
	public function update($uuid, Request $request)
	{

		ini_set('max_execution_time', 120);
		$order = Order::with(['customer', 'details'])->where('uuid', $uuid)->firstOrFail();

		$order = Order::where('uuid', $uuid)->firstOrFail();
		// TODO refactoring

		// Reduce the stock
		$products = OrderDetails::where('order_id', $order->id)->get();

		$stockAlertProducts = [];

		foreach ($products as $product) {
			$productEntity = Product::where('id', $product->product_id)->first();
			$newQty = $productEntity->quantity - $product->quantity;
			if ($newQty < $productEntity->quantity_alert) {
				$stockAlertProducts[] = $productEntity;
			}
			$productEntity->update(['quantity' => $newQty]);
		}

		if (count($stockAlertProducts) > 0) {
			$listAdmin = [];
			foreach (User::all('email') as $admin) {
				$listAdmin[] = $admin->email;
			}
			Mail::to($listAdmin)->send(new StockAlert($stockAlertProducts));
		}
		$operation = $order->update([
			'order_status' => OrderStatus::COMPLETE,
			// 'due' => '0',
			// 'pay' => $order->total
			'pay' => $order->pay
		]);
		$data = [
			"email" => $order->customer->email,
			"title" => "From pantherforce.co.uk",
			"body" => 'Invoice',
		];
		$pdf = PDF::loadView('emails.invoice', compact('order'));
		// dd($pdf);
		$send = Mail::send('emails.message', $data, function ($message) use ($data, $pdf) {
			$message->to($data["email"], $data["email"])
				->subject($data["title"])
				->attachData($pdf->output(), "Invoice.pdf", [
					'mime' => 'application/pdf',
				]);
		});
		$receiver_number = $order->customer->phone;
		$message = 'Invoice Details: ' . ' Total Amount: ' . $order->total . ' ' . ' Total Quantity: ' . $order->total_products . ' ' . 'Due Bill Any: ' . $order->due . 'Date: ' .  Carbon::now();
		try {
			$account_sid = getenv("TWILIO_SID");
			$auth_token = getenv("TWILIO_TOKEN");
			$twilio_number = getenv("TWILIO_FROM");
			/* for customer */
			$client = new Client($account_sid, $auth_token);
			$client->messages->create($receiver_number, [
				'from' => $twilio_number,
				'body' => $message
			]);
			/* for admin */
			$client->messages->create($twilio_number, [
				'from' => $twilio_number,
				'body' => $message
			]);
			return redirect()->back();
		} catch (Exception $e) {
		}
		return redirect()
			->route('orders.complete')
			->with('success', 'Order has been completed!');
	}

	public function destroy($uuid)
	{
		$order = Order::where('uuid', $uuid)->firstOrFail();
		$order->delete();
	}

	public function downloadInvoice($uuid)
	{
        $totalreturns = 0;
        $thissubtotal = 0;

		$order = Order::with(['customer', 'details'])->where('uuid', $uuid)->firstOrFail();
        $returnProtucts = ReturnProduct::where('order_id', $order->id)->get();
        $totalreturns = $returnProtucts->sum('subtotal');
        $thissubtotal = $order->total + $totalreturns;
		// TODO: Need refactor
		//dd($order);

		//$order = Order::with('customer')->where('id', $order_id)->first();
		// $order = Order::
		//     ->where('id', $order)
		//     ->first();

		return view('orders.print-invoice', [
			'order' => $order,
            'totalreturns' => $totalreturns,
            'thissubtotal' => $thissubtotal,

		]);
	}
	public function downloadAdminInvoice($uuid)
	{
        $totalreturns = 0;
        $thissubtotal = 0;

		$order = Order::with(['customer', 'details'])->where('uuid', $uuid)->firstOrFail();

        $returnProtucts = ReturnProduct::where('order_id', $order->id)->get();
        $totalreturns = $returnProtucts->sum('subtotal');
        $thissubtotal = $order->total + $totalreturns;
		// TODO: Need refactor
		//dd($order);

		//$order = Order::with('customer')->where('id', $order_id)->first();
		// $order = Order::
		//     ->where('id', $order)
		//     ->first();
        // dd($order->details->product);

		return view('orders.admin-print-invoice', [
			'order' => $order,
            'totalreturns' => $totalreturns,
            'thissubtotal' => $thissubtotal,
		]);
	}

	public function cancel(Order $order)
	{
		$order->update([
			'order_status' => 2
		]);
		$orders = Order::where('user_id', auth()->id())->count();

		return redirect()
			->route('orders.index', [
				'orders' => $orders
			])
			->with('success', 'Order has been canceled!');
	}
	public function deleteitems($orderdetailsid, Request $request)
	{
		$OrderDetails = OrderDetails::where('id', $orderdetailsid)->firstOrFail();
		$OrderDetails->delete();
		if ($OrderDetails) {
			/* update total price in order table once the product delete form orderdetails table */
			$Order = Order::where('uuid', $request->uuid)->firstOrFail();
			$newTotalCost = 0;
			$Duebill = 0;
			$TotalProducts = 0;
			$AllOrderDetails = OrderDetails::where('order_id', $request->order_id)->get();
			foreach ($AllOrderDetails as $AllOrderDetail) {

				$newTotalCost +=  $AllOrderDetail->quantity * $AllOrderDetail->unitcost;
				$TotalProducts =  $TotalProducts++;
			}
			// $AllOrderDetail->sum('unitcost');
			// dd($newTotalCost );
			$Duebill = $newTotalCost - $Order->pay;
			$Order->update(['total' => $newTotalCost, 'sub_total' => $newTotalCost, 'total_products' => $TotalProducts, 'due' => $Duebill]);
		}
		return redirect()
			->route('orders.show', $request->uuid)
			->with('success', 'Order has been deleted!');
	}
}
