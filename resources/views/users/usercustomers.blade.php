@extends('layouts.tabler')

@section('content')
<div class="page-body">
    <div class="container-xl">

        @livewire('user-select')
        @livewire('user-customers')
    </div>
</div>
@endsection
