<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\Customer;

class SearchCustomerOrders extends Component
{
    use WithPagination;

    public $customerid = '';
    public $search = '';
    public $totalOrders = 0;

    public $orderUuid, $orderInvoiceNo, $orderCudtomerId;
    // protected $queryString = ['search', 'customerid']; //if you want to keep the search and customerid in the URL

    public function OderSelected($orderUuid, $orderInvoiceNo, $orderCudtomerId)
    {
        // Dispatch to other components
        $this->dispatch('order-selected', [
            'orderUuid' => $orderUuid,
            'orderInvoiceNo' => $orderInvoiceNo,
            'orderCudtomerId' => $orderCudtomerId
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCustomerid()
    {
        $this->resetPage();
    }

    public function render()
{
    $customers = Customer::select('id', 'name')->get();
    $orders = collect(); // Empty collection by default
    $this->totalOrders = 0;

    if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier') {
        if ($this->customerid) {
            $ordersQuery = Order::with(['customer', 'details', 'user'])
                ->where('order_status', '!=', 2)
                ->where('customer_id', $this->customerid);

            if ($this->search) {
                $ordersQuery->where(function ($query) {
                    $query->where('invoice_no', 'like', '%' . $this->search . '%');
                });
            }

            $orders = $ordersQuery->get();

            $this->totalOrders = $orders->count();
        }

        return view('livewire.search-customer-orders', [
            'orders' => $orders,
            'customers' => $customers,
            'selectedCustomer' => $this->customerid,
            'totalOrders' => $this->totalOrders,
        ]);
    }

    // abort(403); // Unauthorized
}
}
