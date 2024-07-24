<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ICT Register</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="bg-ash-gray/40 text-black/80 h-screen bg-cover bg-center" style="background-image: url({{Vite::asset('resources/images/background1.jpeg')}})">

<div class="">

{{--    <x-sidebar-dynamic></x-sidebar-dynamic>--}}
    <x-sidebar></x-sidebar>
{{--        <x-sidebar-wide></x-sidebar-wide>--}}
    {{--    <x-vertical-menu ></x-vertical-menu>--}}
    <x-navbar></x-navbar>
<main class="mt-20 px-20">
    {{ $slot }}
</main>



</div>
<x-footer class="mt-10 "></x-footer>

</body>

</html>
