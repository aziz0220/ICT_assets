@props(['users', 'roles', 'admins', 'assetManagers', 'executives', 'staff', 'unroledUsers', 'officesStaffCount', 'unasignedStaff'])



<div class="mt-auto w-1/2 hover:bg-gray-100 hover:border-gray-300">
    <canvas id="officeStaffChart"></canvas>
</div>

<script>

    const officeNames = @json($officesStaffCount->keys());
    const staffCounts = @json($officesStaffCount->values());
    const unassignedUsers = @json($unasignedStaff);

    const ctx2 = document.getElementById('officeStaffChart');

    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: [...officeNames, 'Unassigned Users'],
            datasets: [{
                label: 'Number of Staff',
                data: [...staffCounts, unassignedUsers],
                backgroundColor: [
                    ...Array(officeNames.length).fill('rgba(75, 192, 192, 0.2)'),
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    ...Array(officeNames.length).fill('rgba(75, 192, 192, 1)'),
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
