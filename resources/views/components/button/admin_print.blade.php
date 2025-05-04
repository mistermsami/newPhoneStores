@props([
    'route'
]) 
<x-button {{ $attributes->class(['btn btn-outline-danger']) }} route="{{ $route }}">
    <x-icon.printer/>  
    {{ $slot }}
</x-button>
