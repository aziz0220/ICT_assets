@props(['offices', 'staff', 'assetmanagers', 'roles', 'permissions', 'users','unasignedStaff','unroledUsers'] )
<div class="mt-4">
    <div class="flex flex-wrap -mx-6">
        <div class="w-full px-6 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 flex flex-col">
            <div class="flex flex-grow items-center px-5 py-6 bg-white rounded-md shadow-sm min-h-40">
                <div class="p-3 bg-indigo-600 bg-opacity-75 rounded-full">
{{--                    <svg class="w-8 h-8 text-white" viewBox="0 0 28 30" fill="none"--}}
{{--                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path--}}
{{--                            d="M18.2 9.08889C18.2 11.5373 16.3196 13.5222 14 13.5222C11.6804 13.5222 9.79999 11.5373 9.79999 9.08889C9.79999 6.64043 11.6804 4.65556 14 4.65556C16.3196 4.65556 18.2 6.64043 18.2 9.08889Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                        <path--}}
{{--                            d="M25.2 12.0444C25.2 13.6768 23.9464 15 22.4 15C20.8536 15 19.6 13.6768 19.6 12.0444C19.6 10.4121 20.8536 9.08889 22.4 9.08889C23.9464 9.08889 25.2 10.4121 25.2 12.0444Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                        <path--}}
{{--                            d="M19.6 22.3889C19.6 19.1243 17.0927 16.4778 14 16.4778C10.9072 16.4778 8.39999 19.1243 8.39999 22.3889V26.8222H19.6V22.3889Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                        <path--}}
{{--                            d="M8.39999 12.0444C8.39999 13.6768 7.14639 15 5.59999 15C4.05359 15 2.79999 13.6768 2.79999 12.0444C2.79999 10.4121 4.05359 9.08889 5.59999 9.08889C7.14639 9.08889 8.39999 10.4121 8.39999 12.0444Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                        <path--}}
{{--                            d="M22.4 26.8222V22.3889C22.4 20.8312 22.0195 19.3671 21.351 18.0949C21.6863 18.0039 22.0378 17.9556 22.4 17.9556C24.7197 17.9556 26.6 19.9404 26.6 22.3889V26.8222H22.4Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                        <path--}}
{{--                            d="M6.64896 18.0949C5.98058 19.3671 5.59999 20.8312 5.59999 22.3889V26.8222H1.39999V22.3889C1.39999 19.9404 3.2804 17.9556 5.59999 17.9556C5.96219 17.9556 6.31367 18.0039 6.64896 18.0949Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                    </svg>--}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                    </svg>

                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{$offices}}</h4>
                    <div class="text-gray-500">Offices</div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 sm:mt-0 flex flex-col">
            <div class="flex flex-grow items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-orange-600 bg-opacity-75 rounded-full">
{{--                    <svg class="w-8 h-8 text-white" viewBox="0 0 28 28" fill="none"--}}
{{--                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path--}}
{{--                            d="M4.19999 1.4C3.4268 1.4 2.79999 2.02681 2.79999 2.8C2.79999 3.57319 3.4268 4.2 4.19999 4.2H5.9069L6.33468 5.91114C6.33917 5.93092 6.34409 5.95055 6.34941 5.97001L8.24953 13.5705L6.99992 14.8201C5.23602 16.584 6.48528 19.6 8.97981 19.6H21C21.7731 19.6 22.4 18.9732 22.4 18.2C22.4 17.4268 21.7731 16.8 21 16.8H8.97983L10.3798 15.4H19.6C20.1303 15.4 20.615 15.1004 20.8521 14.6261L25.0521 6.22609C25.2691 5.79212 25.246 5.27673 24.991 4.86398C24.7357 4.45123 24.2852 4.2 23.8 4.2H8.79308L8.35818 2.46044C8.20238 1.83722 7.64241 1.4 6.99999 1.4H4.19999Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                        <path--}}
{{--                            d="M22.4 23.1C22.4 24.2598 21.4598 25.2 20.3 25.2C19.1403 25.2 18.2 24.2598 18.2 23.1C18.2 21.9402 19.1403 21 20.3 21C21.4598 21 22.4 21.9402 22.4 23.1Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                        <path--}}
{{--                            d="M9.1 25.2C10.2598 25.2 11.2 24.2598 11.2 23.1C11.2 21.9402 10.2598 21 9.1 21C7.9402 21 7 21.9402 7 23.1C7 24.2598 7.9402 25.2 9.1 25.2Z"--}}
{{--                            fill="currentColor"></path>--}}
{{--                    </svg>--}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>

                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{$users}}</h4>
                    <div class="text-gray-500">Users</div>
                </div>
            </div>
        </div>

        <div class="w-full px-6 mt-6 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 xl:mt-0 flex flex-col">
            <div class="flex flex-grow items-center px-5 py-6 bg-white rounded-md shadow-sm">
                <div class="p-3 bg-pink-600 bg-opacity-75 rounded-full">
{{--                    <svg class="w-8 h-8 text-white" viewBox="0 0 28 28" fill="none"--}}
{{--                         xmlns="http://www.w3.org/2000/svg">--}}
{{--                        <path d="M6.99998 11.2H21L22.4 23.8H5.59998L6.99998 11.2Z" fill="currentColor"--}}
{{--                              stroke="currentColor" stroke-width="2" stroke-linejoin="round"></path>--}}
{{--                        <path--}}
{{--                            d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z"--}}
{{--                            stroke="currentColor" stroke-width="2"></path>--}}
{{--                    </svg>--}}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>

                </div>

                <div class="mx-5">
                    <h4 class="text-2xl font-semibold text-gray-700">{{$unasignedStaff}}</h4>
                    <div class="text-gray-500">Unasigned Staff</div>
                </div>
            </div>
        </div>

    <div class="w-full px-6 mt-6 sm:w-1/2 md:w-1/2 lg:w-1/3 xl:w-1/4 xl:mt-0 flex flex-col">
        <div class="flex flex-grow items-center px-5 py-6 bg-white rounded-md shadow-sm">
            <div class="p-3 bg-green-600 bg-opacity-75 rounded-full">
{{--                <svg class="w-8 h-8 text-white" viewBox="0 0 28 28" fill="none"--}}
{{--                     xmlns="http://www.w3.org/2000/svg">--}}
{{--                    <path d="M6.99998 11.2H21L22.4 23.8H5.59998L6.99998 11.2Z" fill="currentColor"--}}
{{--                          stroke="currentColor" stroke-width="2" stroke-linejoin="round"></path>--}}
{{--                    <path--}}
{{--                        d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z"--}}
{{--                        stroke="currentColor" stroke-width="2"></path>--}}
{{--                </svg>--}}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-white size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>


            </div>

            <div class="mx-5">
                <h4 class="text-2xl font-semibold text-gray-700">{{$unroledUsers}}</h4>
                <div class="inline-flex text-gray-500">Unrolled Users</div>
            </div>
        </div>
    </div>
    </div>
</div>
