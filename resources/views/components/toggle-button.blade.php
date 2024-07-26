<div id="toggle-icon" class="peer top-0 left-0 w-16 h-10 cursor-pointer bg-gray-100 active:bg-gray-400">
    <a class="t group relative flex justify-center rounded px-2 py-1.5">
        @if(auth()->user())
        <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 hidden">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
        @endif
    </a>
</div>
<!-- component -->
{{--<div class="flex ">--}}
{{--    <input type="checkbox" id="drawer-toggle" class="relative sr-only peer" checked>--}}
{{--    <label for="drawer-toggle" class="absolute top-0 left-0 inline-block p-4 transition-all duration-500 bg-indigo-500 rounded-lg peer-checked:rotate-180 peer-checked:left-64">--}}
{{--        <div class="w-6 h-1 mb-3 -rotate-45 bg-white rounded-lg"></div>--}}
{{--        <div class="w-6 h-1 rotate-45 bg-white rounded-lg"></div>--}}
{{--    </label>--}}
{{--    <div class="fixed top-0 left-0 z-20 w-64 h-full transition-all duration-500 transform -translate-x-full bg-white shadow-lg peer-checked:translate-x-0">--}}
{{--        <div class="px-6 py-4">--}}
{{--            <h2 class="text-lg font-semibold">Drawer</h2>--}}
{{--            <p class="text-gray-500">This is a drawer.</p>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
