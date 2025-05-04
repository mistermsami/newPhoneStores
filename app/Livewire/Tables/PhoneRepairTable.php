<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use \App\Models\PhoneRepair;
use Livewire\WithPagination;


class PhoneRepairTable extends Component
{
	use WithPagination;

	public $perPage = 5;
	public $selectedValue;
	public $search = '';

	public $sortField = 'phone_name';

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
		$phone_repairs = PhoneRepair::where("phone_repairs.user_id", auth()->id())
			->join('repair_parts', 'phone_repairs.repair_part_id', '=', 'repair_parts.id')
			->select('phone_repairs.*', 'repair_parts.name as repair_part_name')
			->search($this->search)
			->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
			->paginate($this->perPage);

		return view('livewire.tables.phone-repair-table', compact('phone_repairs'));
	}
}
