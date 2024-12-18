<x-layout :sectionName="Auth::user()->getRoleNames()->first()" :pageName="__('Dashboard')">
   @role('System Admin')
    <x-stat-carts :offices="$offices" :users="$users" :unroledUsers="$unroledUsers" :unasignedStaff="$unasignedStaff"></x-stat-carts>
    <div class="inline-flex bg-gray-200/30 md:justify-between justify-center items-center w-full border-gray-100 mt-20 ">
        <x-users-roles-chart :users="$users" :roles="$roles" :admins="$admins" :assetManagers="$assetManagers" :executives="$executives" :staff="$staff" :unroledUsers="$unroledUsers"  ></x-users-roles-chart>
        <x-office-chart :users="$users" :roles="$roles" :admins="$admins" :assetManagers="$assetManagers" :executives="$executives" :staff="$staff" :unroledUsers="$unroledUsers" :officesStaffCount="$officesStaffCount" :unasignedStaff="$unasignedStaff"></x-office-chart>
    </div>
    @endrole
   @role('Asset Manager|Staff|Head Office')
    <x-stats-card :totalAssets="$totalAssets" :pendingProblems="$pendingProblems" :pendingMaintenances="$pendingMaintenances"></x-stats-card>
    @if($pendingMaintenances->isNotEmpty() || $pendingProblems->isNotEmpty())
        <x-action-table :totalAssets="$totalAssets" :pendingProblems="$pendingProblems" :pendingMaintenances="$pendingMaintenances"></x-action-table>
    @endif
    @if($pendingMaintenances->isNotEmpty())
    <section>
        <x-section-heading>Pending Maintenances</x-section-heading>
        <div class="grid lg:grid-cols-3 gap-8 mt-6">
            @foreach($pendingMaintenances as $maintenance)
                <x-asset-card :$asset="$maintenance->asset"/>
            @endforeach
        </div>
    </section>
    @endif
    @if($pendingMaintenances->isNotEmpty())
    <section>
        <x-section-heading>Recent Problems</x-section-heading>
        <div class="mt-6 space-y-6">
            @foreach($pendingProblems as $problem)
                <x-wide-card :asset="$problem->asset" />
            @endforeach
        </div>
    </section>
    @endif
    @role('Asset Manager')
    <section class="bg-gradient-to-r from-transparent via-blue-100 to-transparent pb-3 ">
        <x-section-heading>Top Vendors</x-section-heading>
        <div class="mt-6 flex space-x-6 justify-center items-center px-12">
            @foreach($vendors as $vendor)
                <x-tag :asset="$vendor->vendor_name" :href="route('vendor.show', $vendor->id) " size="base"/>
            @endforeach
        </div>
        <x-section-ending></x-section-ending>
    </section>
    @endrole
    @endrole
</x-layout>
