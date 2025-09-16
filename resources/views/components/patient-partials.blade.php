@forelse($patients as $patient)
<tr class="hover:bg-slate-50 border-b border-slate-200">
    <td class="p-4 py-5">
        <p class="text-sm text-slate-500">{{ $patient->patient_id }}</p>
    </td>
    <td class="p-4 py-5">
        <p class="text-sm text-slate-500">
            {{ $patient->last_name }}, {{ $patient->first_name }}, {{ $patient->middle_name }}
        </p>
    </td>
    <td class="p-4 py-5">
        <p class="text-sm text-slate-500">{{ $patient->gender }}</p>
    </td>
    <td class="p-4 py-5">
        @php
        $birthdate = \Carbon\Carbon::parse($patient->birthdate);
        $diff = $birthdate->diff(\Carbon\Carbon::now());
        @endphp

        <p class="text-sm text-slate-500">
            @if ($diff->y >= 1)
            {{ $diff->y }} {{ Str::plural('year', $diff->y) }} old
            @else
            {{ $diff->m }} {{ Str::plural('month', $diff->m) }} old
            @endif
        </p>
    </td>

    <td class="p-4 max-w-[200px] py-5">
        <p class="text-sm text-slate-500 line-clamp-2">{{ $patient->address }}</p>
    </td>
    <td class="p-4 py-5">
        <p class="text-sm text-slate-500">{{ $patient->contact }}</p>
    </td>
    <td class="p-4 py-5">
        <div class="flex gap-2 justify-center items-center">
            <!-- View button -->
            <a href="{{ route('patientInfo', $patient) }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                    class="w-5 h-5 text-blue-500">
                    <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    <path fill-rule="evenodd"
                        d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                        clip-rule="evenodd" />
                </svg>
            </a>

            <!-- Delete button -->
            <form action="{{ route('patients.destroy', $patient) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this patient?');" class="inline-flex"> @csrf
                @method('DELETE') <button type="submit"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="currentColor" class="w-5 h-5 text-red-400">
                        <path fill-rule="evenodd"
                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="7" class="p-4 text-center text-slate-500">
        No patients found.
    </td>
</tr>
@endforelse

<!-- Pagination -->