<tr class="odd:bg-gray-50" id="add-new">
    <form hx-post="{{ route('offices.store') }}" hx-target="this" hx-swap="delete">
        @csrf
        <td class="inset-y-0 start-0 bg-white px-4 py-2">
        </td>
        <td class="inset-y-0 start-0 bg-white px-4 py-2">
            <label for="name"   class="hidden relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">Name:</label>
            <input type="text" name="name" class="form-control rounded-full peer border-none  placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0" placeholder="Name">
        </td>
        <td class="inset-y-0 start-0 bg-white px-4 py-2">
            <label for="location" class="hidden relative block rounded-md border border-gray-200 shadow-sm focus-within:border-blue-600 focus-within:ring-1 focus-within:ring-blue-600">Location:</label>
            <input type="text" name="location" class="form-control rounded-full peer border-none  placeholder-transparent focus:border-transparent focus:outline-none focus:ring-0" placeholder="Location">
        </td>
        <td class="inset-y-0 start-0 bg-white px-4 py-2">
        </td>
        <td class="inset-y-0 start-0 bg-white px-4 py-2">
            <div class="flex items-center justify-center space-x-2">
                <button type="submit" title="Add Office" class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
                <button
                    type="button"
                    title="Cancel"
                    hx-trigger="click"
                    hx-remove="closest tr"
                    class="inline-block border-e p-3 text-gray-700 hover:bg-gray-50 focus:relative dark:border-e-gray-800 dark:text-gray-200 dark:hover:bg-gray-800"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>


            </div>
        </td>
    </form>
</tr>


<script>
    htmx.logAll();
</script>
