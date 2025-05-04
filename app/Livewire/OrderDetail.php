<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\OrderDetails;

class OrderDetail extends Component
{
    public $details_id;
    public $productquantity;
    public $productprice;
    public $product_id;

    public function submitData()
    {
        $this->validate([
            "productquantity" => "required",
        ]);

        // Debugging
        dd($this->productprice, $this->productquantity);

        // Updating product details
        OrderDetails::where('id', $this->product_id)->update([
            'quantity' => $this->productquantity,
            'unitcost' => $this->productprice,
        ]);
    }

    public function mount($details_id)
    {
        $this->details_id = $details_id;
    }

    public function render()
    {
        $productorderdetails = OrderDetails::where('id', $this->details_id)->first();
        return view('livewire.order-detail', ['thisorderdetail' => $productorderdetails]);
    }
}
