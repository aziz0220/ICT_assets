<x-layout :sectionName="__('Details')" :pageName="__('User')">


    <div class="flex justify-center">
        <article class="w-32 h-32 relative overflow-hidden rounded-full shadow transition hover:shadow-lg">
            <img
                alt=""
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                class="absolute inset-0 h-full w-full object-cover"
            />
            <div class="relative bg-gradient-to-t from-gray-900/50 to-gray-900/25 pt-32 sm:pt-48 lg:pt-64">
                <div class="p-4 sm:p-6">
                    <a href="#">
                        <h3 class="mt-0.5 text-lg text-white">{{ $user->name }}</h3>
                    </a>
                </div>
            </div>
        </article>
</div>
    <div class="flex justify-center">

        <a
            class="w-16 h-16 text-indigo-600 bg-indigo-50 rounded-full duration-150 hover:bg-indigo-100 active:bg-indigo-200 flex items-center justify-center translate-x-1/2 -translate-y-1/2"
            title="Back"
            href="{{ route('user.index') }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
            </svg>
        </a>


    <div class="w-1/2 flex md:justify-between flow-root rounded-lg border border-gray-100 py-3 shadow-sm bg-white justify-center items-center text-center">
        <dl class="-my-3 divide-y divide-gray-100 text-sm dark:divide-gray-700">
            <!-- Name -->
            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Name</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $user->name }}</dd>
            </div>
            <!-- Email -->
            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Email</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $user->email }}</dd>
            </div>
            <!-- Roles -->
            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Role</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                    @if(!empty($user->getRoleNames()->first()))
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">{{ $user->getRoleNames()->first() }}</span>
                    @else
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">No Role</span>
                    @endif
                </dd>
            </div>
            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Status</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">
                    @if(!$user->is_blocked)
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">Active</span>
                    @else
                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">Blocked</span>
                    @endif
                </dd>
            </div>
            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Creation Date</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $user->created_at }}</dd>
            </div>
            <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800">
                <dt class="font-medium text-gray-900 dark:text-white">Update Date</dt>
                <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $user->updated_at }}</dd>
            </div>
            @if($user->deleted_at)
                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800">
                    <dt class="font-medium text-gray-900 dark:text-white">Deletion Date</dt>
                    <dd class="text-gray-700 sm:col-span-2 dark:text-gray-200">{{ $user->deleted_at }}</dd>
                </div>
            @endif
        </dl>
    </div>

        <a
            class="w-16 h-16 text-indigo-600 bg-indigo-50 rounded-full duration-150 hover:bg-indigo-100 active:bg-indigo-200 flex items-center justify-center translate-y-80 -translate-x-1/2"
            title="Edit"
            href="{{ route('user.edit', $user->id) }}">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </a>

    </div>
</x-layout>
