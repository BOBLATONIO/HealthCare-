<x-admin-layout title="AI Health Support">
    <div class="p-6">
        <!-- Page Header -->
        <div class="flex justify-between items-center py-3 px-6 bg-blue-800 rounded-t-lg text-white shadow-sm">
            <h1 class="text-xl font-semibold tracking-wide flex items-center space-x-2">
                <img class="w-8" src="{{asset('assets/image/gemini-logo.png')}}" alt="">
                <span>MediAI | Intelligent Health Support</span>
            </h1>

        </div>

        <!-- Card -->
        <div class="border bg-white shadow-sm border-gray-200 rounded-b-lg p-6 space-y-6">

            <!-- Input + Button -->
            <form action="{{ route('generate') }}" method="POST">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-600 mb-2">
                        Patient's Condition / Disease
                    </label>
                    <div class="flex space-x-3">
                        <!-- Input Field -->
                        <input type="text" name="prompt" placeholder="e.g., Asthma, High Fever, Minor Burn"
                            value="{{ session('prompt') }}"
                            class="flex-1 border border-gray-300 bg-white text-gray-800 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 placeholder-gray-400 shadow-sm" />

                        <!-- Button -->
                        <button type="submit"
                            class="px-6 py-2 text-sm font-bold bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition">
                            Get Support
                        </button>
                    </div>
                </div>
            </form>


            <!-- AI Response -->
            <div>
                <label class="block text-sm font-semibold text-gray-600 mb-2">
                    AI First Aid Support
                </label>
                <div
                    class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm text-gray-700 bg-gray-50 min-h-[200px] shadow-inner">
                    @if (session('response'))
                    <div id="aiContent" style="white-space: pre-wrap;">{!! session('response') !!}</div>
                    @else
                    <span class="text-gray-400 italic"> First-aid steps
                        will appear
                        here
                        after submitting
                        the condition.</span>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <script>
        function formatText(text) {
            // Bold: **text**
            text = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');

            // Italic: *text*
            text = text.replace(/\*(.*?)\*/g, '<em>$1</em>');

            // Split lines
            const lines = text.split('\n');

            // Format bullets and sub-bullets
            const formattedLines = lines.map(line => {
                const match = line.match(/^(\s*)\* (.*)/); // match spaces + * + text
                if (match) {
                    const indent = match[1].length; // number of spaces
                    const content = match[2];
                    const bullet = indent > 0 ? '<span style="line-height:0.5;" class="text-xl">•</span> ' : '<span style="line-height:0.5;" class="text-xl">•</span> '; // sub-bullet uses dash
                    return '&nbsp;'.repeat(indent) + bullet + content;
                }
                return line;
            });

            return formattedLines.join('<br>'); // preserve line breaks
        }

        const aiDiv = document.getElementById('aiContent');
        aiDiv.innerHTML = formatText(aiDiv.textContent);
    </script>






</x-admin-layout>