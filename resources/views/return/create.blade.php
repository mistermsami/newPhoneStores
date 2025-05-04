@extends('layouts.tabler')

@section('content')
    @livewire('create-return-order')
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
