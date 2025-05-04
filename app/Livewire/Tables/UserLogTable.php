<?php

namespace App\Livewire\Tables;

use App\Models\UsersLog;
use Livewire\Component;
use Livewire\WithPagination;

class UserLogTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $perPage = 15;
    public $search = '';
    public $sortField = 'date';
    public $sortAsc = false;
    public $uuid = '';

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }

        $this->sortField = $field;
    }

    public function mount($user)
    {
        $this->uuid = $user;
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Reset to the first page when search query changes
    }
    public function render()
    {
        $UsersLogs = UsersLog::with('user')
            ->whereHas('user', function ($query) {
                $query->where('uuid', $this->uuid);
            })
            ->when($this->search, function ($query) {
                return $query->search($this->search); // Assuming you have a search scope or method
            })
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        return view('livewire.tables.user-log-table', [
            'UsersLogs' => $UsersLogs
        ]);
    }
}
