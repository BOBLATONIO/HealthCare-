<x-admin-layout title="Patient Records">
    <div class="px-4 mt-2">
        <div class="w-full flex justify-between items-center mb-3 mt-1 ">
            <!-- Search -->
            <div class="w-full max-w-sm min-w-[300px] relative">
                <div class="relative">
                    <input id="search"
                        class="bg-white w-full pr-11 pl-3 py-1.5 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none hover:border-slate-400"
                        placeholder="Search" />
                    <button class="absolute h-8 w-8 right-1 top-0 my-auto px-2 flex items-center rounded "
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="w-5 h-5 text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Add Patient Button -->
            <div>
                <button id="openModal" class="px-8 py-1.5 bg-blue-800 text-white rounded-md hover:bg-blue-700">
                    Add Patient
                </button>
            </div>
        </div>

        <!-- Patient Table -->
        <div
            class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white border border-gray-200 rounded-lg bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Patient ID</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Fullname</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Gender</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Age</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Address</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Contact #</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Action</p>
                        </th>
                    </tr>
                </thead>
                <tbody id="patients-table">
                    @include('components.patient-partials', ['patients' => $patients])
                </tbody>
            </table>

            <!-- Pagination -->
            <div id="pagination" class="flex justify-between items-center px-4 py-3">
                <div class="text-sm text-slate-500">
                    Showing <b>{{ $patients->firstItem() }}</b> to <b>{{ $patients->lastItem() }}</b> of {{
                    $patients->total() }}
                </div>
                <div class="flex space-x-1">
                    <a href="{{ $patients->previousPageUrl() ?? '#' }}"
                        class="px-3 py-2 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                        Prev
                    </a>
                    @php
                    $start = max($patients->currentPage() - 2, 1);
                    $end = min($start + 5, $patients->lastPage());
                    $start = max($end - 5, 1);
                    @endphp
                    @for($page = $start; $page <= $end; $page++) <a href="{{ $patients->url($page) }}"
                        class="py-2 w-9 text-center text-sm font-normal {{ $patients->currentPage() == $page ? 'text-white bg-blue-800 border border-blue-800' : 'text-slate-500 bg-white border border-slate-200' }} rounded hover:bg-slate-50 hover:border-slate-400 transition">
                        {{ $page }}
                        </a>
                        @endfor
                        <a href="{{ $patients->nextPageUrl() ?? '#' }}"
                            class="px-3 py-2 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                            Next
                        </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <x-slot:modal>
        <div id="patientModal" class="fixed hidden inset-0 flex items-center justify-center bg-black/30 z-50">
            <div class="bg-white rounded-2xl max-w-md w-full shadow-lg">
                <!-- Modal Header -->
                <h2
                    class="text-xl text-center font-semibold text-white rounded-t-2xl bg-blue-800 mb-4 px-4 py-3 border-b">
                    Add Patient</h2>

                <!-- Form -->
                <form class="space-y-2 px-4">
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Firstname</label>
                            <input type="text"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Middlename</label>
                            <input type="text"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Lastname</label>
                            <input type="text"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Contact #</label>
                            <input type="text"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Gender</label>
                            <select
                                class="w-full border rounded-md border-gray-300 shadow px-3 py-2 text-sm focus:outline-none">
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Birthdate</label>
                            <input type="date"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-2 text-sm focus:outline-none" />
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Address</label>
                        <textarea
                            class="w-full border rounded-md border-gray-300 shadow px-3 py-2 text-sm focus:outline-none"
                            rows="2"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="flex border-t justify-end space-x-4 border-gray-300 -mx-4 px-4 py-4 pt-4">
                        <button type="button" id="closeModal"
                            class="px-4 py-2 text-sm bg-gray-200 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                        <button type="submit"
                            class="px-6 py-2 text-sm bg-blue-800 text-white rounded-md hover:bg-blue-700">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </x-slot:modal>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const tableBody = document.getElementById('patients-table');
            const pagination = document.getElementById('pagination');

            // Modal elements
            const openModal = document.getElementById('openModal');
            const closeModal = document.getElementById('closeModal');
            const modal = document.getElementById('patientModal');

            openModal.addEventListener('click', () => {
                modal.classList.remove('hidden');
            });

            closeModal.addEventListener('click', () => {
                modal.classList.add('hidden');
            });

            // Close modal when clicking outside the content
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    modal.classList.add('hidden');
                }
            });

            // Search functionality
            let timer = null;
            function fetchPatients(query, url = null) {
                let fetchUrl = url ?? `/patients/search?query=${encodeURIComponent(query)}`;
                fetch(fetchUrl)
                    .then(response => response.text())
                    .then(html => {
                        const temp = document.createElement('div');
                        temp.innerHTML = html;
                        tableBody.innerHTML = temp.querySelector('#patients-table').innerHTML;
                        pagination.innerHTML = temp.querySelector('#pagination').innerHTML;
                        pagination.querySelectorAll('a').forEach(link => {
                            link.addEventListener('click', function (e) {
                                e.preventDefault();
                                fetchPatients(query, this.href);
                            });
                        });
                    })
                    .catch(err => console.error(err));
            }

            searchInput.addEventListener('keyup', function () {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    fetchPatients(searchInput.value);
                }, 300);
            });

            pagination.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    fetchPatients(searchInput.value, this.href);
                });
            });
        });
    </script>

</x-admin-layout>