@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$ExpenseCategories)
            <x-empty title="No Expense Category found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your Expense Category') }}" button_route="{{ route('expensescategory.create') }}" />  
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.expense-category-table')
            </div>
        @endif
    </div>
@endsection
