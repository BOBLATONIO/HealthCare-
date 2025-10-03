<x-admin-layout title="Dashboard">



    <div class="p-6 space-y-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Patients -->
            <div class="bg-white hover:shadow border border-gray-200 rounded-lg pl-6 flex items-center justify-between">
                <div class="py-6">
                    <p class="text-sm text-gray-600">Total Patients</p>
                    <h2 class="text-2xl font-bold text-gray-900">{{ $patients->count() }}</h2>
                </div>
                <div
                    class="bg-blue-200 border-l-4 border-blue-400 rounded-r-lg w-20 flex items-center justify-center h-full -py-6 text-blue-900 p-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>

                </div>
            </div>

            <!-- Add Patient Shortcut -->
            <a href="{{ route('patientRecord') }}"
                class="bg-white hover:shadow border border-gray-200 rounded-lg pl-6 flex items-center justify-between ">
                <div class="py-6">
                    <p class="text-sm text-gray-500">Shortcut</p>
                    <h2 class="text-lg font-bold text-gray-700">Add Patient</h2>
                </div>
                <div
                    class="bg-green-200 border-l-4 border-green-400 rounded-r-lg w-20 flex items-center justify-center h-full -py-6 text-green-900 p-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                    </svg>


                </div>
            </a>

            <!-- AI Health Support Shortcut -->
            <a href="{{ route('ai-support') }}"
                class="bg-white hover:shadow border border-gray-200 rounded-lg pl-6 flex items-center justify-between ">
                <div class="py-6">
                    <p class="text-sm text-gray-500">Shortcut</p>
                    <h2 class="text-lg font-bold text-gray-700">AI Health Support</h2>
                </div>
                <div
                    class="bg-violet-200 border-l-4 border-violet-400 rounded-r-lg w-20 flex items-center justify-center h-full -py-6 text-violet-900 p-3 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                    </svg>


                </div>
            </a>
        </div>




        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-5">Top 5 Prescribed Medicines</h3>
                <canvas id="topMedicinesChart" height="120"></canvas>
            </div>


            <div class="bg-white shadow-lg rounded-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-5">Daily Checkups (This Week)</h3>
                <canvas id="dailyCheckupsChart" height="120"></canvas>
            </div>
        </div>

        <div class="bg-white shadow-lg rounded-xl p-6">
            <h3 class="text-xl font-bold text-gray-900 mb-5">Low Stock Medicines</h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left justify-between table-auto min-w-max">
                    <thead>
                        <tr>
                            <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                                <p class="text-sm font-semibold leading-none text-gray-50">Medicine ID</p>
                            </th>
                            <th class="p-4 py-3 border-b border-slate-200 w-[450px] bg-blue-800">
                                <p class="text-sm font-semibold leading-none text-gray-50">Name</p>
                            </th>
                            <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                                <p class="text-sm font-semibold leading-none text-gray-50">Quantity</p>
                            </th>


                        </tr>
                    </thead>
                    <tbody id="medicines-table">
                        @forelse ($medicines as $medicine)
                        <tr class="hover:bg-slate-50 border-b border-slate-200">
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">{{ $medicine->medicine_id }}</p>
                            </td>
                            <td class="p-4 py-5 w-[450px]">
                                <p class="text-sm text-slate-500">{{ $medicine->name }}</p>
                            </td>
                            <td class="p-4 py-5">
                                <p class="text-sm text-slate-500">{{ $medicine->quantity }} {{ $medicine->quantity < 2
                                        ? 'pc' : 'pcs' }}</p>
                            </td>

                        </tr>
                        @empty
                        <td colspan="7" class="p-4 text-center text-slate-500">
                            No medicine found.
                        </td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>


    <script>
        new Chart(document.getElementById('topMedicinesChart').getContext('2d'), {
            type: 'bar',
            data: {
                labels: @json($medicineNames),
                datasets: [{
                    label: 'Prescriptions',
                    data: @json($medicineTotals),
                    backgroundColor: '#10b981'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


    @php
    $labels = array_keys($checkupData);
    $counts = array_values($checkupData);
    @endphp


    <script>
        const checkupLabels = [
            <?php for ($i = 0; $i < count($labels); $i++): ?> '<?php echo $labels[$i]; ?>'
                <?php echo $i < count($labels) - 1 ? ',' : ''; ?>
            <?php endfor; ?>
        ];

        const checkupCounts = [
            <?php for ($i = 0; $i < count($counts); $i++): ?>
                <?php echo $counts[$i]; ?><?php echo $i < count($counts) - 1 ? ',' : ''; ?>
            <?php endfor; ?>
        ];

        new Chart(document.getElementById('dailyCheckupsChart').getContext('2d'), {
            type: 'line',
            data: {
                labels: checkupLabels,
                datasets: [{
                    label: 'Daily Checkups',
                    data: checkupCounts,
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245,158,11,0.2)',
                    fill: true,
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>






</x-admin-layout>