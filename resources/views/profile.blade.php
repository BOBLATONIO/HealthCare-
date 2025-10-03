<x-admin-layout title="Patient Information">
    <div class="w-full p-6 space-y-6">

        <!-- Patient Info Card -->
        <div class="w-full border bg-gradient-to-t from-blue-50 to-white shadow-sm border-gray-200 rounded-lg p-6">
            <!-- Header -->
            <div class="flex justify-between py-1.5 -mx-6 px-6 bg-blue-800 -mt-6 rounded-t-lg items-center mb-6">
                <h2 class="text-lg font-medium text-gray-50">Patient Profile</h2>
                <button id="editBtn"
                    class="text-sm px-8 font-bold py-1.5 rounded-lg border bg-white border-blue-600 text-blue-600 hover:bg-blue-50 transition">
                    Edit
                </button>
                <div id="actionBtns" class="col-span-2 flex justify-end gap-3 hidden">
                    <button type="button" id="cancelBtn"
                        class="px-4 py-1.5 text-sm rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-100 transition">
                        Cancel </button>
                    <button type="submit"
                        class="px-8 py-1.5 text-sm rounded-lg bg-blue-600 border border-white text-white hover:bg-blue-700 transition">
                        Save </button>
                </div>
            </div>
            <!-- Form -->
            <form id="patientForm" class="grid grid-cols-2 gap-4" method="POST"
                action="{{ route('patients.update', $patient) }}"> @csrf @method('PUT')<!-- First Name -->
                <div> <label class="text-gray-500 text-xs uppercase mb-1 block">First Name</label>
                    <input type="text" name="first_name" value="{{ $patient->first_name }}"
                        class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800 focus:outline-none"
                        disabled />
                </div>
                <!-- Middle Name -->
                <div> <label class="text-gray-500 text-xs uppercase mb-1 block">Middle Name</label>
                    <input type="text" name="middle_name" value="{{ $patient->middle_name }}"
                        class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800 focus:outline-none"
                        disabled />
                </div>
                <!-- Last Name -->
                <div> <label class="text-gray-500 text-xs uppercase mb-1 block">Last Name</label>
                    <input type="text" name="last_name" value="{{ $patient->last_name }}"
                        class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800 focus:outline-none"
                        disabled />
                </div>
                <!-- Gender -->
                <div> <label class="text-gray-500 text-xs uppercase mb-1 block">Gender</label>
                    <select name="gender"
                        class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800 focus:outline-none"
                        disabled>
                        <option value="Male" {{ $patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ $patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <!-- Birthdate -->
                <div> <label class="text-gray-500 text-xs uppercase mb-1 block">Birthday</label>
                    <input type="date" name="birthdate" value="{{ $patient->birthdate }}"
                        class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800 focus:outline-none"
                        disabled />
                </div>
                <!-- Contact -->
                <div> <label class="text-gray-500 text-xs uppercase mb-1 block">Contact</label>
                    <input type="text" name="contact" value="{{ $patient->contact }}"
                        class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800 focus:outline-none "
                        disabled />
                </div>
                <!-- Address -->
                <div class="col-span-2"> <label class="text-gray-500 text-xs uppercase mb-1 block">Address</label>
                    <textarea name="address"
                        class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800 focus:outline-none "
                        disabled>{{ $patient->address }}
                    </textarea>
                </div>
            </form>
        </div>

        <!-- Doctor's Notes Section -->
        <div class="border bg-gradient-to-t from-blue-50 to-white shadow-sm border-gray-200 rounded-lg p-6">
            <!-- Header -->
            <div class="flex justify-between py-1.5 -mx-6 px-6 bg-blue-800 -mt-6 rounded-t-lg items-center mb-6">
                <h2 class="text-lg font-medium text-gray-50">Doctor's Input</h2>
                <button type="submit" form="consultationForm"
                    class="text-sm px-8 font-bold py-1.5 rounded-lg border bg-white border-blue-600 text-blue-600 hover:bg-blue-50 transition">
                    Save
                </button>
            </div>

            <!-- Consultation Form -->
            <form id="consultationForm" class="space-y-4" action="{{ route('consultations.store', $patient) }}"
                method="POST">
                @csrf

                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date" name="date" required
                        class="mt-1 block w-full border-gray-300 border shadow-inner rounded-lg px-3 py-2 focus:outline-none" />
                </div>

                <!-- Diagnosis -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Disease / Diagnosis</label>
                    <input type="text" name="diagnosis" required placeholder="e.g. Dengue"
                        class="mt-1 block w-full border-gray-300 border shadow-inner rounded-lg px-3 py-2 focus:outline-none" />
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea rows="4" name="notes" placeholder="Doctor's notes here..."
                        class="mt-1 block w-full border-gray-300 border shadow-inner rounded-lg px-3 py-2 focus:outline-none"></textarea>
                </div>

                <!-- Prescription Section -->
                <div class="border border-gray-300 rounded-lg bg-gray-50 p-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Prescription (Medicines)</h3>

                    <!-- Selection Row -->
                    <div class="grid grid-cols-3 gap-4 items-end mb-4">
                        <div>
                            <label class="block text-xs text-gray-500">Select Medicine</label>
                            <select id="medicineSelect"
                                class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800">
                                <option value="">-- Choose Medicine --</option>
                                @foreach($medicines as $medicine)
                                @if($medicine->quantity > 0)
                                <option value="{{ $medicine->id }}" data-quantity="{{ $medicine->quantity }}">
                                    {{ $medicine->name }} ({{ $medicine->quantity }} left)
                                </option>
                                @endif
                                @endforeach
                            </select>


                        </div>
                        <div>
                            <label class="block text-xs text-gray-500">Quantity (pieces)</label>
                            <input id="medicineQty" type="number" min="1" value="1"
                                class="w-full rounded-lg border-gray-300 border shadow-inner px-3 py-2 font-medium text-gray-800" />
                        </div>
                        <div>
                            <button type="button" id="addMedicineBtn"
                                class="w-full px-4 py-2 text-sm rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                Add to Prescription
                            </button>
                        </div>
                    </div>

                    <!-- Prescription List Table -->
                    <table class="w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-600">Medicine</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-600">Quantity</th>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-600">Action</th>
                            </tr>
                        </thead>
                        <tbody id="prescriptions-list"></tbody>
                    </table>
                </div>
            </form>
        </div>

        <!-- History Section -->
        <div class="border bg-gradient-to-t from-blue-50 to-white shadow-sm border-gray-200 rounded-lg p-6">
            <div class="flex justify-between py-1.5 -mx-6 px-6 bg-blue-800 -mt-6 rounded-t-lg items-center mb-6">
                <h2 class="text-lg font-medium text-gray-50">History</h2>
            </div>

            <div class="space-y-4">
                @forelse($patient->consultations as $consultation)
                <div class="border border-gray-200 rounded-xl p-4 bg-gray-50 hover:shadow-lg">
                    <p class="text-sm text-gray-500">
                        Date: <span class="font-semibold">{{ \Carbon\Carbon::parse($consultation->date)->format('F d,
                            Y') }}</span>
                    </p>
                    <p class="text-sm text-gray-500">
                        Disease: <span class="font-semibold">{{ $consultation->diagnosis }}</span>
                    </p>
                    <p class="text-sm text-gray-500">Notes:</p>
                    <p class="font-medium mb-2">{{ $consultation->notes ?? 'No notes provided.' }}</p>

                    <!-- Prescription History -->
                    @if($consultation->prescriptions->count())
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 mb-1">Prescription:</p>
                        <ul class="list-disc list-inside text-sm text-gray-800 space-y-1">
                            @foreach($consultation->prescriptions as $prescription)
                            <li>{{ $prescription->medicine->name }} - {{ $prescription->quantity }} pcs</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                @empty
                <p class="text-gray-500 italic">No consultation history available.</p>
                @endforelse
            </div>
        </div>


        <!-- JS Logic -->

        <script>
            const editBtn = document.getElementById('editBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const form = document.getElementById('patientForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            const actionBtns = document.getElementById('actionBtns');
            const saveBtn = actionBtns.querySelector('button[type="submit"]');
            // Enable editing 
            editBtn.addEventListener('click', () => {
                inputs.forEach(el => el.disabled = false);
                actionBtns.classList.remove('hidden');
                editBtn.classList.add('hidden');
            });

            // Cancel editing 
            cancelBtn.addEventListener('click', () => {
                inputs.forEach(el => el.disabled = true);
                actionBtns.classList.add('hidden');
                editBtn.classList.remove('hidden');
            });

            // Save (submit form) 
            saveBtn.addEventListener('click', () => {
                form.submit();
            });
        </script>


        <script>
            document.addEventListener('DOMContentLoaded', function () {
                let medIndex = 0;
                const addBtn = document.getElementById('addMedicineBtn');
                const medSelect = document.getElementById('medicineSelect');
                const medQty = document.getElementById('medicineQty');
                const list = document.getElementById('prescriptions-list');
                const form = document.getElementById('consultationForm');

                function updateMaxQty() {
                    const selected = medSelect.options[medSelect.selectedIndex];
                    if (selected && selected.value) {
                        const quantity = parseInt(selected.getAttribute('data-quantity'));
                        medQty.max = quantity;
                        medQty.value = Math.min(medQty.value, quantity);
                        addBtn.disabled = quantity <= 0;
                    } else {
                        medQty.removeAttribute('max');
                        addBtn.disabled = true;
                    }
                }

                medSelect.addEventListener('change', updateMaxQty);
                updateMaxQty();

                addBtn.addEventListener('click', () => {
                    const selected = medSelect.options[medSelect.selectedIndex];
                    if (!selected || !selected.value) return alert("Select a medicine first.");

                    const id = selected.value;
                    const name = selected.text.split("(")[0].trim();
                    const qty = parseInt(medQty.value);
                    let available = parseInt(selected.getAttribute('data-quantity'));

                    if (qty > available) return alert(`Only ${available} pieces available.`);

                    // Add row to table
                    const row = document.createElement('tr');
                    row.innerHTML = `
                    <td class="px-3 py-2 text-sm font-medium text-gray-800">${name}</td> 
        <td class="px-3 py-2 text-sm text-gray-700">${qty} pcs</td> 
        <td class="px-3 py-2"> 
            <button type="button" class="remove-btn text-xs px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200"> Remove </button> 
            </td>    `;
                    list.appendChild(row);

                    // Hidden inputs
                    const inputId = document.createElement('input');
                    inputId.type = 'hidden';
                    inputId.name = `medicines[${medIndex}][id]`;
                    inputId.value = id;
                    form.appendChild(inputId);

                    const inputQty = document.createElement('input');
                    inputQty.type = 'hidden';
                    inputQty.name = `medicines[${medIndex}][quantity]`;
                    inputQty.value = qty;
                    form.appendChild(inputQty);

                    row.querySelector('.remove-btn').addEventListener('click', () => {
                        row.remove();
                        inputId.remove();
                        inputQty.remove();

                        let option = Array.from(medSelect.options).find(o => o.value === id);
                        if (!option) {
                            option = new Option(`${name} (${qty} left)`, id);
                            option.setAttribute('data-quantity', qty);
                            medSelect.appendChild(option);
                        } else {
                            const newQuantity = parseInt(option.getAttribute('data-quantity')) + qty;
                            option.setAttribute('data-quantity', newQuantity);
                            option.text = `${name} (${newQuantity} left)`;
                        }
                        updateMaxQty();
                    });

                    // Update quantity in select
                    available -= qty;
                    if (available <= 0) selected.remove();
                    else selected.setAttribute('data-quantity', available), selected.text = `${name} (${available} left)`;

                    medSelect.value = "";
                    medQty.value = 1;
                    medIndex++;
                    updateMaxQty();
                });
            });
        </script>









    </div>
</x-admin-layout>