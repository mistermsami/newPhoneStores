<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\ExpenseCategory;
use Livewire\WithPagination;

class ExpenseCategoryTable extends Component
{
    use WithPagination;

    public $perPage = 15;

    public $search = '';

    public $sortField = 'expenses_category_name';

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
        return view('livewire.tables.expense-category-table', [
            'ExpenseCategory' => ExpenseCategory::where("user_id", auth()->id())
                ->where('expenses_category_name', 'like', '%' . $this->search . '%')
                ->search($this->search)
                ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
                ->paginate($this->perPage)
        ]);
    }
}
