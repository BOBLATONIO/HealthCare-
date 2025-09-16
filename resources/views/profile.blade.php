<x-admin-layout title="Patient Information">
    <div class="w-full p-6 space-y-6">
        <!-- Patient Info Card -->

        <div class="w-full border bg-gradient-to-t from-blue-50 to-white shadow-sm border-gray-200 rounded-lg p-6">
            <!-- Header -->
            <div class="flex justify-between py-1.5 -mx-6 px-6  bg-blue-800 -mt-6 rounded-t-lg  items-center mb-6">
                <h2 class="text-lg font-medium text-gray-50">Patient Profile</h2>
                <button id="editBtn"
                    class="text-sm px-8 font-bold py-1.5 rounded-lg border bg-white  border-blue-600 text-blue-600 hover:bg-blue-50 transition">
                    Edit
                </button>
                <div id="actionBtns" class="col-span-2 flex justify-end gap-3 hidden">
                    <button type="button" id="cancelBtn"
                        class="px-4 py-1.5 text-sm rounded-lg bg-gray-200 text-gray-700 hover:bg-gray-100 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-8 py-1.5 text-sm rounded-lg bg-blue-600 border border-white text-white hover:bg-blue-700 transition">
                        Save
                    </button>
                </div>
            </div>

            <!-- Form -->
            <form id="patientForm" class="grid  grid-cols-2 gap-4" disabled>
                <!-- Full Name -->
                <div class="">
                    <label class="text-gray-500 text-xs uppercase tracking-wide mb-1 block">Full Name</label>
                    <input type="text" name="fullname" value="{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 disabled:bg-gray-50"
                        disabled />
                </div>

                <!-- Gender -->
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wide mb-1 block">Gender</label>
                    <select name="gender"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 disabled:bg-gray-50"
                        disabled>
                        <option value="Male" selected>Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>

                <!-- Birthday -->
                <div>
    <label class="text-gray-500 text-xs uppercase tracking-wide mb-1 block">Birthday</label>
    <input type="text" 
           value="{{ \Carbon\Carbon::parse($patient->birthdate)->format('F d, Y') }}" 
           class="w-full rounded-lg border border-gray-300 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 disabled:bg-gray-50"
           disabled />
</div>


                <!-- Age -->
                <div>
                <label class="text-gray-500 text-xs uppercase tracking-wide mb-1 block">Age</label>
                <div class="w-full px-3 py-2 border border-gray-300 font-medium text-gray-800 bg-gray-50 rounded-lg">
                    @php
                        $birthdate = \Carbon\Carbon::parse($patient->birthdate);
                        $diff = $birthdate->diff(\Carbon\Carbon::now());
                    @endphp

                    @if ($diff->y >= 1)
                        {{ $diff->y }} years old
                    @else
                        {{ $diff->m }} months old
                    @endif
                </div>
            </div>

                <!-- Contact -->
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wide mb-1 block">Contact</label>
                    <input type="text" name="contact" value="{{ $patient->contact }}"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 disabled:bg-gray-50"
                        disabled />
                </div>

                <!-- Address -->
                <div>
                    <label class="text-gray-500 text-xs uppercase tracking-wide  block">Address</label>
                    <textarea name="address" rows="3"
                        class="w-full rounded-lg border border-gray-300 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 disabled:bg-gray-50"
                        disabled>{{ $patient->address }}</textarea>
                </div>

                <!-- Save / Cancel Buttons -->

            </form>
        </div>

        <!-- Doctor's Notes Section -->
        <div class="border bg-gradient-to-t from-blue-50 to-white shadow-sm border-gray-200 rounded-lg p-6">
            <div class="flex justify-between py-1.5 -mx-6 px-6 bg-blue-800 -mt-6 rounded-t-lg items-center mb-6">
                <h2 class="text-lg font-medium text-gray-50">Doctor's Input</h2>
                <button
                    class="text-sm px-8 font-bold py-1.5 rounded-lg border bg-white border-blue-600 text-blue-600 hover:bg-blue-50 transition">
                    Save
                </button>
            </div>

            <form class="space-y-4">
                <!-- Date -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Date</label>
                    <input type="date"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500" />
                </div>

                <!-- Disease -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Disease / Diagnosis</label>
                    <input type="text"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                        placeholder="e.g. Dengue" />
                </div>

                <!-- Notes -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Notes</label>
                    <textarea rows="4"
                        class="mt-1 block w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                        placeholder="Doctor's notes here..."></textarea>
                </div>

                <!-- Prescription Section -->
                <div class="border rounded-lg bg-gray-50 p-4">
                    <h3 class="text-sm font-semibold text-gray-700 mb-2">Prescription (Medicines)</h3>

                    <!-- Medicine Selection -->
                    <div class="grid grid-cols-3 gap-4 items-end">
                        <div>
                            <label class="block text-xs text-gray-500">Select Medicine</label>
                            <select
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500">
                                <option>-- Choose Medicine --</option>
                                <option>Paracetamol</option>
                                <option>Amoxicillin</option>
                                <option>Ibuprofen</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs text-gray-500">Quantity (pieces)</label>
                            <input type="number" min="1" value="1"
                                class="w-full rounded-lg border border-gray-300 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500" />
                        </div>

                        <div>
                            <button type="button"
                                class="w-full px-4 py-2 text-sm rounded-lg bg-blue-600 text-white font-semibold hover:bg-blue-700 transition">
                                Add to Prescription
                            </button>
                        </div>
                    </div>

                    <!-- Prescription List -->
                    <div class="mt-4">
                        <table class="w-full border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-600">Medicine</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-600">Quantity (pcs)</th>
                                    <th class="px-3 py-2 text-left text-xs font-medium text-gray-600">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Example row -->
                                <tr class="border-t">
                                    <td class="px-3 py-2 text-sm font-medium text-gray-800">Paracetamol</td>
                                    <td class="px-3 py-2 text-sm text-gray-700">10 pcs</td>
                                    <td class="px-3 py-2">
                                        <button type="button"
                                            class="text-xs px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200">
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>


        <!-- History Section -->
        <div class="border bg-gradient-to-t from-blue-50 to-white shadow-sm border-gray-200 rounded-lg p-6">
            <div class="flex justify-between py-1.5 -mx-6 px-6 bg-blue-800 -mt-6 rounded-t-lg items-center mb-6">
                <h2 class="text-lg font-medium text-gray-50">History</h2>
            </div>

            <div class="space-y-4">
                <!-- Example Record -->
                <div class="border border-gray-200 hover:shadow-lg rounded-xl p-4 bg-gray-50">
                    <p class="text-sm text-gray-500">Date: <span class="font-semibold">February 09, 2001</span></p>
                    <p class="text-sm text-gray-500">Disease: <span class="font-semibold">Dengue</span></p>
                    <p class="text-sm text-gray-500">Notes:</p>
                    <p class="font-medium mb-2">Patient advised to rest and hydrate. Monitor for fever.</p>

                    <!-- Prescription History -->
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 mb-1">Prescription:</p>
                        <ul class="list-disc list-inside text-sm text-gray-800 space-y-1">
                            <li>Paracetamol - 10 pcs</li>
                            <li>ORS Solution - 5 pcs</li>
                        </ul>
                    </div>
                </div>

                <!-- Another Example -->
                <div class="border border-gray-200 hover:shadow-lg rounded-xl p-4 bg-gray-50">
                    <p class="text-sm text-gray-500">Date: <span class="font-semibold">December 20, 2001</span></p>
                    <p class="text-sm text-gray-500">Disease: <span class="font-semibold">Chikungunya</span></p>
                    <p class="text-sm text-gray-500">Notes:</p>
                    <p class="font-medium mb-2">Severe joint pain reported. Given paracetamol and follow-up scheduled.</p>

                    <!-- Prescription History -->
                    <div class="mt-2">
                        <p class="text-sm text-gray-500 mb-1">Prescription:</p>
                        <ul class="list-disc list-inside text-sm text-gray-800 space-y-1">
                            <li>Paracetamol - 15 pcs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- JS Logic -->
        <script>
            const editBtn = document.getElementById('editBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const form = document.getElementById('patientForm');
            const inputs = form.querySelectorAll('input, select, textarea');
            const actionBtns = document.getElementById('actionBtns');

            editBtn.addEventListener('click', () => {
                inputs.forEach(el => el.disabled = false);
                actionBtns.classList.remove('hidden');
                editBtn.classList.add('hidden');
            });

            cancelBtn.addEventListener('click', () => {
                inputs.forEach(el => el.disabled = true);
                actionBtns.classList.add('hidden');
                editBtn.classList.remove('hidden');
            });

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                inputs.forEach(el => el.disabled = true);
                actionBtns.classList.add('hidden');
                editBtn.classList.remove('hidden');
                alert('Patient info saved!');
            });
        </script>




</x-admin-layout>