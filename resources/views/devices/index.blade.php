@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$devices)
            <x-empty title="No devices found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your first Device') }}" button_route="{{ route('devices.create') }}" />
        @else
            <div class="container-xl">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h3 class="mb-1">Success</h3>
                        <p>{{ session('success') }}</p>

                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif
                @livewire('tables.devices-table')
            </div>
        @endif
    </div>
@endsection
