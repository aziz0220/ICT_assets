<x-layout :sectionName="__('Welcome')" :pageName="__('Home')">
            <div class="mx-auto max-w-3xl text-center select-none">
                <h1
                    class="after:absolute after:bg-gray-200 after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-left after:scale-x-100 hover:after:origin-bottom-right hover:after:scale-x-0 after:transition-transform after:ease-in-out after:duration-300 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600 bg-clip-text text-3xl font-extrabold text-transparent sm:text-5xl"
                >
                    ICT Register.

                    <span class="sm:block"> Control Assets. </span>
                </h1>

                <p class="mx-auto mt-4 max-w-xl sm:text-xl/relaxed">
                    ICT asset register system of the Open University of Tanzania. Track, manage, and optimize ICT
                    assets!
                </p>

                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <a
                        class="block w-full rounded border border-blue-600 bg-blue-600 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring active:text-opacity-75 sm:w-auto"
                        href="login"
                    >
                        Get Started
                    </a>

                    <a
                        class="block w-full rounded border border-blue-600 px-12 py-3 text-sm font-medium text-gray-600 hover:bg-blue-600 hover:text-white focus:outline-none focus:ring active:bg-blue-500 sm:w-auto"
                        href=""
                    >
                        Learn More
                    </a>
                </div>
            </div>


{{--    <div class="">--}}
{{--        <section class="text-center select-none pt-6">--}}
{{--            <h1 class="font-bold text-4xl relative inline-block after:absolute after:bg-gray-200 after:bottom-0 after:left-0 after:h-[2px] after:w-full after:origin-bottom-left after:scale-x-100 hover:after:origin-bottom-right hover:after:scale-x-0 after:transition-transform after:ease-in-out after:duration-300">ICT Register</h1>--}}
{{--            <div class="font-bold text-4xl relative inline-block before:absolute before:bg-sky-600 before:bottom-0 before:left-0 before:h-full before:w-full before:origin-bottom before:scale-y-[0.01] hover:before:scale-y-100 before:transition-transform before:ease-in-out before:duration-500"><span class="relative">Hover over me</span></div>--}}
{{--        </section>--}}
{{--    </div>--}}
</x-layout>
