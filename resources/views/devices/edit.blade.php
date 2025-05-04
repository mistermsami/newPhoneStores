@extends('layouts.tabler')

@section('content')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">
                            {{ __('Edit Device') }}
                        </h3>
                    </div>

                    <div class="card-actions">
                        <x-action.close route="{{ route('devices.index') }}" />
                    </div>
                </div>
                <form action="{{ route('devices.update', $device->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <div class="card-body">
                        <x-input label="{{ __('Device Name') }}" id="device_name" name="device_name" :value="old('device_name', $device->name)"
                            required />
                    </div>
                    <div class="card-footer text-end">
                        <x-button type="submit">
                            {{ __('Update') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@pushonce('page-scripts')
    {{-- <script>
        // Slug Generator
        const title = document.querySelector("#name");
        const slug = document.querySelector("#slug");
        title.addEventListener("keyup", function() {
            let preslug = title.value;
            preslug = preslug.replace(/ /g, "-");
            slug.value = preslug.toLowerCase();
        });
    </script> --}}
@endpushonce
