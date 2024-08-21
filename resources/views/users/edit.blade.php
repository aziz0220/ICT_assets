<x-layout :sectionName="__('Edit')" :pageName="__('User')">

    <div class="flex justify-center">
        <article class="w-32 h-32 relative overflow-hidden rounded-full shadow transition hover:shadow-lg">
            <img
                alt=""
                src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=2&amp;w=256&amp;h=256&amp;q=80"
                class="absolute inset-0 h-full w-full object-cover"
            />
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
            <form action="{{ route('user.update', $user->id) }}" method="POST" class="w-full p-4">
                @csrf
                @method('PUT')
                <dl class="-my-3 divide-y divide-gray-100 text-sm dark:divide-gray-700">

                <!-- Name -->
                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800 items-center">
                    <label for="name" class="font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="text-gray-700 sm:col-span-2 dark:text-gray-200 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Name">
                </div>

                <!-- Email -->
                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800 items-center">
                    <label for="email" class="font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="text-gray-700 sm:col-span-2 dark:text-gray-200 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Email">
                </div>

                <!-- Password -->
                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800 items-center">
                    <label for="password" class="font-medium text-gray-900 dark:text-white">Password</label>
                    <input type="password" id="password" name="password" class="text-gray-700 sm:col-span-2 dark:text-gray-200 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Password">
                </div>

                <!-- Confirm Password -->
                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800 items-center">
                    <label for="confirm-password" class="font-medium text-gray-900 dark:text-white">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password" class="text-gray-700 sm:col-span-2 dark:text-gray-200 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Confirm Password">
                </div>

                <!-- Role -->
                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800 items-center">
                    <label for="roles" class="font-medium text-gray-900 dark:text-white">Role</label>
                    <select id="roles" class="text-gray-700 sm:col-span-2 dark:text-gray-200 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" multiple name="roles[]">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" @if($userRole && $userRole===$role) selected @endif>{{ $role }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Office -->
                <div class="grid grid-cols-1 gap-1 p-3 even:bg-gray-50 sm:grid-cols-3 sm:gap-1 even:dark:bg-gray-800 items-center" id="office-section" style="display: none;">
                    <label for="office_id" class="font-medium text-gray-900 dark:text-white">Office</label>
                    <select id="office_id" name="office_id" class="text-gray-700 sm:col-span-2 dark:text-gray-200 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach ($offices as $office)
                            <option value="{{ $office->id }}" @if($user->office_id == $office->id) selected @endif>{{ $office->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" class="w-16 h-16 text-indigo-600 bg-indigo-50 rounded-full duration-150 hover:bg-indigo-100 active:bg-indigo-200 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m-6 3.75 3 3m0 0 3-3m-3 3V1.5m6 9h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                        </svg>
                    </button>
                </div>
                </dl>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const rolesSelect = document.getElementById('roles');
            const officeSection = document.getElementById('office-section');

            rolesSelect.addEventListener('change', function () {
                const selectedRoles = Array.from(rolesSelect.options)
                    .filter(option => option.selected)
                    .map(option => option.value);

                if (selectedRoles.includes('Staff')) {
                    officeSection.style.display = 'block';
                } else {
                    officeSection.style.display = 'none';
                }
            });

            // Trigger the change event to show/hide the office section based on the pre-selected role
            rolesSelect.dispatchEvent(new Event('change'));
        });
    </script>

</x-layout>
