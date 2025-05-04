<?php

namespace App\Livewire;

use App\Models\Customer;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Livewire\Component;

class CustomerSelect extends Component
{
    public $customers;
    public $customer_id;
    public $customer_data;

    public function mount($customers)
    {
        $this->customers = $customers;
        // $this->customer_id = session('customer_id', '');
        $this->customer_data = session('customer_data', '');
    }
    public function changeEvent($customerId)
    {
        $this->customer_id = $customerId;
        $customers = Customer::where('id', $customerId)->firstOrFail();
        Session::put('customer_id', $customers->customer_type);
        Session::put('customer_data', $customerId);
        // Delete Cart Sopping History
        // Cart::destroy();
        $this->dispatch('customerChanged', customerId: $customers->customer_type);
    }

    public function render()
    {
        return view('livewire.customer-select', [
            'customer_data' => $this->customer_data,
        ]);
    }
}
