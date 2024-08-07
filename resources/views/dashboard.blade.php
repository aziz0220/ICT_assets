<x-layout :sectionName="Auth::user()->getRoleNames()->first()" :pageName="__('Dashboard')">
    <section class="bg-white dark:bg-gray-900">
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 md:py-16 lg:px-8">
            <div class="mx-auto max-w-3xl text-center">
                <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                    {{ Auth::user()->getRoleNames()->first() }} Dashboard
                </h2>
                <p class="mt-4 text-gray-500 sm:text-xl dark:text-gray-400">
                    Overview of the key statistics and pending tasks.
                </p>
            </div>
            <div class="mt-8 sm:mt-12">
                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="flex flex-col rounded-lg border border-gray-100 px-4 py-8 text-center dark:border-gray-800">
                        <dt class="order-last text-lg font-medium text-gray-500 dark:text-gray-400">
                            Total Assets
                        </dt>
                        <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $totalAssets }}</dd>
                    </div>
                    <div class="flex flex-col rounded-lg border border-gray-100 px-4 py-8 text-center dark:border-gray-800">
                        <dt class="order-last text-lg font-medium text-gray-500 dark:text-gray-400">
                            Pending Problems
                        </dt>
                        <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $pendingProblems->count() }}</dd>
                    </div>

                    <div class="flex flex-col rounded-lg border border-gray-100 px-4 py-8 text-center dark:border-gray-800">
                        <dt class="order-last text-lg font-medium text-gray-500 dark:text-gray-400">
                            Pending Maintenances
                        </dt>
                        <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $pendingMaintenances->count() }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>
    <section x-data="{ open: false }">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <button @click="open = !open" class="bg-gray-500 text-white px-4 py-2 rounded">
                    <span x-show="!open">Show Details ▼</span>
                    <span x-show="open">Hide Details ▲</span>
                </button>
                <div x-show="open" x-cloak class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-4">
                    <div class="p-6 bg-white border-b border-gray-200">
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
                                            <!-- Add your actions here -->
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
                                            <!-- Add your actions here -->
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
</x-layout>
