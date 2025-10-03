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
                        class="py-2 w-9 text-center text-sm font-normal {{ $patients->currentPage() == $page ? 'text-white bg-blue-800 border border-blue-800 hover:bg-blue-700 hover:border-blue-700' : 'text-slate-500 bg-white border border-slate-200 hover:border-slate-400' }} rounded  transition">
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
                <form action="{{ route('patients.store') }}" method="POST" class="space-y-2 px-4">
                    @csrf
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Firstname</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none"
                                required />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Middlename</label>
                            <input type="text" name="middle_name" value="{{ old('middle_name') }}"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Lastname</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none"
                                required />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Contact #</label>
                            <input type="text" name="contact" {{ old('contact') }}
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none"
                                required />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Gender</label>
                           <select name="gender"
    class="w-full border rounded-md border-gray-300 shadow px-3 py-2 text-sm focus:outline-none"
    required>
    <option value="">Select</option>
    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
</select>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Birthdate</label>
                            <input type="date" name="birthdate"
    value="{{ old('birthdate') }}"
    class="w-full border border-gray-300 shadow rounded-md px-3 py-2 text-sm focus:outline-none"
    required />
                        </div>
                    </div>

                    <div>
                        <label class="text-sm font-medium text-gray-700">Address</label>
                        <textarea name="address"
    class="w-full border rounded-md border-gray-300 shadow px-3 py-2 text-sm focus:outline-none"
    rows="2" required>{{ old('address') }}</textarea>
                    </div>
                    @error('patient_exists')
    <div class="text-sm text-red-500">{{ $message }}</div>
@enderror


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

  @if(session('success'))
    @php
        // detect if it's a delete message
        $isDelete = str_contains(strtolower(session('success')), 'deleted');
    @endphp

    <div id="toast-success"
        class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 py-3 text-gray-500 bg-white rounded-lg border 
            {{ $isDelete ? 'border-red-200' : 'border-green-200' }}"
        role="alert">

        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 
            {{ $isDelete ? 'text-red-500 bg-red-100' : 'text-green-500 bg-green-100' }} rounded-lg">

            @if($isDelete)
                <!-- Trash Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
</svg>

            @else
                <!-- Check Icon -->
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                     viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
            @endif
        </div>

        <div class="ms-3 text-sm font-medium text-gray-700">
            {{ session('success') }}
        </div>

        <button type="button" onclick="document.getElementById('toast-success').remove()"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg p-1.5">
            ✕
        </button>
    </div>
@endif



    @if($errors->has('patient_exists'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('patientModal').classList.remove('hidden');
    });
</script>
@endif


    <script>

       
document.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById('toast-success');
    if (toast) {
        setTimeout(() => {
            toast.remove();
        }, 3000);
    }
});

        
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