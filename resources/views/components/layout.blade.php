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
<body class="bg-ash-gray/40 text-blue4/80 h-screen bg-cover bg-center" style="background-image: url({{Vite::asset('resources/images/background1.jpeg')}})">

<div class="px-10">

    <nav class="flex justify-between items-center py-4 border-b border-white/10">
        <div>
            <a href="/"   class="">
                <img style="width: 50px;" src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
            </a>
        </div>
        <x-links class="space-x-6 font-bold"></x-links>
        <x-right-nav></x-right-nav>
    </nav>


<main class="mt-10 max-w-[800px]">
    {{ $slot }}
</main>



</div>
<x-footer class="mt-10 "></x-footer>

</body>

</html>
