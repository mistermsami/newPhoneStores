<?php

namespace App\Livewire\Tables;

use App\Models\RepairParts;
use Livewire\Component;
use Livewire\WithPagination;

class RepairPartsTable extends Component
{
	use WithPagination;

	public $perPage = 5;

	public $search = '';

	public $sortField = 'name';

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
		return view('livewire.tables.repair-parts-table', [
			'repairParts' => RepairParts::orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
				->where('name', 'like', '%' . $this->search . '%')
				->paginate($this->perPage)
		]);
	}
}
