<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Order;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Customerledger extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 15;
    public $search = '';
    public $userid = '';
    public $customerid = '';
    public $paymentStatus = '';
    public $paymentMethod = '';
    public $sub_total = '';
    public $total_due = '';
    public $total_payedamt = '';
    public $datefrom = null;
    public $dateto = null;

    public $totalOrders = 0;

    public $sortField = 'id';
    public $sortAsc = false;
    public $columns = [
        'payment' => true,
        'payto' => true,
        'user' => true,
        'status' => true,
        'actions' => true,
    ];

    public function toggleColumn($column)
    {
        $this->columns[$column] = !$this->columns[$column];
    }
    public function mount()
    {
        $this->userid = session('UserId', '');
        $this->customerid = '';
    }

    public function updatedUserid($value)
    {
        $this->userid = $value;
    }

    public function updatedCustomerid($value)
    {
        $this->customerid = $value;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $ordersQuery = Order::with(['customer', 'details', 'user'])->whereNot('order_status', '2');

        // Apply filters for admin or supplier roles
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'supplier') {
            // Filter by user ID if provided
            // if ($this->userid) {
            //     $ordersQuery->where('user_id', $this->userid);
            // }

            // Filter by customer ID if provided
            if ($this->customerid) {
                $ordersQuery->where('customer_id', $this->customerid)->whereNot('order_status', '2');
            }
            if ($this->paymentStatus) {
                if ($this->paymentStatus == 'allstatus') {
                    $ordersQuery->whereNot('order_status', '2');
                } else {
                    $ordersQuery->where('order_status', $this->paymentStatus)->whereNot('order_status', '2');
                }
            }
            if ($this->paymentMethod) {
                if($this->paymentMethod == 'allpayment'){
                $ordersQuery->whereNot('order_status', '2');
            }else{
                    $ordersQuery->where('payment_type', $this->paymentMethod)->whereNot('order_status', '2');
                }
            }
            // Apply date range filter if both dates are selected
            if ($this->datefrom && $this->dateto) {
                $ordersQuery->whereBetween(DB::raw('DATE(created_at)'), [$this->datefrom, $this->dateto])->whereNot('order_status', '2');
            }
        } else {
            // For regular users, filter only by their user ID
            $ordersQuery->where('user_id', auth()->id())->whereNot('order_status', '2');
        }

        // Apply search, sorting, and pagination
        $this->sub_total = $ordersQuery->sum('sub_total');
        $this->total_due = $ordersQuery->sum('total') - $ordersQuery->sum('pay');
        $this->total_payedamt = $ordersQuery->sum('pay');
        $orders = $ordersQuery
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        $users = User::get(['id', 'name']);
        $customers = Customer::get(['id', 'name']);

        $this->totalOrders = $orders->total();

        return view('livewire.customerledger', [
            'orders' => $orders,
            'users' => $users,
            'customers' => $customers,
            'ordersQuery' => $ordersQuery,
            'sub_total' => $this->sub_total,
            'total_due' => $this->total_due,
            'total_payedamt' => $this->total_payedamt,
            'totalOrders' => $this->totalOrders,
        ]);
    }
}
