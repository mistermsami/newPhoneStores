@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Create repair parts.') }}
                        </h3>
                    </div>
                    <div class="card-actions">
                        <x-action.close route="{{ route('repair-parts.index') }}" />
                    </div>
                </div>
                <form method="POST" action="{{ route('repair-parts.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="col-md-12">
                            <x-input name="name" label='Part name' id="name" value="{{ old('name') }}" />
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <x-button type="submit">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
