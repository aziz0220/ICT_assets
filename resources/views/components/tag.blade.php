@props(['asset', 'size' => 'small', 'href'])

@php
    $classes = "bg-black/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300 whitespace-nowrap rounded-full border border-honolulu-blue-500 px-2.5 py-0.5 text-sm text-purple-700 shadow-honolulu-blue  dark:text-purple-100";
//    $classes = "bg-black/10 hover:bg-white/25 rounded-xl font-bold transition-colors duration-300 whitespace-nowrap rounded-full border border-honolulu-blue-500 px-2.5 py-0.5 text-sm text-purple-700 dark:text-purple-100";

    if ($size === 'base') {
        $classes .= " px-5 py-1/2 text-sm";
    }

    if ($size === 'small') {
        $classes .= " px-1 py-1/2 text-1xs";
    }
@endphp

<a href="{{$href}}" class="{{ $classes }}">{{ ucwords($asset) }}</a>
