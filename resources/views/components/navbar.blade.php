@props(['pageName','sectionName'])
<div class="fixed top-0 left-16 right-0 w-full px-16 justify-between items-center border-e bg-gray-100 border-black-900">
    <nav class="flex justify-between items-center h-10 -translate-x-10">
        <div class="border-gray-600">
            <a href="/" class="">
                <img style="width: 25px;" src="{{ Vite::asset('resources/images/logo.png') }}" alt="">
            </a>
        </div>
        <x-breadcrumbs class="-translate-x-full" :sectionName="$sectionName" :pageName="$pageName"></x-breadcrumbs>
        {{--        <x-links class="space-x-6 font-bold"></x-links>--}}
        <div class="flex right-0 top-0">
            <input type="checkbox" id="search-toggle" class="absolute sr-only peer" checked>
            <label for="search-toggle" class="cursor-pointer translate-x-80 peer-checked:translate-x-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 15.75-2.489-2.489m0 0a3.375 3.375 0 1 0-4.773-4.773 3.375 3.375 0 0 0 4.774 4.774ZM21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </label>
            <div class="absolute top-0 w-1/4 block -translate-x-8 peer-checked:hidden">
                <x-forms.form action="/search" class="top-0 w-full text-xs xl:text-sm">
                    <x-forms.input :label="false" name="q" placeholder="Search..." />
                </x-forms.form>
            </div>
        </div>
        @auth
            <x-right-nav-main></x-right-nav-main>
        @endauth
        @guest
            <x-right-nav></x-right-nav>
        @endguest

    </nav>
</div>
