@props([
    'route'
])

<x-button {{ $attributes->class(['btn btn-outline-warning']) }} route="{{ $route }}">
    <x-icon.map/>
    {{ $slot }}
</x-button>
