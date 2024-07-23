<div>
    <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('TESTLINK1') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('TESTLINK2') }}
        </x-nav-link>
        @if(Auth::user())
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-nav-link>
        @endif
        @role('Staff')
        <x-nav-link :href="route('assets.index')" :active="request()->routeIs('assets.index')">
            {{ __('Assets') }}
        </x-nav-link>
        @endrole
        @role('Head Office')
        <x-nav-link :href="route('assets.index')" :active="request()->routeIs('assets.index')">
            {{ __('Assets') }}
        </x-nav-link>
        @endrole
        @role('System Admin')
        <x-nav-link :href="route('staff.index')" :active="request()->routeIs('staff.index')">
            {{ __('Staff')  }}
        </x-nav-link>
        <x-nav-link :href="route('role.index')" :active="request()->routeIs('role.index')">
            {{ __('Roles') }}
        </x-nav-link>
        <x-nav-link :href="route('permission.index')" :active="request()->routeIs('permission.index')">
            {{ __('Permissions') }}
        </x-nav-link>
        <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.index')">
            {{ __('Assign Role') }}
        </x-nav-link>
        <x-nav-link :href="route('offices.index')" :active="request()->routeIs('offices.index')">
            {{ __('Offices') }}
        </x-nav-link>
        @endrole
        @role('Asset Manager')
        <x-nav-link :href="route('vendor.index')" :active="request()->routeIs('vendor.index')">
            {{ __('Vendors') }}
        </x-nav-link>
        @endrole
    </div>
    @role('Asset Manager')
    <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                    <div>Manage</div>

                    <div class="ms-1">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('assets.index')">
                    {{ __('Assets') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('asset-standard.index')">
                    {{ __('Standards') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('asset-status.index')">
                    {{ __('Statuses') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('asset-category.index')">
                    {{ __('Categories') }}
                </x-dropdown-link>
            </x-slot>
        </x-dropdown>
    </div>

    @endrole


</div>
