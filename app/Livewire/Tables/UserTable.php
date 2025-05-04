<?php

namespace App\Livewire\Tables;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $perPage = 15;

    public $search = '';

    public $sortField = 'id';

    public $sortAsc = true;

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
        if (auth()->user()->role == 'admin'){
            // dd(auth()->user()->wearhouse_id);
            $users = User::with('wearhouselocations')
                ->where('wearhouse_id', auth()->user()->wearhouse_id)
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);
        }
        else{
            $users = User::with('wearhouselocations')
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);
        }
        return view('livewire.tables.user-table', [
            'users' => $users,
        ]);
    }
}
