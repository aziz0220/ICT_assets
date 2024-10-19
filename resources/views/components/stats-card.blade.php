<section class="dark:bg-gray-900">
    <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 md:py-16 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl dark:text-white">
                {{ Auth::user()->getRoleNames()->first() }}'s Dashboard
            </h2>
            <p class="mt-4 text-gray-500 sm:text-xl dark:text-gray-400">
                Overview of the key statistics and pending tasks.
            </p>
        </div>
        <div class="mt-8 sm:mt-12">
            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                <div class="flex flex-col rounded-lg border border-gray-100 px-4 py-8 text-center dark:border-gray-800 hover:bg-gray-100">
                    <dt class="order-last text-lg font-medium text-gray-500 dark:text-gray-400">
                        Total Assets
                    </dt>
                    <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $totalAssets }}</dd>
                </div>
                <div class="flex flex-col rounded-lg border border-gray-100 px-4 py-8 text-center dark:border-gray-800 hover:bg-gray-100">
                    <dt class="order-last text-lg font-medium text-gray-500 dark:text-gray-400">
                        Pending Problems
                    </dt>
                    <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $pendingProblems->count() + 15 }}</dd>
                </div>

                <div class="flex flex-col rounded-lg border border-gray-100 px-4 py-8 text-center dark:border-gray-800 hover:bg-gray-100">
                    <dt class="order-last text-lg font-medium text-gray-500 dark:text-gray-400">
                        Pending Maintenances
                    </dt>
                    <dd class="text-4xl font-extrabold text-blue-600 md:text-5xl">{{ $pendingMaintenances->count() + 9}}</dd>
                </div>
            </dl>
        </div>
    </div>
</section>
