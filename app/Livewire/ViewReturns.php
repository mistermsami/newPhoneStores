<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ReturnProduct;
use Livewire\Attributes\On;

class ViewReturns extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = 15;
    public $changeEvents;
    public $sortField = 'id';
    public $sortAsc = false;
    public $search = '';

    // #[On('product-returned')]
    // public function refreshProducts()
    // {
    //     $this->render();
    //     // nothing inside - Livewire automatically re-renders the component on method call
    // }
    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }
    public function render()
    {
        if (auth()->user()->role === 'admin') {
            $returns = ReturnProduct::with('order', 'product')
                ->where(function ($query) {
                    $query->where('invoice_no', 'like', '%' . $this->search . '%');
                })
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);
        } else {
            $returns = [];
        }
        return view('livewire.view-returns', [
            'returns' => $returns,
        ]);
    }
}
