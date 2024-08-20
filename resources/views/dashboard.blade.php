<x-layout :sectionName="Auth::user()->getRoleNames()->first()" :pageName="__('Dashboard')">
   @role('System Admin')
    <x-stat-carts></x-stat-carts>
   @endrole

   @role('Asset Manager|Staff|Head Office')
    <x-stats-card :totalAssets="$totalAssets" :pendingProblems="$pendingProblems" :pendingMaintenances="$pendingMaintenances"></x-stats-card>
    <x-action-table :totalAssets="$totalAssets" :pendingProblems="$pendingProblems" :pendingMaintenances="$pendingMaintenances"></x-action-table>
    <section>
        <x-section-heading>Pending Maintenances</x-section-heading>
        <div class="grid lg:grid-cols-3 gap-8 mt-6">
            @foreach($pendingMaintenances as $maintenance)
                <x-asset-card :$asset="$maintenance->asset"/>
            @endforeach
        </div>
    </section>
    <section>
        <x-section-heading>Recent Problems</x-section-heading>
        <div class="mt-6 space-y-6">
            @foreach($pendingProblems as $problem)
                <x-wide-card :asset="$problem->asset" />
            @endforeach
        </div>
    </section>
    <section>
        <x-section-heading>Vendors</x-section-heading>
        <div class="mt-6 space-x-1">
            @foreach($vendors as $vendor)
                <x-tag :asset="$vendor->vendor_name" size="base"/>
            @endforeach
        </div>
    </section>
    @endrole
</x-layout>
