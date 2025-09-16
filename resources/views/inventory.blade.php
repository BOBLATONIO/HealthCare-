<x-admin-layout title="Inventory Records">
    <div class="px-4 mt-2">
        <!-- Top Bar -->
        <div class="w-full flex justify-between items-center mb-3 mt-1 ">
            <!-- Search -->
            <div class="w-full max-w-sm min-w-[300px] relative">
                <div class="relative">
                    <input
                        class="bg-white w-full pr-11 pl-3 py-1.5 placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none hover:border-slate-400"
                        placeholder="Search" />
                    <button
                        class="absolute h-8 w-8 right-1 top-0 my-auto px-2 flex items-center rounded"
                        type="button">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="3" stroke="currentColor"
                            class="w-5 h-5 text-slate-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
            </div>
            <!-- Add Button -->
            <div>
                <button class="px-8 py-1.5 bg-blue-800 text-white rounded-md hover:bg-blue-700">
                    Add Item
                </button>
            </div>
        </div>

        <!-- Inventory Table -->
        <div
            class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white border border-gray-200 rounded-lg bg-clip-border">
            <table class="w-full text-left table-auto min-w-max">
                <thead>
                    <tr>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Medicine ID</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Medicine Name</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Quantity</p>
                        </th>
                        <th class="p-4 py-3 border-b border-slate-200 bg-blue-800">
                            <p class="text-sm font-semibold leading-none text-gray-50">Action</p>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">MED-001</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">Paracetamol</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">120</p>
                        </td>
                        <td class="p-4 py-5 flex space-x-2">
                            <button
                                class="px-3 py-1 bg-blue-800 text-white rounded-md hover:bg-blue-700">Edit</button>
                            <button
                                class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 border-b border-slate-200">
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">MED-002</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">Ibuprofen</p>
                        </td>
                        <td class="p-4 py-5">
                            <p class="text-sm text-slate-500">45</p>
                        </td>
                        <td class="p-4 py-5 flex space-x-2">
                            <button
                                class="px-3 py-1 bg-blue-800 text-white rounded-md hover:bg-blue-700">Edit</button>
                            <button
                                class="px-3 py-1 bg-red-600 text-white rounded-md hover:bg-red-700">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="flex justify-between items-center px-4 py-3">
                <div class="text-sm text-slate-500">
                    Showing <b>1-5</b> of 50
                </div>
                <div class="flex space-x-1">
                    <button
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                        Prev
                    </button>
                    <button
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-white bg-blue-800 border border-blue-800 rounded hover:bg-blue-600 hover:border-blue-600 transition">
                        1
                    </button>
                    <button
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                        2
                    </button>
                    <button
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                        3
                    </button>
                    <button
                        class="px-3 py-1 min-w-9 min-h-9 text-sm font-normal text-slate-500 bg-white border border-slate-200 rounded hover:bg-slate-50 hover:border-slate-400 transition">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>