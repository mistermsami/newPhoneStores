@props([
    'route'
])

<a href="{{ $route }}" {{ $attributes->class(['btn btn-icon btn-outline-success']) }}>
    <x-icon.csv/>
</a>
