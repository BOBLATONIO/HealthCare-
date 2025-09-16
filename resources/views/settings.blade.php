<x-admin-layout title="Settings">

    <div class="p-6">

        <!-- Profile Header -->
        <div class="flex items-center space-x-4 bg-white shadow rounded-lg p-6 mb-6">
            <div class="w-16 h-16 bg-blue-600 text-white flex items-center justify-center rounded-full text-2xl font-bold">
                {{ strtoupper(substr(Auth::user()->email, 0, 1)) }}
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-800">{{ Auth::user()->email }}</h2>
                <p class="text-gray-500">Account Settings</p>
            </div>
        </div>

        <!-- Change Password Section -->
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Change Password</h3>

            <form class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-600">Current Password</label>
                    <input type="password" placeholder="Enter current password"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">New Password</label>
                    <input type="password" placeholder="Enter new password"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Confirm New Password</label>
                    <input type="password" placeholder="Re-enter new password"
                        class="mt-1 w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="flex justify-end">
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>

</x-admin-layout>