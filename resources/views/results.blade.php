<x-layout :sectionName="__('Results')" :pageName="__('')">
    <x-page-heading>Results</x-page-heading>
    @role('Staff|Head Office|Executive Manager')
    <div class="grid grid-cols-3 gap-4">
            @foreach($assets as $asset)
                <x-gradient-card :name="$asset->name" />
            @endforeach
    </div>
    @endrole
    @role('System Admin|Asset Manager')
    <form method="GET" action="{{ route('search') }}" class="mb-4">
        <input type="hidden" name="q" value="{{ request('q') }}">
        <select name="type" onchange="this.form.submit()">
            <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All</option>
            @role('Asset Manager')
            <option value="assets" {{ request('type') == 'assets' ? 'selected' : '' }}>Assets</option>
            <option value="categories" {{ request('type') == 'categories' ? 'selected' : '' }}>Categories</option>
            <option value="statuses" {{ request('type') == 'statuses' ? 'selected' : '' }}>Statuses</option>
            <option value="standards" {{ request('type') == 'standards' ? 'selected' : '' }}>Standards</option>
            <option value="vendors" {{ request('type') == 'vendors' ? 'selected' : '' }}>Vendors</option>
            @endrole
            @role('System Admin')
            <option value="users" {{ request('type') == 'users' ? 'selected' : '' }}>Users</option>
            <option value="offices" {{ request('type') == 'offices' ? 'selected' : '' }}>Offices</option>

            @endrole
        </select>
    </form>

    <div class="grid grid-cols-3 gap-4">
        @if(request('type') == 'all' || request('type') == 'assets')
            @foreach($assets as $asset)
                <x-wide-card :$asset />
            @endforeach
        @endif
        @if(request('type') == 'all' || request('type') == 'users')
            @foreach($users as $user)
                <div>{{ $user->name }} - {{ $user->email }}</div>
            @endforeach
        @endif
        @if(request('type') == 'all' || request('type') == 'categories')
            @foreach($categories as $category)
                <div>{{ $category->name }}</div>
            @endforeach
        @endif
        @if(request('type') == 'all' || request('type') == 'vendors')
            @foreach($vendors as $vendor)
                <x-gradient-card :href="route('vendor.show', $vendor->id)" :name="$vendor->vendor_name" :number="$vendor->vendor_shortname" :date="$vendor->created_at" :tag="$vendor->creator->name" />
            @endforeach
        @endif
    </div>
    @endrole
</x-layout>
