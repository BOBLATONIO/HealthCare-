<x-admin-layout title="Dashboard">

    <div class="p-6 space-y-6">

        <!-- Top Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Patients -->
            <div class="bg-white shadow rounded-lg p-6 flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Patients</p>
                    <h2 class="text-2xl font-bold text-blue-600">1,250</h2>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a4 4 0 0 0-3-3.87M9 20H4v-2a4 4 0 0 1 3-3.87m12 3.87a4 4 0 0 0-3-3.87m0 0A4 4 0 0 0 9 10m6 0a4 4 0 1 0-6 0m6 0v1m-6-1v1" />
                    </svg>
                </div>
            </div>

            <!-- Add Patient Shortcut -->
            <a href="{{ route('patientRecord') }}"
                class="bg-white shadow rounded-lg p-6 flex items-center justify-between hover:bg-blue-50 transition">
                <div>
                    <p class="text-sm text-gray-500">Shortcut</p>
                    <h2 class="text-lg font-bold text-gray-700">Add Patient</h2>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v16m8-8H4" />
                    </svg>
                </div>
            </a>

            <!-- AI Health Support Shortcut -->
            <a href="{{ route('ai-support') }}"
                class="bg-white shadow rounded-lg p-6 flex items-center justify-between hover:bg-blue-50 transition">
                <div>
                    <p class="text-sm text-gray-500">Shortcut</p>
                    <h2 class="text-lg font-bold text-gray-700">AI Health Support</h2>
                </div>
                <div class="bg-purple-100 text-purple-600 p-3 rounded-full">
                    <svg class="fill-stroke" width="20" height="20" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                    </svg>
                </div>
            </a>
        </div>

        <!-- Charts Section -->
        <div class="flex flex-col md:flex-row gap-6">

            <!-- Patient Checkups Chart -->
            <div class="bg-white shadow rounded-lg p-6 md:w-1/2 w-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Patient Checkups Over Time</h3>
                <canvas id="patientChart" class="w-full h-64"></canvas>
            </div>

            <!-- Placeholder for Second Chart -->
            <div class="bg-white shadow rounded-lg p-6 md:w-1/2 w-full">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Second Chart</h3>
                <canvas id="secondChart" class="w-full h-64"></canvas>
            </div>

        </div>

        <!-- Inventory Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Low Stock Medicines</h3>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border">Medicine ID</th>
                        <th class="px-4 py-2 border">Medicine Name</th>
                        <th class="px-4 py-2 border">Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">MED001</td>
                        <td class="px-4 py-2 border">Paracetamol 500mg</td>
                        <td class="px-4 py-2 border text-red-600 font-semibold">5</td>
                    </tr>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">MED002</td>
                        <td class="px-4 py-2 border">Amoxicillin 250mg</td>
                        <td class="px-4 py-2 border text-red-600 font-semibold">8</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Patient Checkups Chart
        const ctx = document.getElementById('patientChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Sept 1', 'Sept 2', 'Sept 3', 'Sept 4', 'Sept 5'],
                datasets: [{
                    label: 'Checkups',
                    data: [5, 8, 6, 10, 12],
                    borderColor: '#2563eb',
                    backgroundColor: 'rgba(37, 99, 235, 0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

        // Placeholder Second Chart
        const ctx2 = document.getElementById('secondChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Sept 1', 'Sept 2', 'Sept 3', 'Sept 4', 'Sept 5'],
                datasets: [{
                    label: 'Example Data',
                    data: [3, 7, 4, 6, 8],
                    backgroundColor: '#9333ea'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });
    </script>

</x-admin-layout>