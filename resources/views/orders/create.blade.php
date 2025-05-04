@extends('layouts.tabler')

@section('content')
    @livewire('create-new-order')
@endsection

@pushonce('page-scripts')
    <script src="{{ asset('assets/js/img-preview.js') }}"></script>
@endpushonce
