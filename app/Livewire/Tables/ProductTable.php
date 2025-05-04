<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class ProductTable extends Component
{
	use WithPagination;
	protected $paginationTheme = 'bootstrap';

	public $perPage = 15;
	public $selectedValue; 

	public $sortField = 'products.id';

	public $sortAsc = false; 

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to the first page when search query changes
    }
	public function sortBy($field): void
	{
		if ($this->sortField === $field) {
			$this->sortAsc = !$this->sortAsc;
		} else {
			$this->sortAsc = true;
		}

		$this->sortField = $field;
	}

	public $columns = [
        'image' => false,
        'sku' => true,
        'name' => true,
        'cost_price' => false,
        'sale_price' => true,
        'whole_sale_price' => true,
        'quantity' => false,
        'bar_code' => false,
        'item_type' => false, 
    ];

	public function toggleColumn($column)
	{
		$this->columns[$column] = !$this->columns[$column];
	}
	public function render()
	{
		$products = Product::search($this->search)
			->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
			->paginate($this->perPage);

		return view('livewire.tables.product-table', [
			'products' => $products
		]);
	}
}
