<div class="fixed top-10 bottom-0 left-0 flex-col justify-between border-r h-screen bg-gray-100 shadow-lg transition-all duration-500 transform -translate-x-full peer-hover:translate-x-0 hover:translate-x-0 peer">
    <div class="sidebar px-4 py-16">
        <div class="flex items-center mb-8">
            <a href="{{ route('dashboard.index') }}" class="flex items-center">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                <span class="ml-2 text-lg font-semibold">ICT Register</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <ul class="space-y-1">
            <li>
                <a href="{{ route('dashboard.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Dashboard') }}
                </a>
            </li>

            @role('Staff')
            <li>
                <a href="{{ route('assets.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Assets') }}
                </a>
            </li>
            @endrole

            @role('Head Office')
            <li>
                <a href="{{ route('assets.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Assets') }}
                </a>
            </li>
            @endrole

            @role('System Admin')
            <li>
                <a href="{{ route('staff.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Staff') }}
                </a>
            </li>
            <li>
                <a href="{{ route('role.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Roles') }}
                </a>
            </li>
            <li>
                <a href="{{ route('permission.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Permissions') }}
                </a>
            </li>
            <li>
                <a href="{{ route('user.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Assign Role') }}
                </a>
            </li>
            <li>
                <a href="{{ route('offices.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Offices') }}
                </a>
            </li>
            @endrole

            @role('Asset Manager')
            <li>
                <a href="{{ route('vendor.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-200">
                    {{ __('Vendors') }}
                </a>
            </li>
            @endrole

            <!-- Dropdown for Asset Manager -->
            @role('Asset Manager')
            <li>
                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-200">
                        <span class="text-sm font-medium">Manage</span>
                        <svg class="h-5 w-5 transition-transform duration-300 group-open:-rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </summary>
                    <ul class="mt-2 space-y-1 px-4">
                        <li>
                            <a href="{{ route('assets.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-200">
                                {{ __('Assets') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('asset-standard.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-200">
                                {{ __('Standards') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('asset-status.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-200">
                                {{ __('Statuses') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('asset-category.index') }}" class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-200">
                                {{ __('Categories') }}
                            </a>
                        </li>
                    </ul>
                </details>
            </li>
            @endrole

            <li>
                <details class="group [&_summary::-webkit-details-marker]:hidden">
                    <summary
                        class="flex cursor-pointer items-center justify-between rounded-lg px-4 py-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                    >
                        <span class="text-sm font-medium"> Account </span>

                        <span class="shrink-0 transition duration-300 group-open:-rotate-180">
              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  viewBox="0 0 20 20"
                  fill="currentColor"
              >
                <path
                    fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"
                />
              </svg>
            </span>
                    </summary>

                    <ul class="mt-2 space-y-1 px-4">
                        <li>
                            <a
                                href="#"
                                class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                            >
                                Details
                            </a>
                        </li>

                        <li>
                            <a
                                href="#"
                                class="block rounded-lg px-4 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                            >
                                Security
                            </a>
                        </li>

                        <li>
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full rounded-lg px-4 py-2 text-sm font-medium text-gray-500 [text-align:_inherit] hover:bg-gray-100 hover:text-gray-700"
                                >
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </details>
            </li>
        </ul>
    </div>

    <!-- Footer Section -->
    <div class="sticky bottom-0 top- border-t border-gray-200 bg-gray-50">
        <a href="#" class="flex items-center gap-2 bg-white p-4 hover:bg-gray-100">
            <img
                alt=""
                src="https://images.unsplash.com/photo-1600486913747-55e5470d6f40?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                class="size-10 rounded-full object-cover"
            />
            <div>
                <p class="text-xs">
                    <strong class="block font-medium">
                        @if(Auth::user())
                            {{ Auth::user()->name }}
                        @else
                            Anonymous
                        @endif
                    </strong>
                    <span>
                        @if(Auth::user())
                            {{ Auth::user()->email }}
                        @else
                            unknown@example.com
                        @endif
                    </span>
                </p>
            </div>
        </a>
    </div>
</div>
