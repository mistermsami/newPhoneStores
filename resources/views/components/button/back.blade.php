@props([
    'route'
])

<x-button {{ $attributes->class(['btn btn-outline-info']) }} route="{{ $route }}">
    <x-icon.left/>
    {{ $slot }}
</x-button>
