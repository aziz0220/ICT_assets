@props(['asset', 'size' => 'small'])

@php
    $classes = "bg-black/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300";

    if ($size === 'base') {
        $classes .= " px-5 py-1/2 text-sm";
    }

    if ($size === 'small') {
        $classes .= " px-1 py-1/2 text-1xs";
    }
@endphp

<a href="" class="{{ $classes }}">{{ ucwords($asset) }}</a>
