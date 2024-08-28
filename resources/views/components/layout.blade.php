@props(['pageName','sectionName'])
<!doctype html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2/dist/umd/popper.js"></script>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@vx.x.x/dist/alpine.min.js" defer></script>
<html  lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ICT Register') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-ash-gray/40 text-black/80 h-screen bg-cover bg-center min-h-screen flex flex-col" style="background-image: url({{Vite::asset('resources/images/background1.jpeg')}})">
<x-background></x-background>
<div class="flex">
    <div class="fixed h-full">
{{--    <x-sidebar-dynamic></x-sidebar-dynamic>--}}
        @if(auth()->user())
        <x-toggle-button></x-toggle-button>
        <x-sidebar-wide></x-sidebar-wide>
        <x-sidebar></x-sidebar>
        @endif
    </div>
    <div class="ml-16 w-full">
        <x-navbar :sectionName="$sectionName"  :pageName="$pageName"></x-navbar>
        <main class="mt-20 px-20
        @guest()
        pt-16
        @endguest
        mb-16">
            <x-alerts.alert></x-alerts.alert>
            {{ $slot }}
        </main>
    </div>
</div>
<div class="flex-grow"></div>
<x-footer></x-footer>

</body>

</html>
