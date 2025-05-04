<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class UserCustomers extends Component
{
    use WithPagination;
    // protected $paginationTheme = 'bootstrap';

    public $perPage = 15;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = 'desc';
    public $userId;
    public $userName;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to the first page when search query changes
    }

    #[On('user-selected')]
    public function handleOrderSelected($data)
    {
        // dd($data);
        $this->userId = $data['userId'];
        $this->userName = $data['userName'];
        // $this->render();
    }
    public function render()
    {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'superAdmin') {
            $customers = Customer::with('orders', 'quotations')
            ->where('user_id', $this->userId)
            ->search($this->search)
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

            return view('livewire.user-customers', [
                'customers' => $customers,
                'userName' => $this->userName,
            ]);
        }
    }
}
