<div class="fixed  top-0 left-16 right-0 w-full h-20 px-16 py-4 justify-between items-center border-e bg-gray-100 border-black-900">
    <nav class="flex justify-between items-center h-10">
        <div>
            <a href="/"   class="">
                <img style="width: 50px;" src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
            </a>
        </div>
        <x-links class="space-x-6 font-bold"></x-links>
        @auth
            <x-right-nav-main></x-right-nav-main>
        @endauth
        @guest
            <x-right-nav></x-right-nav>
        @endguest

    </nav>
</div>
