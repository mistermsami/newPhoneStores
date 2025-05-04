<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination; // <<== Add this
use App\Models\User;

class UserSelect extends Component
{
    use WithPagination; // <<== Add this

    public $search = '';
    public $users = '';
    public $userId;
    public $userName;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function userSelected($userId, $userName)
    {
        // dd('here');
        // Dispatch to other components
        $this->dispatch('user-selected', [
            'userId' => $userId,
            'userName' => $userName,
        ]);
    }
    public function render()
    {
        if (auth()->user()->role === 'admin' || auth()->user()->role === 'superAdmin') {
            if (empty($this->search)) {
                $ordersQuery = User::where('wearhouse_id', auth()->user()->wearhouse_id)->get();
            }
            if ($this->search) {
                $ordersQuery = User::where('name', 'like', '%' . $this->search . '%')->get();
            }
            $this->users = $ordersQuery;
        }
        return view('livewire.user-select', [
            'users' => $this->users,
        ]);
    }
}
