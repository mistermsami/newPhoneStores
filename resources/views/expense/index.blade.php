@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$Expense)
            <x-empty title="No Expense found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your Expense') }}" button_route="{{ route('expenses.create') }}" />  
        @else
            <div class="container-xl">
                <x-alert />
                @livewire('tables.expense-table')
            </div>
        @endif
    </div>
@endsection
