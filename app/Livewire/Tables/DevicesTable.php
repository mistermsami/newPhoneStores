<?php

namespace App\Livewire\Tables;

use App\Models\Device;
use Livewire\Component;
use Livewire\WithPagination;

class DevicesTable extends Component
{
	use WithPagination;

	public $perPage = 15;

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
		return view('livewire.tables.devices-table', [
			'devices' => Device::where("user_id", auth()->id())
				->search($this->search)
				->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
				->paginate($this->perPage)
		]);
	}
}
