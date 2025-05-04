@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$repairParts)
            <x-empty title="No repair parts found"
                message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your first repair part') }}" button_route="{{ route('repair-parts.create') }}" />
        @else
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h3 class="mb-1">Success</h3>
                        <p>{{ session('success') }}</p>

                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif
                @livewire('tables.repair-parts-table')
            </div>
        @endif
    </div>
@endsection
