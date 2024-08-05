<div class="flex space-x-4 margin-tb mb-4 flex justify-end">
    @role('Staff|Asset Manager')

    @can('Request-New-Asset')
        <a
            class="group relative inline-flex items-center overflow-hidden rounded border border-current px-8 py-3 text-indigo-600 focus:outline-none focus:ring active:text-indigo-500"
            href="assets/create"
        >
                              <span class="absolute -end-full transition-all group-hover:end-4">
                                <svg
                                    class="size-5 rtl:rotate-180"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                >
                                  <path
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M17 8l4 4m0 0l-4 4m4-4H3"
                                  />
                                </svg>
                              </span>
            <span class="text-sm font-medium transition-all group-hover:me-4"> Request New Asset </span>
        </a>
    @endcan
    @can('Register-New-Asset')

        <a
            class="group relative inline-flex items-center overflow-hidden rounded bg-indigo-600 px-8 py-3 text-white focus:outline-none focus:ring active:bg-indigo-500"
            href="assets/create"
        >
                                  <span class="absolute -end-full transition-all group-hover:end-4">
                                    <svg
                                        class="size-5 rtl:rotate-180"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                      <path
                                          stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M17 8l4 4m0 0l-4 4m4-4H3"
                                      />
                                    </svg>
                                  </span>
            <span class="text-sm font-medium transition-all group-hover:me-4">Register New Asset</span>
        </a>
    @endcan
    @endrole
    @role('Asset Manager')
    <a
        class="inline-block rounded border border-current px-8 py-3 text-sm font-medium text-indigo-600 transition hover:scale-110 hover:shadow-xl focus:outline-none focus:ring active:text-indigo-500"
        href="{{ route('assets.assign') }}"
    >
        Assign Asset To Staff
    </a>

@endrole
</div>
