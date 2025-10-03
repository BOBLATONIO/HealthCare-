<x-admin-layout title="Inventory Records">
    <div class="px-4 mt-2">
        <!-- Top Bar -->
        <div class="w-full flex justify-between items-center mb-3 mt-1 ">
            <!-- Search -->
            <div class="w-full max-w-sm min-w-[300px] relative">
                <div class="relative">
                    <input id="search"
                        class="bg-white w-full pr-11 pl-3 py-1.5 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none hover:border-slate-400"
                        placeholder="Search" />
                    <button class="absolute h-8 w-8 right-1 top-0 my-auto px-2 flex items-center rounded" type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3"
                            stroke="currentColor" class="w-5 h-5 text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Add Button -->
            <div>
                <button id="openModal" class="px-8 py-1.5 bg-blue-800 text-white rounded-md hover:bg-blue-700">
                    Add Item
                </button>
            </div>
        </div>

        <!-- Inventory Table -->
        <div
            class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white border border-gray-200 rounded-lg bg-clip-border">
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

                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Action</p>
                        </th>
                    </tr>
                </thead>
                <tbody id="medicines-table">
                    @include('components.medicine-partials', ['medicines' => $medicines])
                </tbody>
            </table>

            <!-- Pagination -->
            <div id="pagination" class="flex justify-between items-center px-4 py-3">
                <div class="text-sm text-slate-500">
                    Showing <b>{{ $medicines->firstItem() }}</b> to <b>{{ $medicines->lastItem() }}</b> of {{
                    $medicines->total() }}
                </div>
                <div class="flex space-x-1">
                    <a href="{{ $medicines->previousPageUrl() ?? '#' }}"
                        class="px-3 py-2 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                        Prev
                    </a>
                    @php
                    $start = max($medicines->currentPage() - 2, 1);
                    $end = min($start + 5, $medicines->lastPage());
                    $start = max($end - 5, 1);
                    @endphp
                    @for($page = $start; $page <= $end; $page++) <a href="{{ $medicines->url($page) }}"
                        class="py-2 w-9 text-center text-sm font-normal {{ $medicines->currentPage() == $page ? 'text-white bg-blue-800 border border-blue-800 hover:bg-blue-700 hover:border-blue-700' : 'text-slate-500 bg-white border border-slate-200 hover:border-slate-400' }} rounded  transition">
                        {{ $page }}
                        </a>
                        @endfor
                        <a href="{{ $medicines->nextPageUrl() ?? '#' }}"
                            class="px-3 py-2 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                            Next
                        </a>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
    @php
    // detect if it's a delete message
    $isDelete = str_contains(strtolower(session('success')), 'deleted');
    @endphp

    <div id="toast-success" class="fixed top-5 right-5 z-50 flex items-center w-full max-w-xs p-4 py-3 text-gray-500 bg-white rounded-lg border 
            {{ $isDelete ? 'border-red-200' : 'border-green-200' }}" role="alert">

        <div class="inline-flex items-center justify-center shrink-0 w-8 h-8 
            {{ $isDelete ? 'text-red-500 bg-red-100' : 'text-green-500 bg-green-100' }} rounded-lg">

            @if($isDelete)
            <!-- Trash Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>

            @else
            <!-- Check Icon -->
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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

    <x-slot:modal>
        <div id="medicineModal" class="fixed hidden inset-0 flex items-center justify-center bg-black/30 z-50">
            <div class="bg-white rounded-2xl max-w-md w-full shadow-lg">
                <!-- Modal Header -->
                <h2 id="modalTitle"
                    class="text-xl text-center font-semibold text-white rounded-t-2xl bg-blue-800 mb-4 px-4 py-3 border-b">
                    Add Medicine
                </h2>

                <!-- Form -->
                <form method="POST" action="{{ route('medicines.store') }}" class="space-y-2 px-4">
                    @csrf
                    <input type="hidden" name="medicine_id" id="medicine_id" />

                    <div class="grid grid-cols-1 gap-3">
                        <div>
                            <label class="text-sm font-medium text-gray-700">Medicine Name</label>
                            <input type="text" name="name" id="medicine_name" required
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none" />
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" name="quantity" id="medicine_quantity" min="1" required
                                class="w-full border border-gray-300 shadow rounded-md px-3 py-1.5 text-sm focus:outline-none" />
                        </div>
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
            const toast = document.getElementById('toast-success');
            if (toast) {
                setTimeout(() => {
                    toast.remove();
                }, 3000);
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const tableBody = document.getElementById('medicines-table');
            const pagination = document.getElementById('pagination');

            const modal = document.getElementById('medicineModal');
            const modalTitle = document.getElementById('modalTitle');
            const medicineIdInput = document.getElementById('medicine_id');
            const medicineNameInput = document.getElementById('medicine_name');
            const medicineQuantityInput = document.getElementById('medicine_quantity');
            const form = modal.querySelector('form');
            const openModal = document.getElementById('openModal');
            const closeModalBtn = document.getElementById('closeModal');

            function openAddModal() {
                modalTitle.textContent = 'Add Medicine';
                form.action = '{{ route("medicines.store") }}';
                form.method = 'POST';
                const methodInput = form.querySelector('input[name="_method"]');
                if (methodInput) methodInput.remove();
                medicineIdInput.value = '';
                medicineNameInput.value = '';
                medicineQuantityInput.value = '';
                modal.classList.remove('hidden');
            }

            function openEditModal(id, name, quantity) {
                modalTitle.textContent = 'Edit Medicine';
                medicineIdInput.value = id;
                medicineNameInput.value = name;
                medicineQuantityInput.value = quantity;

                form.action = `/medicines/${id}`;
                form.method = 'POST';

                if (!form.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }

                modal.classList.remove('hidden');
            }

            // Open Add Modal
            openModal.addEventListener('click', openAddModal);

            // Close Modal
            closeModalBtn.addEventListener('click', () => modal.classList.add('hidden'));
            modal.addEventListener('click', e => { if (e.target === modal) modal.classList.add('hidden'); });

            // ----- Search & Pagination -----
            let timer = null;
            function fetchMedicines(query, url = null) {
                let fetchUrl = url ?? `/medicines/search?query=${encodeURIComponent(query)}`;
                fetch(fetchUrl)
                    .then(res => res.text())
                    .then(html => {
                        const temp = document.createElement('div');
                        temp.innerHTML = html;
                        tableBody.innerHTML = temp.querySelector('#medicines-table').innerHTML;
                        pagination.innerHTML = temp.querySelector('#pagination').innerHTML;

                        // Re-attach pagination links
                        pagination.querySelectorAll('a').forEach(link => {
                            link.addEventListener('click', function (e) {
                                e.preventDefault();
                                fetchMedicines(query, this.href);
                            });
                        });

                        // Re-attach edit buttons after table refresh
                        attachEditButtons();
                    }).catch(err => console.error(err));
            }

            searchInput.addEventListener('keyup', function () {
                clearTimeout(timer);
                timer = setTimeout(() => fetchMedicines(searchInput.value), 300);
            });

            pagination.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    fetchMedicines(searchInput.value, this.href);
                });
            });

            // ----- Edit Buttons -----
            function attachEditButtons() {
                document.querySelectorAll('.edit-btn').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const id = this.dataset.id;
                        const name = this.dataset.name;
                        const quantity = this.dataset.quantity;
                        openEditModal(id, name, quantity);
                    });
                });
            }

            attachEditButtons(); // initial attach
        });
    </script>

</x-admin-layout>