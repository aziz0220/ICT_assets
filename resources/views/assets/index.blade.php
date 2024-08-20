<x-layout :sectionName="__('Manage')" :pageName="__('Assets')">
    <script>
        function toggleSelectAll() {
            var checkboxes = document.querySelectorAll('.asset-checkbox');
            var selectAll = document.getElementById('SelectAll');
            checkboxes.forEach((checkbox) => {
                checkbox.checked = selectAll.checked;
            });
            collectSelectedIds();
        }

        document.querySelectorAll('.asset-checkbox').forEach((checkbox) => {
            checkbox.addEventListener('change', collectSelectedIds);
        });

        function collectSelectedIds() {
            var selected = [];
            document.querySelectorAll('.asset-checkbox:checked').forEach((checkbox) => {
                selected.push(checkbox.value);
            });
            document.getElementById('selected_assets').value = selected.join(',');
        }
    </script>

    <x-tabs :assets="$assets" :requests="$requests" :changes="$changes" :assigned="$assigned" :approvedReq="$approvedReq" :approvedChange="$approvedChange"></x-tabs>
    <x-alerts.alert></x-alerts.alert>
    <x-assets-actions></x-assets-actions>
    <x-assets-registered :assets="$assets"></x-assets-registered>
    <x-assets-requests :requests="$requests" :changes="$changes"></x-assets-requests>
    <x-assets-assigned :assigned="$assigned"></x-assets-assigned>
    <x-assets-approved :approvedReq="$approvedReq" :approvedChange="$approvedChange"></x-assets-approved>

</x-layout>
