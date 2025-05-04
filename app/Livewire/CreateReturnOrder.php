<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ReturnProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class CreateReturnOrder extends Component
{
    // public $products, $customers, $carts;
    protected $listeners = ['selectedOrder' => 'loadSelectedOrder'];
    public $orderUuid, $orderInvoiceNo, $orderCudtomerId;
    public $returnQuantities = [];

    public function RemoveItem($cartid)
    {
        Cart::remove($cartid);
        session()->flash('cartsuccess', 'The item has been removed from the cart.');
    }

    #[On('order-selected')]
    public function handleOrderSelected($data)
    {
        // dd($data);
        $this->orderUuid = $data['orderUuid'];
        $this->orderInvoiceNo = $data['orderInvoiceNo'];
        $this->orderCudtomerId = $data['orderCudtomerId'];
        // $order = Order::where('uuid', $this->orderUuid)->firstOrFail();
        // $this->render();
    }
    public function processReturn()
    {
        // Retrieve the order with its details
        $order = Order::where('uuid', $this->orderUuid)->with('details')->firstOrFail();

        $orderSubtotalAdjustment = 0;

        foreach ($order->details as $item) {
            // Get the return quantity from the input
            $returnQty = $this->returnQuantities[$item->id] ?? 0;

            // Only process returns if the quantity is valid (greater than 0 and not exceeding the ordered quantity)
            if ($returnQty > 0 && $returnQty <= $item->quantity) {
                // Calculate the return's subtotal
                $returnSubtotal = $returnQty * $item->unitcost;
                $orderSubtotalAdjustment += $returnSubtotal;

                // Check if return entry already exists for this product in the same order
                $existingReturn = ReturnProduct::where([['order_id', '=', $order->id], ['product_id', '=', $item->product_id]])->first();

                if ($existingReturn) {
                    // If the return record exists, just update the quantity and subtotal
                    $existingReturn->quantity += $returnQty;
                    $existingReturn->subtotal += $returnSubtotal;
                    $existingReturn->save();
                    // Dispatch to other components
                    // $this->dispatch('product-returned');
                } else {
                    // If no return record exists, create a new return record
                    ReturnProduct::create([
                        'order_id' => $order->id,
                        'invoice_no' => $this->orderInvoiceNo,
                        'customer_id' => $this->orderCudtomerId,
                        'product_id' => $item->product_id,
                        'quantity' => $returnQty,
                        'price' => $item->unitcost,
                        'subtotal' => $returnSubtotal,
                    ]);
                }
                // $this->dispatch('product-returned');

                // Update order details: decrease the product quantity and recalculate the total for the item
                $item->quantity -= $returnQty;
                $item->total = $item->quantity * $item->unitcost;
                $item->save();

                // Optional: Update the product's stock quantity (restocking)
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->quantity += $returnQty; // Restock the product
                    $product->save();
                }
            }
        }

        // After processing all returns, recalculate the order's subtotal and total
        $order->sub_total = $order->details->sum('total');
        $order->total = $order->sub_total + $order->vat;
        $order->due = $order->total - $order->pay;
        $order->save();

        // Flash a success message to the session
        session()->flash('successReturn', 'Return processed and order updated successfully.');
        $this->returnQuantities = [];
    }

    public function render()
    {
        $order = Order::where('uuid', $this->orderUuid)->first();
        if ($order) {
            $returnedProducts = ReturnProduct::where('order_id', $order->id)->get();
        } else {
            $returnedProducts = [];
        }

        return view('livewire.create-return-order', [
            'order' => $order,
            'returnedProducts' => $returnedProducts,
            'orderInvoice' => $this->orderInvoiceNo,
        ]);
    }
}
