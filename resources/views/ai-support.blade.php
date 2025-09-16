<x-admin-layout title="AI Health Support">
    <div class="p-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center py-3 px-6 bg-blue-800 rounded-t-lg text-white shadow-sm">
            <h1 class="text-xl font-semibold tracking-wide flex items-center space-x-2">
                <img class="w-8" src="{{asset('assets/image/gemini-logo.png')}}" alt="">
                <span>MediAI | Intelligent Health Support</span>
            </h1>
            <p class="text-sm text-blue-200">Powered by Gemini AI</p>
        </div>

        <!-- Card -->
        <div class="border bg-white shadow-sm border-gray-200 rounded-b-lg p-6 space-y-6">
            
            <!-- Input + Button -->
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">
                    Patient's Condition / Disease
                </label>
                <div class="flex space-x-3">
                    <!-- Input Field -->
                    <input type="text"
                        placeholder="e.g., Asthma, High Fever, Minor Burn"
                        class="flex-1 border border-gray-300 bg-white text-gray-800 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 shadow-sm" />

                    <!-- Button -->
                    <button type="submit"
                        class="px-6 py-2 text-sm font-bold bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition">
                        Get Support
                    </button>
                </div>
            </div>

            <!-- AI Response -->
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">
                    AI First Aid Support
                </label>
                <div class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700 bg-gray-50 min-h-[150px] max-h-[300px] overflow-y-auto shadow-inner">
                    <span class="text-gray-400 italic">⌛ Waiting for condition input...</span>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
