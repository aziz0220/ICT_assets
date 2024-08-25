@props(['users', 'roles', 'admins', 'assetManagers', 'executives', 'staff', 'unroledUsers'])

<div class="mt-auto w-1/2 hover:bg-gray-100 hover:border-gray-300">
    <canvas id="myChart"></canvas>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const roles = ['System Admin', 'Asset Manager', 'Executive', 'Staff', 'Unroled'];

    const userCounts = [
        @json($admins),        // System Admin cougnt
        @json($assetManagers), // Asset Manager count
        @json($executives),    // Executive count
        @json($staff),         // Staff count
        @json($unroledUsers)   // Unroled Users count
    ];

    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: roles, // Use manually defined role names
            datasets: [{
                label: 'Number of Users',
                data: userCounts, // Use manually mapped user counts
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',  // Color for System Admin
                    'rgba(54, 162, 235, 0.2)',  // Color for Asset Manager
                    'rgba(255, 206, 86, 0.2)',  // Color for Executive
                    'rgba(75, 192, 192, 0.2)',  // Color for Staff
                    'rgba(153, 102, 255, 0.2)'  // Color for Unroled
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',    // Border color for System Admin
                    'rgba(54, 162, 235, 1)',    // Border color for Asset Manager
                    'rgba(255, 206, 86, 1)',    // Border color for Executive
                    'rgba(75, 192, 192, 1)',    // Border color for Staff
                    'rgba(153, 102, 255, 1)'    // Border color for Unroled
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
