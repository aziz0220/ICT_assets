<section x-data="{ open: false }">
    <div class="flex justify-center place-items-center">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <button @click="open = !open" class="text-gray-500 bg-gray-100 border-gray-50 hover:text-blue-600 hover:bg-gray-100 px-4 py-2 rounded-full ">
                <span x-show="!open" title="Show Details">▼</span>
                <span x-show="open" title="Hide Details">▲</span>
            </button>
            <div x-show="open" x-cloak class="overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 border-b border-gray-50">
                    @role('Staff|Asset Manager|Head Office')
                    @if($pendingProblems->isNotEmpty())
                        <h3 class="font-bold text-xl mt-8">Pending Asset Problems</h3>
                        <table class="table-auto w-full mt-4">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Description</th>
                                <th class="px-4 py-2 text-left">Asset</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pendingProblems as $problem)
                                <tr class="bg-gray-100 dark:bg-gray-800">
                                    <td class="border px-4 py-2">{{ $problem->description }}</td>
                                    <td class="border px-4 py-2">{{ $problem->asset->asset_name }}</td>
                                    <td class="border px-4 py-2">
                                        @role('Staff')
                                        <form action="{{ route('asset_problems.destroy', $problem->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                                title="Cancel problem request"
                                                type="submit"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endrole
                                        @role('Head Office')
                                        <form action="{{ route('asset_problems.approve', $problem->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800" title="Approve problem">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                            </button>
                                        </form>

                                        @endrole
                                        @role('Asset Manager')
                                        <a
                                            class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                            title="Resolve problem"
                                            href="{{ route('asset_problems.resolve', $problem->id) }}"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                                            </svg>
                                        </a>
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mt-4">No pending problems.</p>
                    @endif
                    @if($pendingMaintenances->isNotEmpty())
                        <h3 class="font-bold text-xl mt-8">Pending Asset Maintenances</h3>
                        <table class="table-auto w-full mt-4">
                            <thead>
                            <tr>
                                <th class="px-4 py-2 text-left">Description</th>
                                <th class="px-4 py-2 text-left">Asset</th>
                                <th class="px-4 py-2 text-left">Status</th>
                                <th class="px-4 py-2 text-left">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($pendingMaintenances as $maintenance)
                                <tr class="bg-gray-100 dark:bg-gray-800">
                                    <td class="border px-4 py-2">{{ $maintenance->description }}</td>
                                    <td class="border px-4 py-2">{{ $maintenance->asset->asset_name }}</td>
                                    <td class="border px-4 py-2">{{ $maintenance->status }}</td>
                                    <td class="border px-4 py-2">
                                        @role('Staff')
                                        <form action="{{ route('asset_maintenances.destroy', $maintenance->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                                                title="Cancel maintenance request"
                                                type="submit"
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endrole
                                        @role('Head Office')
                                        <form action="{{ route('asset_maintenances.approve', $maintenance->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800" title="Approve maintenance">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                                </svg>

                                            </button>
                                        </form>
                                        @endrole
                                        @role('Asset Manager')
                                        <form action="{{ route('asset_maintenances.resolve', $maintenance->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800" title="Resolve maintenance">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                                </svg>

                                            </button>
                                        </form>
                                        @endrole
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="mt-4">No pending maintenances.</p>
                    @endif
                    @endrole
                </div>
            </div>
        </div>
    </div>
</section>
