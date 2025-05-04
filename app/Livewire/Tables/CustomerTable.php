<?php

namespace App\Livewire\Tables;

use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use WithPagination; 
    // protected $paginationTheme = 'bootstrap';

    public $perPage = 15;

    public $search = '';

    public $sortField = 'name';

    public $sortAsc = 'desc';

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
    public function render()
    {
        if (auth()->user()->role == 'admin' || auth()->user()->role == 'customer') {

            return view('livewire.tables.customer-table', [
                'customers' => Customer::with('orders', 'quotations') 
                    ->search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage)
            ]);
        } else {
            return view('livewire.tables.customer-table', [
                'customers' => Customer::with('orders', 'quotations')
                    ->where('user_id', auth()->user()->id)
                    ->search($this->search)
                    ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                    ->paginate($this->perPage)
            ]);
        }
    }
}
