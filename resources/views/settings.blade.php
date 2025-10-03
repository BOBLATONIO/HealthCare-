<x-admin-layout title="Settings">

    <div class="p-6">



        <div class="flex items-center justify-between bg-white shadow rounded-lg p-6 mb-6">
            <div id="toastContainer" class="fixed top-6 right-6 z-50 space-y-2"></div>

            <div class="flex items-center space-x-4">
                <div class="w-16 h-16 rounded-full overflow-hidden relative">
                    <img id="profilePhotoPreview"
                        src="{{ Auth::user()->profile_photo_base64 
                ? 'data:image/png;base64,' . Auth::user()->profile_photo_base64 
                : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0D8ABC&color=fff' }}"
                        class="w-16 h-16 object-cover rounded-full"
                        alt="Profile Photo">

                    <!-- Hidden file input -->
                    <input type="file" id="profilePhotoInput" name="profile_photo" accept="image/*" class="hidden">
                </div>

                <div>
                    <!-- Name display -->
                    <h2 id="nameDisplay" class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</h2>
                    <!-- Name input (hidden initially) -->
                    <input type="text" id="nameInput" value="{{ Auth::user()->name }}" class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-1 focus:ring-2 focus:ring-blue-500 outline-none hidden">
                    <p class="text-gray-500">{{ Auth::user()->email }}</p>
                </div>


            </div>

            <!-- Action buttons -->
            <div>
                <button id="editBtn" class="px-6 py-1.5 bg-blue-800 text-white rounded-lg hover:bg-blue-700 transition">Edit</button>
                <div id="actionBtns" class="space-x-2 hidden">
                    <button id="saveBtn" class="px-6 py-1.5 bg-blue-800 text-white rounded-lg hover:bg-blue-700 transition">Save</button>
                    <button id="cancelBtn" class="px-6 py-1.5 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 transition">Cancel</button>
                </div>
            </div>
        </div>







        <!-- Change Password Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>

            <form action="{{ route('password.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    @if(session('success'))
                    <div id="alertMessage" class="transition-opacity duration-1000 text-start text-sm text-green-700 border w-96 border-green-200 bg-green-100 px-4 py-2 rounded">
                        {{ session('success') }}
                    </div>
                    @elseif(session('error'))
                    <div id="alertMessage" class="transition-opacity duration-1000 text-start text-sm text-red-700 border w-96 border-red-200 bg-red-100 px-4 py-2 rounded">
                        {{ session('error') }}
                    </div>
                    @endif

                    @error('new_password')
                    <div id="alertMessage" class="transition-opacity duration-1000 text-sm text-red-700 border border-red-200 bg-red-100 px-4 py-2 rounded mt-2">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Current Password</label>
                    <input type="password" name="current_password" placeholder="Enter current password"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">New Password</label>
                    <input type="password" name="new_password" placeholder="Enter new password"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" placeholder="Re-enter new password"
                        class="mt-1 w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit" class="px-4 py-2 bg-blue-800 text-white rounded-lg hover:bg-blue-700 transition">
                        Update Password
                    </button>
                </div>


            </form>

        </div>

    </div>



    <script>
        // Fade out flash messages after 3 seconds
        setTimeout(() => {
            const alert = document.getElementById('alertMessage');
            if (alert) {
                alert.classList.add('opacity-0'); // start fade out
                setTimeout(() => alert.remove(), 1000); // remove from DOM after fade
            }
        }, 3000);



        const editBtn = document.getElementById('editBtn');
        const saveBtn = document.getElementById('saveBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const actionBtns = document.getElementById('actionBtns');

        const nameDisplay = document.getElementById('nameDisplay');
        const nameInput = document.getElementById('nameInput');

        const profilePhotoPreview = document.getElementById('profilePhotoPreview');
        const profilePhotoInput = document.getElementById('profilePhotoInput');

        let originalName = nameDisplay.textContent;
        let originalPhotoSrc = profilePhotoPreview.src;

        profilePhotoInput.addEventListener('change', (event) => {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    profilePhotoPreview.src = e.target.result; // update preview
                };
                reader.readAsDataURL(file);
            }
        });

        function enablePhotoClick() {
            profilePhotoPreview.addEventListener('click', triggerFileInput);
        }

        function disablePhotoClick() {
            profilePhotoPreview.removeEventListener('click', triggerFileInput);
        }

        function triggerFileInput() {
            profilePhotoInput.click();
        }




        // Edit button click
        editBtn.addEventListener('click', () => {
            nameDisplay.classList.add('hidden');
            nameInput.classList.remove('hidden');

            editBtn.classList.add('hidden');
            actionBtns.classList.remove('hidden');

            // Make photo clickable
            enablePhotoClick();
        });

        // Cancel button click
        cancelBtn.addEventListener('click', () => {
            nameInput.value = originalName;
            nameInput.classList.add('hidden');
            nameDisplay.classList.remove('hidden');

            profilePhotoPreview.src = originalPhotoSrc;

            actionBtns.classList.add('hidden');
            editBtn.classList.remove('hidden');

            disablePhotoClick();
        });

        // Save button click (submit form via JS)
        function showToast(message, type = 'success') {
            const toastContainer = document.getElementById('toastContainer');

            const toast = document.createElement('div');
            toast.className = `
        transition-opacity duration-1000 px-4 py-2 rounded shadow-lg
        ${type === 'success' ? 'bg-green-100 text-green-700 border border-green-200' : 'bg-red-100 text-red-700 border border-red-200'}
    `;
            toast.textContent = message;

            toastContainer.appendChild(toast);

            // Auto-remove after 3 seconds
            setTimeout(() => {
                toast.classList.add('opacity-0'); // fade out
                setTimeout(() => toast.remove(), 1000);
            }, 3000);
        }

        // Save button
        saveBtn.addEventListener('click', () => {
            const nameChanged = nameInput.value.trim() !== originalName;
            const photoChanged = profilePhotoInput.files[0] !== undefined;

            if (!nameChanged && !photoChanged) return;

            const formData = new FormData();
            if (nameChanged) formData.append('name', nameInput.value);
            if (photoChanged) formData.append('profile_photo', profilePhotoInput.files[0]);

            fetch("{{ route('profile.update') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        if (nameChanged) nameDisplay.textContent = nameInput.value;

                        nameInput.classList.add('hidden');
                        nameDisplay.classList.remove('hidden');
                        actionBtns.classList.add('hidden');
                        editBtn.classList.remove('hidden');

                        if (nameChanged) originalName = nameInput.value;
                        if (photoChanged) originalPhotoSrc = profilePhotoPreview.src;
                        disablePhotoClick();

                        showToast(data.message, 'success');
                    } else if (data.errors) {
                        // Show all errors as red toast
                        data.errors.forEach(err => showToast(err, 'error'));
                    }
                })
                .catch(err => {
                    console.error(err);
                    showToast('Failed to update profile!', 'error');
                });
        });
    </script>





</x-admin-layout>