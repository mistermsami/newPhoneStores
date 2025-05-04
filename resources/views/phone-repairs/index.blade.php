@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        @if (!$repairs)
            <x-empty title="No phones found" message="Try adjusting your search or filter to find what you're looking for."
                button_label="{{ __('Add your phone repair') }}" button_route="{{ route('phone-repairs.create') }}" />
        @else
            <div class="container-xl">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <h3 class="mb-1">Success</h3>
                        <p>{{ session('success') }}</p>

                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif
                <livewire:tables.phone-repair-table />
            </div>
        @endif
    </div>
@endsection
