@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Create Device') }}
                        </h3>
                    </div>
                    <div class="card-actions">
                        <x-action.close route="{{ route('devices.index') }}" />
                    </div>
                </div>
                <form method="POST" action="{{ route('devices.store') }}">
                    @csrf
                    <div class="card-body">
                        <x-input label="Device Name" name="device_name" id="device_name" value="{{ old('device_name') }}"
                            required />
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
