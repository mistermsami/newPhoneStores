@extends('layouts.tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center mb-3">
                <div class="col">
                    <h2 class="page-title">
                        {{ __('Edit Rota') }}
                    </h2>
                </div>
            </div>

            @include('partials._breadcrumbs', ['model' => $thisaddress])
            @php
                // dd($thisaddress->address_id)
            @endphp
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                @livewire('edit-address',['thisaddress_id' => $thisaddress->address_id])
            </div>
        </div>
    </div>
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
