<?php

namespace App\Livewire\Tables;

use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class SubcategoryTable extends Component
{
	use WithPagination;

	public $perPage = 5;

	public $search = '';

	public $sortField = 'sub_category_name';

	public $sortAsc = false;

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

		return view('livewire.tables.subcategory-table', [
			'subcategories' => SubCategory::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
				->where('sub_category_name', 'like', '%' . $this->search . '%')
				->paginate($this->perPage)

		]);
	}
}
