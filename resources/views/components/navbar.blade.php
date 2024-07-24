<div class="px-20">
    <nav class="flex justify-between items-center py-4 border-b border-white/10">
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
