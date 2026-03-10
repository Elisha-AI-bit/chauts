@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-chalimbana-gold text-start text-base font-medium text-white bg-chalimbana-blue/90 focus:outline-none focus:bg-chalimbana-blue/80 transition duration-150 ease-in-out'
            : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-white/70 hover:text-white hover:bg-chalimbana-blue/80 hover:border-chalimbana-gold focus:outline-none focus:text-white focus:bg-chalimbana-blue/80 focus:border-chalimbana-gold transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
